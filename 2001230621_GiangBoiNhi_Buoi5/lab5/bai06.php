<?php
//==============================================================
// BÀI 06
// Liệt kê sản phẩm chưa từng được đặt hàng.
//
// Yêu cầu:
// - Hiển thị:
//   + Mã sản phẩm (product_id)
//   + Tên sản phẩm (name)
// - Chỉ hiển thị những sản phẩm chưa xuất hiện
//   trong bảng order_details.
//==============================================================


//--------------------------------------------------------------
// require
//
// Là từ khóa của PHP.
//
// Chức năng:
// - Nạp file connect.php.
// - File connect.php dùng để kết nối MySQL.
// - Nếu file không tồn tại chương trình sẽ dừng.
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
p.name

-- FROM
-- Chỉ định bảng chính.
FROM products p

-- LEFT JOIN
--
-- Ghép bảng products với bảng order_details.
--
-- LEFT JOIN sẽ lấy tất cả dữ liệu của bảng products.
--
-- Nếu sản phẩm chưa có đơn hàng
-- thì các cột của bảng order_details sẽ có giá trị NULL.
LEFT JOIN order_details od

-- ON
-- Điều kiện nối hai bảng.
ON p.product_id = od.product_id

-- WHERE
-- Lọc dữ liệu.
WHERE od.product_id IS NULL

";


//--------------------------------------------------------------
// query()
//
// Là phương thức của đối tượng PDO.
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
    <title>Bài 06</title>

</head>

<body>

<!--
Tiêu đề của trang.
-->
<h2>Danh sách sản phẩm chưa từng được đặt hàng</h2>

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

</tr>

<?php

//--------------------------------------------------------------
// while
//
// Câu lệnh lặp.
//
// Chức năng:
// Lặp cho đến khi không còn dữ liệu.
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

// Hiển thị mã sản phẩm

$row["product_id"];

?>

</td>

    <td>

        <?=
        // Hiển thị tên sản phẩm.
        //
        // ["name"]
        // Lấy cột name.
        $row["name"];
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