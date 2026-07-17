<?php
//==============================================================
// BÀI 11
// Tìm loại hàng có doanh thu cao nhất.
//
// Yêu cầu:
// - Hiển thị:
//   + Tên loại hàng.
//   + Tổng doanh thu.
// - Chỉ lấy loại hàng có doanh thu lớn nhất.
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

-- c là bí danh (Alias) của bảng categories.
c.category_name,

-- SUM()
-- Hàm tổng hợp.
--
-- Chức năng:
-- Tính tổng doanh thu của từng loại hàng.
--
-- quantity * price
-- = Thành tiền của từng sản phẩm.
SUM(od.quantity * od.price) AS total_revenue

-- FROM
-- Chọn bảng categories làm bảng chính.
FROM categories c

-- JOIN
-- Ghép bảng categories với products.
JOIN products p

-- Điều kiện nối.
ON c.category_id = p.category_id

-- JOIN
-- Ghép bảng products với order_details.
JOIN order_details od

-- Điều kiện nối.
ON p.product_id = od.product_id

-- GROUP BY
-- Nhóm dữ liệu theo từng loại hàng.
GROUP BY c.category_name

-- ORDER BY
-- Sắp xếp theo doanh thu giảm dần.
ORDER BY total_revenue DESC

-- LIMIT
-- Chỉ lấy loại hàng có doanh thu cao nhất.
LIMIT 1

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

    <!--
    Khai báo bảng mã UTF-8.
    -->
    <meta charset="UTF-8">

    <!--
    Tiêu đề trang web.
    -->
    <title>Bài 11</title>

</head>

<body>

<!-- Tiêu đề -->
<h2>Loại hàng có doanh thu cao nhất</h2>

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
    <th>Loại hàng</th>

    <th>Tổng doanh thu</th>

</tr>

<?php

//--------------------------------------------------------------
// while
//
// Câu lệnh lặp.
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
        // Hiển thị tên loại hàng.
        $row["category_name"];
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
        // total_revenue
        // Là tổng doanh thu của loại hàng.
        number_format($row["total_revenue"]);
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