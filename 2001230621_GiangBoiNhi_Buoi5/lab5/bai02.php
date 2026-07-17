<?php
//==============================================================
// BÀI 02
// Tính tổng doanh thu từng ngày.
//
// Yêu cầu:
// Hiển thị:
// + Ngày đặt hàng
// + Tổng doanh thu của từng ngày
//==============================================================


//--------------------------------------------------------------
// require
//
// Chức năng:
// - Nạp file connect.php.
// - File connect.php chứa đoạn code kết nối MySQL.
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

-- o là bí danh (Alias) của bảng orders.
o.order_date,

-- SUM()
-- Hàm tổng hợp.
-- Chức năng:
-- Tính tổng các giá trị.
--
-- od.quantity
-- Số lượng sản phẩm.
--
-- *
-- Toán tử nhân.
--
-- od.price
-- Giá bán của sản phẩm.
SUM(od.quantity * od.price) AS total_revenue

-- FROM
-- Chọn bảng chính.
FROM orders o

-- JOIN
-- Ghép bảng orders với order_details.
--
-- JOIN chỉ lấy những bản ghi có dữ liệu ở cả hai bảng.
JOIN order_details od

-- ON
-- Điều kiện nối.
ON o.order_id = od.order_id

-- GROUP BY
-- Nhóm dữ liệu theo ngày đặt hàng.
GROUP BY o.order_date

";


//--------------------------------------------------------------
// query()
//
// Hàm của đối tượng PDO.
//
// Chức năng:
// Thực thi câu lệnh SQL.
//
// Giá trị trả về:
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
    -->
    <meta charset="UTF-8">

    <!--
    Tiêu đề trang web.
    -->
    <title>Bài 02</title>

</head>

<body>

<!--
Tiêu đề hiển thị trên trang.
-->
<h2>Tổng doanh thu từng ngày</h2>

<!--
table
Tạo bảng HTML.

border
Đường viền.

cellpadding
Khoảng cách giữa nội dung và viền.
-->
<table border="1" cellpadding="10">

<tr>

    <!-- Tiêu đề cột -->
    <th>Ngày đặt hàng</th>

    <th>Tổng doanh thu</th>

</tr>

<?php

//--------------------------------------------------------------
// while
//
// Lặp đến khi hết dữ liệu.
//--------------------------------------------------------------
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

    //----------------------------------------------------------
    // fetch()
    //
    // Lấy từng dòng dữ liệu.
    //
    // PDO::FETCH_ASSOC
    // Trả dữ liệu dạng mảng kết hợp.
    //----------------------------------------------------------

?>

<tr>

    <td>

        <?=
        // Hiển thị ngày đặt hàng.
        //
        // $row
        // Mảng chứa dữ liệu của một dòng.
        //
        // ["order_date"]
        // Lấy cột order_date.
        $row["order_date"]
        ?>

    </td>

    <td>

        <?=
        // number_format()
        //
        // Hàm của PHP.
        //
        // Chức năng:
        // Định dạng số.
        //
        // Ví dụ:
        // 44880000
        //
        // thành
        //
        // 44,880,000
        //
        // $row["total_revenue"]
        // Là tổng doanh thu.
        number_format($row["total_revenue"])
        ?>

        VNĐ

    </td>

</tr>

<?php

// Kết thúc vòng lặp while.
}

?>

</table>

</body>

</html>