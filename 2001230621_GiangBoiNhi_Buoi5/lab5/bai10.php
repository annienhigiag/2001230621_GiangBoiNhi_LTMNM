<?php
//==============================================================
// BÀI 10
// Liệt kê 5 khách hàng chi tiêu nhiều nhất.
//
// Yêu cầu:
// - Hiển thị:
//   + Mã khách hàng.
//   + Tên khách hàng.
//   + Email.
//   + Tổng số tiền đã chi tiêu.
// - Chỉ lấy 5 khách hàng có tổng chi tiêu cao nhất.
//==============================================================


//--------------------------------------------------------------
// require
//
// Chức năng:
// - Nạp file connect.php.
// - File này dùng để kết nối cơ sở dữ liệu MySQL.
//--------------------------------------------------------------
require "connect.php";


//--------------------------------------------------------------
// $sql
//
// Biến lưu câu lệnh SQL.
//
// Kiểu dữ liệu:
// String (chuỗi).
//--------------------------------------------------------------
$sql = "

-- SELECT
-- Chọn các cột cần hiển thị.
SELECT

-- c là bí danh (Alias) của bảng customers.
c.customer_id,

-- Lấy tên khách hàng.
c.name,

-- Lấy email khách hàng.
c.email,

-- SUM()
-- Hàm tổng hợp.
--
-- Chức năng:
-- Tính tổng số tiền khách hàng đã mua.
--
-- od.quantity
-- Là số lượng sản phẩm.
--
-- *
-- Là phép nhân.
--
-- od.price
-- Là giá bán của sản phẩm.
SUM(od.quantity * od.price) AS total_spent

-- FROM
-- Chọn bảng customers làm bảng chính.
FROM customers c

-- JOIN
-- Ghép bảng customers với orders.
JOIN orders o

-- Điều kiện nối.
ON c.customer_id = o.customer_id

-- JOIN
-- Ghép bảng orders với order_details.
JOIN order_details od

-- Điều kiện nối.
ON o.order_id = od.order_id

-- GROUP BY
-- Nhóm dữ liệu theo từng khách hàng.
GROUP BY

c.customer_id,

c.name,

c.email

-- ORDER BY
-- Sắp xếp theo tổng chi tiêu giảm dần.
ORDER BY total_spent DESC

-- LIMIT
-- Chỉ lấy 5 khách hàng đầu tiên.
LIMIT 5

";


//--------------------------------------------------------------
// query()
//
// Hàm của đối tượng PDO.
//
// Chức năng:
// Thực thi câu lệnh SQL.
//
// Trả về:
// PDOStatement.
//--------------------------------------------------------------
$stmt = $conn->query($sql);

?>

<!DOCTYPE html>

<html>

<head>

    <!-- Khai báo bảng mã UTF-8 -->
    <meta charset="UTF-8">

    <!-- Tiêu đề trang -->
    <title>Bài 10</title>

</head>

<body>

<!-- Tiêu đề -->
<h2>Top 5 khách hàng chi tiêu nhiều nhất</h2>

<!--
table
Tạo bảng HTML.

border
Đường viền bảng.

cellpadding
Khoảng cách giữa nội dung và viền.
-->
<table border="1" cellpadding="10">

<tr>

    <!-- Tiêu đề cột -->
    <th>Mã khách hàng</th>

    <th>Tên khách hàng</th>

    <th>Email</th>

    <th>Tổng chi tiêu</th>

</tr>

<?php

//--------------------------------------------------------------
// while
//
// Lặp qua từng dòng dữ liệu.
//
// fetch()
// Lấy từng dòng dữ liệu.
//
// PDO::FETCH_ASSOC
// Trả dữ liệu dạng mảng kết hợp.
//--------------------------------------------------------------
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

?>

<tr>

    <td>

        <?=
        // Hiển thị mã khách hàng.
        $row["customer_id"];
        ?>

    </td>

    <td>

        <?=
        // Hiển thị tên khách hàng.
        $row["name"];
        ?>

    </td>

    <td>

        <?=
        // Hiển thị email khách hàng.
        $row["email"];
        ?>

    </td>

    <td>

        <?=
        // number_format()
        //
        // Hàm của PHP.
        //
        // Chức năng:
        // Định dạng số có dấu phân cách hàng nghìn.
        //
        // total_spent
        // Là tổng chi tiêu của khách hàng.
        number_format($row["total_spent"]);
        ?>

        VNĐ

    </td>

</tr>

<?php

//--------------------------------------------------------------
// Kết thúc vòng lặp while.
//--------------------------------------------------------------
}

?>

</table>

</body>

</html>