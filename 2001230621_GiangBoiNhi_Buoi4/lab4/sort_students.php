<?php

// ======================================================
// Gọi file kết nối CSDL.
// Sau khi require, biến $conn sẽ được sử dụng để thao tác
// với cơ sở dữ liệu.
// ======================================================
require "connect.php";

// ======================================================
// Mặc định sắp xếp theo tên (name)
// ======================================================
$order = "name";

// ======================================================
// Mặc định sắp xếp tăng dần (ASC)
// ASC  : A -> Z
// DESC : Z -> A
// ======================================================
$type = "ASC";

// ======================================================
// Kiểm tra người dùng có chọn cột sắp xếp hay không.
//
// Ví dụ:
// sort_students.php?order=email&type=ASC
//
// Nếu chọn email thì đổi cột sắp xếp thành email.
// ======================================================
if (isset($_GET["order"])) {

    if ($_GET["order"] == "email") {

        $order = "email";

    }

}

// ======================================================
// Kiểm tra kiểu sắp xếp.
//
// ASC  : tăng dần
// DESC : giảm dần
//
// Nếu người dùng chọn DESC thì đổi kiểu sắp xếp.
// ======================================================
if (isset($_GET["type"])) {

    if ($_GET["type"] == "DESC") {

        $type = "DESC";

    }

}

// ======================================================
// Câu lệnh SQL.
//
// ORDER BY dùng để sắp xếp dữ liệu.
//
// Ví dụ:
//
// ORDER BY name ASC
//
// hoặc
//
// ORDER BY email DESC
// ======================================================
$sql = "

SELECT *

FROM students

ORDER BY $order $type

";

// ======================================================
// Chuẩn bị câu lệnh SQL.
//
// prepare() giúp chuẩn bị câu lệnh trước khi thực thi.
// ======================================================
$stmt = $conn->prepare($sql);

// ======================================================
// Thực thi câu lệnh SQL.
//
// Vì câu lệnh này không có dấu ?
// nên execute() không cần truyền tham số.
// ======================================================
$stmt->execute();

// ======================================================
// Lấy toàn bộ dữ liệu.
//
// fetchAll()
// lấy tất cả sinh viên.
//
// PDO::FETCH_ASSOC
// trả về dạng mảng kết hợp.
//
// Ví dụ:
//
// $row["name"]
// $row["email"]
// ======================================================
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>Sắp xếp sinh viên</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

    <!-- ==========================
     Tiêu đề
========================== -->

    <h2 class="text-primary">

        SẮP XẾP SINH VIÊN

    </h2>

    <!-- ==========================
     Các nút sắp xếp
========================== -->

    <!-- Sắp xếp theo tên A-Z -->
    <a class="btn btn-primary" href="?order=name&type=ASC">

        Tên A-Z

    </a>

    <!-- Sắp xếp theo tên Z-A -->
    <a class="btn btn-primary" href="?order=name&type=DESC">

        Tên Z-A

    </a>

    <!-- Sắp xếp Email A-Z -->
    <a class="btn btn-success" href="?order=email&type=ASC">

        Email A-Z

    </a>

    <!-- Sắp xếp Email Z-A -->
    <a class="btn btn-success" href="?order=email&type=DESC">

        Email Z-A

    </a>

    <br><br>

    <!-- ==========================
     Bảng hiển thị dữ liệu
    ========================== -->

    <table class="table table-bordered table-hover">

        <tr>

            <th>ID</th>

            <th>Họ tên</th>

            <th>Email</th>

            <th>SĐT</th>

            <th>Ngày sinh</th>

        </tr>

        <?php

        // =======================================
        // Duyệt toàn bộ danh sách sinh viên.
        //
        // Mỗi vòng lặp tương ứng 1 dòng dữ liệu.
        // =======================================
        foreach ($students as $row) {

            ?>

            <tr>

                <!-- Hiển thị ID -->
                <td>

                    <?= $row["id"] ?>

                </td>

                <!-- Hiển thị Họ tên -->
                <td>

                    <?= htmlspecialchars($row["name"]) ?>

                </td>

                <!-- Hiển thị Email -->
                <td>

                    <?= htmlspecialchars($row["email"]) ?>

                </td>

                <!-- Hiển thị Số điện thoại -->
                <td>

                    <?= htmlspecialchars($row["phone"]) ?>

                </td>

                <!-- Hiển thị Ngày sinh -->
                <td>

                    <?= $row["birthday"] ?>

                </td>

            </tr>

            <?php

        }

        ?>

    </table>

    <!-- ==========================
     Quay lại danh sách
    ========================== -->

    <a href="list_students.php" class="btn btn-danger">

        Quay lại

    </a>

</body>

</html>