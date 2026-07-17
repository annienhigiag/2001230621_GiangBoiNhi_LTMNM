<?php
//==============================================================
// BÀI 12
// Liệt kê tất cả sản phẩm và số lần được đặt hàng.
//
// Yêu cầu:
// - Hiển thị:
//   + Mã sản phẩm.
//   + Tên sản phẩm.
//   + Số lần được đặt hàng.
// - Nếu sản phẩm chưa từng được đặt hàng thì hiển thị 0.
//==============================================================


//--------------------------------------------------------------
// require
//
// Là từ khóa của PHP.
//
// Chức năng:
// - Nạp file connect.php.
// - File connect.php dùng để kết nối cơ sở dữ liệu MySQL.
//--------------------------------------------------------------
require "connect.php";


//--------------------------------------------------------------
// $sql
//
// Biến dùng để lưu câu lệnh SQL.
//
// Kiểu dữ liệu:
// String (chuỗi).
//--------------------------------------------------------------
$sql = "

-- SELECT
-- Chọn các cột cần hiển thị.
SELECT

-- p là bí danh (Alias) của bảng products.
p.product_id,

-- Lấy tên sản phẩm.
p.name,

-- IFNULL()
--
-- Hàm của MySQL.
--
-- Chức năng:
-- Nếu giá trị NULL thì thay bằng giá trị khác.
--
-- COUNT(od.order_id)
-- Đếm số lần sản phẩm xuất hiện trong bảng order_details.
--
-- Nếu sản phẩm chưa từng được đặt hàng
-- COUNT sẽ trả về NULL.
--
-- Khi đó IFNULL sẽ đổi thành 0.
IFNULL(COUNT(od.order_id),0) AS total_orders

-- FROM
-- Chọn bảng products làm bảng chính.
FROM products p

-- LEFT JOIN
--
-- Ghép bảng products với order_details.
--
-- LEFT JOIN giúp lấy tất cả sản phẩm.
--
-- Dù chưa từng được đặt hàng
-- sản phẩm vẫn được hiển thị.
LEFT JOIN order_details od

-- Điều kiện nối.
ON p.product_id = od.product_id

-- GROUP BY
-- Nhóm theo từng sản phẩm.
GROUP BY

p.product_id,

p.name

-- ORDER BY
-- Sắp xếp theo mã sản phẩm tăng dần.
ORDER BY p.product_id ASC

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
//
// $stmt
// Biến lưu kết quả truy vấn.
//--------------------------------------------------------------
$stmt = $conn->query($sql);

?>

<!DOCTYPE html>

<html>

<head>

    <!--
    Khai báo bảng mã UTF-8.
    -->
    <meta charset="UTF-8">

    <!--
    Tiêu đề trang web.
    -->
    <title>Bài 12</title>

</head>

<body>

<!--
Tiêu đề của trang.
-->
<h2>Danh sách sản phẩm và số lần được đặt hàng</h2>

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
    <th>Mã sản phẩm</th>

    <th>Tên sản phẩm</th>

    <th>Số lần được đặt hàng</th>

</tr>

<?php

//--------------------------------------------------------------
// while
//
// Câu lệnh lặp.
//
// Chức năng:
// Lặp qua từng dòng dữ liệu.
//
// fetch()
// Lấy từng dòng dữ liệu.
//
// PDO::FETCH_ASSOC
// Trả về dữ liệu dạng mảng kết hợp.
//--------------------------------------------------------------
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

?>

<tr>

    <td>

        <?=
        // Hiển thị mã sản phẩm.
        $row["product_id"];
        ?>

    </td>

    <td>

        <?=
        // Hiển thị tên sản phẩm.
        $row["name"];
        ?>

    </td>

    <td>

        <?=
        // Hiển thị số lần được đặt hàng.
        //
        // total_orders
        // Là bí danh của:
        // IFNULL(COUNT(od.order_id),0)
        $row["total_orders"];
        ?>

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