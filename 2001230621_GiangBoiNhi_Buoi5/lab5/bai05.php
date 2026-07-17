<?php
//==============================================================
// BÀI 05
// Tìm sản phẩm có giá cao nhất trong từng loại hàng.
//
// Yêu cầu:
// - Hiển thị:
//   + Tên loại hàng.
//   + Tên sản phẩm.
//   + Giá sản phẩm.
// - Mỗi loại hàng chỉ hiển thị sản phẩm có giá cao nhất.
//==============================================================


//--------------------------------------------------------------
// require
//
// Là từ khóa của PHP.
//
// Chức năng:
// - Nạp file connect.php.
// - File connect.php dùng để kết nối MySQL bằng PDO.
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

-- c là bí danh (Alias) của bảng categories.
c.category_name,

-- p là bí danh của bảng products.
-- Lấy tên sản phẩm.
p.name,

-- Lấy giá sản phẩm.
p.price

-- FROM
-- Chọn bảng chính.
FROM products p

-- JOIN
-- Ghép bảng products với categories.
JOIN categories c

-- ON
-- Điều kiện nối.
ON p.category_id = c.category_id

-- WHERE
-- Lọc dữ liệu.
WHERE p.price = (

    -- SELECT
    -- Truy vấn con (Subquery).
    -- Tìm giá lớn nhất.
    SELECT MAX(p2.price)

    -- MAX()
    -- Hàm tổng hợp.
    -- Chức năng:
    -- Tìm giá trị lớn nhất.

    FROM products p2

    -- WHERE
    -- Chỉ tìm trong cùng loại sản phẩm.
    WHERE p2.category_id = p.category_id

)

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

    <!-- Tiêu đề trang -->
    <title>Bài 05</title>

</head>

<body>

<!-- Tiêu đề -->
<h2>Sản phẩm có giá cao nhất của từng loại hàng</h2>

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

    <th>Tên sản phẩm</th>

    <th>Giá bán</th>

</tr>

<?php

//--------------------------------------------------------------
// while
//
// Lặp cho đến khi hết dữ liệu.
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
        // Hiển thị tên loại hàng.
        //
        // $row
        // Mảng chứa dữ liệu của một dòng.
        //
        // ["category_name"]
        // Lấy giá trị cột category_name.
        $row["category_name"];
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
        // number_format()
        //
        // Hàm của PHP.
        //
        // Chức năng:
        // Định dạng số có dấu phân cách hàng nghìn.
        //
        // Ví dụ:
        // 33990000
        //
        // Thành:
        // 33,990,000
        number_format($row["price"]);
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