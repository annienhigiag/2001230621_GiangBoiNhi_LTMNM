<?php
//==============================================================
// BÀI 07
// Khách hàng mua nhiều sản phẩm nhất.
//
// Yêu cầu:
// - Hiển thị:
//   + Mã khách hàng (customer_id)
//   + Tên khách hàng (name)
//   + Tổng số lượng sản phẩm đã mua (total_items)
// - Chỉ lấy khách hàng mua nhiều sản phẩm nhất.
//==============================================================


//--------------------------------------------------------------
// require
//
// Là từ khóa của PHP.
//
// Chức năng:
// - Nạp file connect.php.
// - File này chứa đoạn code kết nối MySQL.
// - Nếu file không tồn tại chương trình sẽ dừng.
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

-- SUM()
-- Hàm tổng hợp.
--
-- Chức năng:
-- Tính tổng.
--
-- od.quantity
-- Là số lượng sản phẩm trong từng đơn hàng.
SUM(od.quantity) AS total_items

-- FROM
-- Chỉ định bảng chính.
FROM customers c

-- JOIN
-- Ghép bảng customers với orders.
JOIN orders o

-- ON
-- Điều kiện nối.
ON c.customer_id = o.customer_id

-- JOIN
-- Ghép tiếp bảng orders với order_details.
JOIN order_details od

-- Điều kiện nối.
ON o.order_id = od.order_id

-- GROUP BY
-- Nhóm dữ liệu theo từng khách hàng.
GROUP BY

c.customer_id,

c.name

-- ORDER BY
--
-- Sắp xếp dữ liệu.
ORDER BY total_items DESC

-- LIMIT
--
-- Chỉ lấy 1 dòng đầu tiên.
LIMIT 1

";


//--------------------------------------------------------------
// query()
//
// Là phương thức của PDO.
//
// Chức năng:
// Thực thi câu lệnh SQL.
//
// Trả về:
// PDOStatement.
//
// $stmt
// Lưu kết quả truy vấn.
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
    <title>Bài 07</title>

</head>

<body>

<!--
Tiêu đề của trang.
-->
<h2>Khách hàng mua nhiều sản phẩm nhất</h2>

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

    <th>Tổng số lượng sản phẩm</th>

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
// Trả về dữ liệu dưới dạng mảng kết hợp.
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
        //
        // ["name"]
        // Lấy dữ liệu cột name.
        $row["name"];
        ?>

    </td>

    <td>

        <?=
        // Hiển thị tổng số lượng sản phẩm đã mua.
        //
        // total_items
        // Là bí danh được tạo bởi:
        // SUM(od.quantity)
        $row["total_items"];
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