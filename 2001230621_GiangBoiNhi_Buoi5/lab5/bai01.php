<?php
//==============================================================
// BÀI 01
// Thống kê số lượng sản phẩm trong từng loại hàng.
//
// Yêu cầu:
// Hiển thị:
// + Tên loại hàng
// + Số lượng sản phẩm của từng loại
//==============================================================


//--------------------------------------------------------------
// require
//
// Là từ khóa của PHP.
//
// Chức năng:
// - Nạp file connect.php.
// - File connect.php chứa đoạn code kết nối MySQL bằng PDO.
// - Nếu file không tồn tại chương trình sẽ dừng ngay.
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
-- Hàm tổng hợp (Aggregate Function).
-- Chức năng:
-- Đếm số bản ghi.
--
-- p.product_id
-- Là cột product_id của bảng products.
COUNT(p.product_id) AS total_products

-- FROM
-- Xác định bảng chính.
FROM categories c

-- LEFT JOIN
-- Ghép bảng products với categories.
--
-- LEFT JOIN sẽ lấy toàn bộ dữ liệu của bảng categories.
-- Nếu category chưa có sản phẩm vẫn hiển thị.
LEFT JOIN products p

-- ON
-- Điều kiện nối hai bảng.
ON c.category_id = p.category_id

-- GROUP BY
-- Nhóm dữ liệu theo tên loại hàng.
GROUP BY c.category_name

";


//--------------------------------------------------------------
// query()
//
// Hàm của đối tượng PDO.
//
// Chức năng:
// Gửi câu lệnh SQL đến MySQL.
//
// $conn
// Là đối tượng PDO.
//
// ->
// Toán tử truy cập phương thức.
//
// Kết quả trả về:
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
    meta
    Khai báo bảng mã UTF-8.

    charset
    Thuộc tính quy định bảng mã.

    UTF-8
    Giúp hiển thị tiếng Việt.
    -->
    <meta charset="UTF-8">

    <!--
    title
    Tiêu đề hiển thị trên tab trình duyệt.
    -->
    <title>Bài 01</title>

</head>

<body>

<!--
h2
Tiêu đề cấp 2.
-->
<h2>Thống kê số lượng sản phẩm theo loại hàng</h2>

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
    Tạo ô tiêu đề.
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
// Tiếp tục lặp khi còn dữ liệu.
//--------------------------------------------------------------
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

    //----------------------------------------------------------
    // fetch()
    //
    // Hàm của PDOStatement.
    //
    // Chức năng:
    // Lấy từng dòng dữ liệu.
    //----------------------------------------------------------

    //----------------------------------------------------------
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

        <?=
        // <?= là cú pháp rút gọn của:
        // <?php echo

        // $row
        // Là mảng chứa dữ liệu của một dòng.

        // ["category_name"]
        // Lấy giá trị cột category_name.

        $row["category_name"]

        ?>

    </td>

    <td>

        <?=
        // Hiển thị số lượng sản phẩm.
        $row["total_products"]
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