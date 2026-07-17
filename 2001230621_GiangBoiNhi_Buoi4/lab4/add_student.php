<?php

/*
====================================================
BÀI 4
THÊM SINH VIÊN
====================================================
*/

// ======================================================
// Gọi file kết nối cơ sở dữ liệu.
// Sau khi require, biến $conn sẽ được sử dụng
// để thực hiện các câu lệnh SQL.
// ======================================================
require "connect.php";

/*======================================================
KIỂM TRA NGƯỜI DÙNG ĐÃ NHẤN NÚT THÊM HAY CHƯA
======================================================*/

// Nếu người dùng nhấn nút "Thêm sinh viên"
// thì Form sẽ gửi dữ liệu bằng phương thức POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ===================================================
    // Lấy dữ liệu từ Form.
    //
    // trim() dùng để loại bỏ khoảng trắng
    // ở đầu và cuối chuỗi.
    // ===================================================
    $name = trim($_POST["name"]);

    $email = trim($_POST["email"]);

    $phone = trim($_POST["phone"]);

    // Ngày sinh lấy trực tiếp từ ô Date.
    $birthday = $_POST["birthday"];

    // ===================================================
    // Câu lệnh SQL thêm sinh viên.
    //
    // Dấu ? là Placeholder.
    // Giá trị thật sẽ được truyền vào execute().
    // ===================================================
    $sql = "INSERT INTO students(name,email,phone,birthday)
            VALUES(?,?,?,?)";

    // ===================================================
    // Chuẩn bị câu lệnh SQL.
    //
    // prepare() giúp:
    // - Chống SQL Injection.
    // - Kiểm tra cú pháp SQL.
    // ===================================================
    $stmt = $conn->prepare($sql);

    // ===================================================
    // Thực thi câu lệnh SQL.
    //
    // execute() sẽ thay các dấu ? bằng
    // giá trị tương ứng.
    //
    // Ví dụ:
    //
    // $name = "Nguyễn Văn A"
    //
    // SQL thực tế:
    //
    // INSERT INTO students(name,email,phone,birthday)
    // VALUES('Nguyễn Văn A', ...);
    // ===================================================
    $stmt->execute([

        $name,

        $email,

        $phone,

        $birthday

    ]);

    // ===================================================
    // Sau khi thêm thành công
    // chuyển về danh sách sinh viên.
    //
    // header() dùng để chuyển hướng.
    // ===================================================
    header("Location:list_students.php");

    // Dừng chương trình sau khi chuyển trang.
    exit();
}

?>

<!DOCTYPE html>

<html lang="vi">

<head>

    <!-- Bộ mã Unicode -->
    <meta charset="UTF-8">

    <!-- Responsive trên điện thoại -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tiêu đề trang -->
    <title>Thêm sinh viên</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<!-- Nền màu sáng -->

<body class="bg-light">

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <!-- ===================================
     Card Bootstrap
=================================== -->

                <div class="card shadow">

                    <!-- Tiêu đề Card -->
                    <div class="card-header bg-success text-white">

                        <h3>

                            <i class="bi bi-person-plus-fill"></i>

                            THÊM SINH VIÊN

                        </h3>

                    </div>

                    <!-- Nội dung Card -->
                    <div class="card-body">

                        <!-- ===================================
     Form thêm sinh viên
=================================== -->

                        <form method="post">

                            <!-- Họ tên -->
                            <div class="mb-3">

                                <label class="form-label">

                                    Họ tên

                                </label>

                                <input type="text" name="name" class="form-control" placeholder="Nhập họ tên" required>

                            </div>

                            <!-- Email -->
                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input type="email" name="email" class="form-control" placeholder="Nhập Email" required>

                            </div>

                            <!-- Số điện thoại -->
                            <div class="mb-3">

                                <label class="form-label">

                                    Số điện thoại

                                </label>

                                <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại">

                            </div>

                            <!-- Ngày sinh -->
                            <div class="mb-4">

                                <label class="form-label">

                                    Ngày sinh

                                </label>

                                <input type="date" name="birthday" class="form-control">

                            </div>

                            <!-- Các nút chức năng -->
                            <div class="d-flex justify-content-between">

                                <!-- Nút thêm sinh viên -->
                                <button type="submit" class="btn btn-success">

                                    <i class="bi bi-check-circle"></i>

                                    Thêm sinh viên

                                </button>

                                <!-- Nút quay về Trang chủ -->
                                <a href="index.php" class="btn btn-secondary">

                                    <i class="bi bi-house"></i>

                                    Trang chủ

                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>