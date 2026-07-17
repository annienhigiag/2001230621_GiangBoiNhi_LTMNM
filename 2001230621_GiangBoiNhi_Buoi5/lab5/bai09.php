<?php
//==============================================================
// BÀI 09
// Tìm 3 sản phẩm bán chạy nhất.
//
// Yêu cầu:
// - Hiển thị:
//   + Mã sản phẩm.
//   + Tên sản phẩm.
//   + Tổng số lượng đã bán.
// - Chỉ lấy 3 sản phẩm bán nhiều nhất.
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

-- Mã sản phẩm.
p.product_id,

-- Tên sản phẩm.
p.name,

-- SUM()
-- Hàm tổng hợp.
--
-- Chức năng:
-- Tính tổng số lượng bán của từng sản phẩm.
SUM(od.quantity) AS total_quantity

-- FROM
-- Chọn bảng products làm bảng chính.
FROM products p

-- JOIN
-- Ghép bảng products với order_details.
JOIN order_details od

-- Điều kiện nối.
ON p.product_id = od.product_id

-- GROUP BY
-- Nhóm dữ liệu theo từng sản phẩm.
GROUP BY

p.product_id,

p.name

-- ORDER BY
-- Sắp xếp kết quả theo tổng số lượng bán.
ORDER BY total_quantity DESC

-- LIMIT
-- Chỉ lấy 3 dòng đầu tiên.
LIMIT 3

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

    <!-- Khai báo bảng mã UTF-8 -->
    <meta charset="UTF-8">

    <!-- Tiêu đề trang -->
    <title>Bài 09</title>

</head>

<body>

<!-- Tiêu đề -->
<h2>Top 3 sản phẩm bán chạy nhất</h2>

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

    <th>Tổng số lượng bán</th>

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
        // Hiển thị tổng số lượng đã bán.
        //
        // total_quantity
        // Là bí danh của:
        // SUM(od.quantity)
        $row["total_quantity"];
        ?>

    </td>

</tr>

<?php

// Kết thúc vòng lặp while.
}

?>

</table>

</body>

</html>