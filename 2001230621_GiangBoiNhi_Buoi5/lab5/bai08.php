<?php
//==============================================================
// BÀI 08
// Thống kê tổng số lượng và doanh thu của từng loại sản phẩm.
//
// Yêu cầu:
// - Hiển thị:
//   + Tên loại sản phẩm.
//   + Tổng số lượng đã bán.
//   + Tổng doanh thu.
//==============================================================


//--------------------------------------------------------------
// require
//
// Chức năng:
// - Nạp file connect.php.
// - Kết nối đến cơ sở dữ liệu MySQL.
//--------------------------------------------------------------
require "connect.php";


//--------------------------------------------------------------
// $sql
//
// Biến lưu câu lệnh SQL.
//--------------------------------------------------------------
$sql = "

-- SELECT
-- Chọn các cột cần hiển thị.
SELECT

-- c là bí danh của bảng categories.
c.category_name,

-- SUM()
-- Tính tổng số lượng sản phẩm đã bán.
SUM(od.quantity) AS total_quantity,

-- SUM()
-- Tính tổng doanh thu.
--
-- quantity * price
-- = Thành tiền của từng sản phẩm.
SUM(od.quantity * od.price) AS total_revenue

-- FROM
-- Bảng chính.
FROM categories c

-- JOIN
-- Ghép bảng categories với products.
JOIN products p

ON c.category_id = p.category_id

-- JOIN
-- Ghép products với order_details.
JOIN order_details od

ON p.product_id = od.product_id

-- GROUP BY
-- Nhóm dữ liệu theo từng loại sản phẩm.
GROUP BY c.category_name

";


//--------------------------------------------------------------
// query()
//
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

<meta charset="UTF-8">

<title>Bài 08</title>

</head>

<body>

<h2>Thống kê số lượng và doanh thu từng loại sản phẩm</h2>

<table border="1" cellpadding="10">

<tr>

<th>Loại sản phẩm</th>

<th>Tổng số lượng</th>

<th>Tổng doanh thu</th>

</tr>

<?php

//--------------------------------------------------------------
// while
//
// Lặp từng dòng dữ liệu.
//
// fetch()
// Lấy từng dòng.
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

// Hiển thị tên loại sản phẩm.
$row["category_name"];

?>

</td>

<td>

<?=

// Hiển thị tổng số lượng đã bán.
$row["total_quantity"];

?>

</td>

<td>

<?=

// number_format()
//
// Định dạng số có dấu phân cách hàng nghìn.
//
// total_revenue
// Là doanh thu của từng loại sản phẩm.
number_format($row["total_revenue"]);

?>

VNĐ

</td>

</tr>

<?php

}

// Kết thúc while.

?>

</table>

</body>

</html>