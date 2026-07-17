<?php
/*
====================================================
BÀI 6
CẬP NHẬT THÔNG TIN SINH VIÊN
====================================================
*/

// ======================================================
// Gọi file kết nối CSDL.
// Sau khi require, biến $conn sẽ được sử dụng để
// thực hiện các câu lệnh SQL.
// ======================================================
require "connect.php";

/*======================================================
LẤY THÔNG TIN SINH VIÊN THEO ID
======================================================*/

// Kiểm tra URL có truyền id hay không.
//
// Ví dụ:
//
// edit_student.php?id=5
//
if (isset($_GET["id"])) {

    // Lấy id từ URL
    $id = $_GET["id"];

    // ===================================================
    // Câu lệnh SQL lấy thông tin sinh viên theo ID.
    // Dấu ? là Placeholder.
    // ===================================================
    $sql = "SELECT * FROM students WHERE id=?";

    // Chuẩn bị câu lệnh SQL.
    $stmt = $conn->prepare($sql);

    // Thực thi câu lệnh SQL.
    // execute() sẽ thay dấu ? bằng giá trị của $id.
    $stmt->execute([$id]);

    // ===================================================
    // Lấy một sinh viên.
    //
    // fetch()
    // chỉ lấy một dòng dữ liệu.
    //
    // PDO::FETCH_ASSOC
    // trả về mảng kết hợp.
    // ===================================================
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // ===================================================
    // Nếu không tìm thấy sinh viên
    // thì dừng chương trình.
    // ===================================================
    if (!$student) {

        die("Không tìm thấy sinh viên!");

    }
}

/*======================================================
CẬP NHẬT THÔNG TIN
======================================================*/

// Kiểm tra người dùng đã nhấn nút
// Cập nhật hay chưa.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Lấy dữ liệu từ Form
    $id = $_POST["id"];

    // trim() loại bỏ khoảng trắng đầu và cuối chuỗi.
    $name = trim($_POST["name"]);

    $email = trim($_POST["email"]);

    $phone = trim($_POST["phone"]);

    $birthday = $_POST["birthday"];

    // ===================================================
    // Câu lệnh UPDATE.
    //
    // Dấu ? sẽ được thay bằng dữ liệu trong execute().
    // ===================================================
    $sql = "UPDATE students
            SET name=?, email=?, phone=?, birthday=?
            WHERE id=?";

    // Chuẩn bị câu lệnh SQL.
    $stmt = $conn->prepare($sql);

    // ===================================================
    // Thực thi câu lệnh UPDATE.
    //
    // Thứ tự dữ liệu phải đúng với thứ tự dấu ?.
    // ===================================================
    $stmt->execute([

        $name,

        $email,

        $phone,

        $birthday,

        $id

    ]);

    // ===================================================
    // Sau khi cập nhật thành công
    // chuyển về danh sách sinh viên.
    //
    // header()
    // dùng để chuyển trang.
    //
    // exit()
    // dừng chương trình ngay sau khi chuyển trang.
    // ===================================================
    header("Location:list_students.php");

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
    <title>Sửa sinh viên</title>

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

                <!-- ==============================
     Card Bootstrap
================================ -->

                <div class="card shadow">

                    <div class="card-header bg-warning text-dark">

                        <h3 class="mb-0">

                            <i class="bi bi-pencil-square"></i>

                            CẬP NHẬT SINH VIÊN

                        </h3>

                    </div>

                    <div class="card-body">

                        <!-- ===================================
     Form cập nhật sinh viên
=================================== -->

                        <form method="post">

                            <!--
Ẩn ID.

Không cho người dùng sửa ID.

Nhưng vẫn gửi ID lên khi Submit.
-->
                            <input type="hidden" name="id" value="<?= $student['id']; ?>">

                            <!-- Họ tên -->
                            <div class="mb-3">

                                <label class="form-label">

                                    Họ tên

                                </label>

                                <input type="text" name="name" class="form-control"
                                    value="<?= htmlspecialchars($student['name']); ?>" required>

                            </div>

                            <!-- Email -->
                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input type="email" name="email" class="form-control"
                                    value="<?= htmlspecialchars($student['email']); ?>" required>

                            </div>

                            <!-- Số điện thoại -->
                            <div class="mb-3">

                                <label class="form-label">

                                    Số điện thoại

                                </label>

                                <input type="text" name="phone" class="form-control"
                                    value="<?= htmlspecialchars($student['phone']); ?>">

                            </div>

                            <!-- Ngày sinh -->
                            <div class="mb-4">

                                <label class="form-label">

                                    Ngày sinh

                                </label>

                                <input type="date" name="birthday" class="form-control"
                                    value="<?= $student['birthday']; ?>">

                            </div>

                            <!-- Các nút chức năng -->
                            <div class="d-flex justify-content-between">

                                <!-- Nút cập nhật -->
                                <button type="submit" class="btn btn-warning">

                                    <i class="bi bi-save"></i>

                                    Cập nhật

                                </button>

                                <!-- Quay lại danh sách -->
                                <a href="list_students.php" class="btn btn-secondary">

                                    <i class="bi bi-arrow-left-circle"></i>

                                    Quay lại

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