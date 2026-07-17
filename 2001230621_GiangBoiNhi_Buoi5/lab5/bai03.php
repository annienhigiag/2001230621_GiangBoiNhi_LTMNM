<?php
//==============================================================
// BÀI 03
// Tìm loại hàng có trên 5 sản phẩm.
//
// Yêu cầu:
// Hiển thị:
// + Tên loại hàng.
// + Số lượng sản phẩm.
// Chỉ hiển thị loại hàng có số lượng sản phẩm > 5.
//==============================================================


//--------------------------------------------------------------
// require
//
// Là từ khóa của PHP.
//
// Chức năng:
// - Nạp file connect.php.
// - File connect.php dùng để kết nối cơ sở dữ liệu.
// - Nếu file không tồn tại thì chương trình sẽ dừng.
//--------------------------------------------------------------
require "connect.php";


//--------------------------------------------------------------
// $sql
//
// Là biến dùng để lưu câu lệnh SQL.
//
// Kiểu dữ liệu:
// String (chuỗi).
//--------------------------------------------------------------
$sql = "

-- SELECT
-- Chọn dữ liệu cần hiển thị.
SELECT

-- c là bí danh (Alias) của bảng categories.
c.category_name,

-- COUNT()
-- Là hàm tổng hợp.
-- Chức năng:
-- Đếm số lượng bản ghi.
--
-- p.product_id
-- Là cột product_id của bảng products.
COUNT(p.product_id) AS total_products

-- FROM
-- Chỉ định bảng chính.
FROM categories c

-- JOIN
-- Ghép bảng categories với bảng products.
--
-- JOIN chỉ lấy dữ liệu khớp ở cả hai bảng.
JOIN products p

-- ON
-- Điều kiện nối hai bảng.
ON c.category_id = p.category_id

-- GROUP BY
-- Nhóm dữ liệu theo tên loại hàng.
GROUP BY c.category_name

-- HAVING
-- Dùng để lọc dữ liệu sau khi GROUP BY.
HAVING COUNT(p.product_id) > 5

";


//--------------------------------------------------------------
// query()
//
// Là phương thức của đối tượng PDO.
//
// Chức năng:
// Gửi câu lệnh SQL đến MySQL.
//
// Giá trị trả về:
// PDOStatement.
//
// $stmt
// Là biến lưu kết quả truy vấn.
//--------------------------------------------------------------
$stmt = $conn->query($sql);

?>

<!DOCTYPE html>

<html>

<head>

    <!--
    meta
    Khai báo bảng mã UTF-8.
    -->
    <meta charset="UTF-8">

    <!--
    title
    Tiêu đề của trang web.
    -->
    <title>Bài 03</title>

</head>

<body>

<!--
h2
Hiển thị tiêu đề cấp 2.
-->
<h2>Loại hàng có trên 5 sản phẩm</h2>

<!--
table
Tạo bảng HTML.

border
Độ dày đường viền.

cellpadding
Khoảng cách giữa nội dung và viền ô.
-->
<table border="1" cellpadding="10">

<tr>

    <!--
    th
    Ô tiêu đề của bảng.
    -->
    <th>Loại hàng</th>

    <th>Số lượng sản phẩm</th>

</tr>

<?php

//--------------------------------------------------------------
// while
//
// Câu lệnh lặp.
//
// Chức năng:
// Lặp cho đến khi không còn dữ liệu.
//--------------------------------------------------------------
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

    //----------------------------------------------------------
    // fetch()
    //
    // Là phương thức của PDOStatement.
    //
    // Chức năng:
    // Lấy từng dòng dữ liệu từ kết quả truy vấn.
    //
    // PDO::FETCH_ASSOC
    //
    // Trả dữ liệu dưới dạng mảng kết hợp.
    //
    // Ví dụ:
    // $row["category_name"]
    //----------------------------------------------------------

?>

<tr>

    <td>

<?php
// Hiển thị tên loại hàng
echo $row["category_name"];
?>

</td>

    <td>

        <?=
        // Hiển thị số lượng sản phẩm.
        //
        // total_products
        // Là bí danh được đặt bằng AS trong SQL.
        $row["total_products"];
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