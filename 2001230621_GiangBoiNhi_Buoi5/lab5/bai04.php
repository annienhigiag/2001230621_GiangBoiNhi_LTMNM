<?php
//==============================================================
// BÀI 04
// Danh sách khách hàng và tổng tiền đã mua.
//
// Yêu cầu:
// - Hiển thị:
//   + Mã khách hàng (customer_id)
//   + Tên khách hàng (name)
//   + Tổng số tiền đã mua (total_spent)
// - Chỉ hiển thị khách hàng có tổng chi tiêu > 1.000.000 đồng.
//==============================================================


//--------------------------------------------------------------
// require
//
// Là từ khóa của PHP.
//
// Chức năng:
// - Nạp file connect.php.
// - File này dùng để kết nối CSDL MySQL.
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

-- c là bí danh của bảng customers.
c.customer_id,

-- Lấy tên khách hàng.
c.name,

-- SUM()
-- Hàm tổng hợp.
-- Chức năng:
-- Tính tổng tất cả giá trị.
--
-- od.quantity
-- Số lượng sản phẩm.
--
-- *
-- Toán tử nhân.
--
-- od.price
-- Giá của sản phẩm.
SUM(od.quantity * od.price) AS total_spent

-- FROM
-- Chỉ định bảng chính.
FROM customers c

-- JOIN
-- Ghép bảng customers với orders.
JOIN orders o

-- ON
-- Điều kiện nối hai bảng.
ON c.customer_id = o.customer_id

-- JOIN
-- Ghép tiếp bảng orders với order_details.
JOIN order_details od

-- Điều kiện nối.
ON o.order_id = od.order_id

-- GROUP BY
-- Nhóm dữ liệu theo mã khách hàng và tên khách hàng.
GROUP BY
c.customer_id,
c.name

-- HAVING
-- Lọc dữ liệu sau khi GROUP BY.
HAVING total_spent > 1000000

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
    Tiêu đề của trang web.
    -->
    <title>Bài 04</title>

</head>

<body>

<!-- Tiêu đề -->
<h2>Danh sách khách hàng có tổng chi tiêu trên 1.000.000 đồng</h2>

<!--
table
Tạo bảng HTML.

border
Đường viền.

cellpadding
Khoảng cách giữa chữ và viền.
-->
<table border="1" cellpadding="10">

<tr>

    <!-- Tiêu đề cột -->
    <th>Mã khách hàng</th>

    <th>Tên khách hàng</th>

    <th>Tổng tiền đã mua</th>

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
// Trả về mảng kết hợp.
//--------------------------------------------------------------
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

?>

<tr>

    <td>

        <?=
        // Hiển thị mã khách hàng.
        //
        // $row
        // Là mảng chứa dữ liệu.
        //
        // ["customer_id"]
        // Lấy cột customer_id.
        $row["customer_id"];
        ?>

    </td>

    <td>

        <?=
        // Hiển thị tên khách hàng.
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
        // Định dạng số có dấu phẩy phân cách hàng nghìn.
        //
        // Ví dụ:
        // 44880000
        //
        // Thành:
        // 44,880,000
        number_format($row["total_spent"]);
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