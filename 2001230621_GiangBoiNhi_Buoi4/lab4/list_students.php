<?php
/*
======================================================
BÀI 7
PHÂN TRANG + TÌM KIẾM
======================================================
*/

// ======================================================
// Gọi file kết nối CSDL.
// Sau khi require, biến $conn sẽ được sử dụng để
// thực hiện các truy vấn MySQL.
// ======================================================
require "connect.php";

/*======================================================
LẤY TỪ KHÓA TÌM KIẾM
======================================================*/

// Nếu người dùng nhập từ khóa thì lấy giá trị.
// trim() loại bỏ khoảng trắng đầu và cuối chuỗi.
//
// Ví dụ:
// list_students.php?keyword=An
//
$keyword = isset($_GET["keyword"])
    ? trim($_GET["keyword"])
    : "";

/*======================================================
THIẾT LẬP PHÂN TRANG
======================================================*/

// Mỗi trang hiển thị 5 sinh viên.
$limit = 5;

/*======================================================
LẤY TRANG HIỆN TẠI
======================================================*/

// Nếu URL có page thì lấy page.
// Nếu không thì mặc định trang 1.
//
// Ví dụ:
//
// page=1
// page=2
//
$page = isset($_GET["page"])
    ? (int) $_GET["page"]
    : 1;

// Không cho phép nhỏ hơn 1.
if ($page < 1) {

    $page = 1;

}

/*======================================================
TÍNH OFFSET
======================================================*/

// OFFSET là vị trí bắt đầu lấy dữ liệu.
//
// Công thức:
//
// (trang hiện tại - 1) × số dòng mỗi trang
//
// Ví dụ:
//
// Trang 1
// offset = 0
//
// Trang 2
// offset = 5
//
// Trang 3
// offset = 10
//
$offset = ($page - 1) * $limit;

/*======================================================
ĐẾM TỔNG SỐ SINH VIÊN
======================================================*/

// Đếm tổng số sinh viên có tên phù hợp.
$sqlCount = "
SELECT COUNT(*)
FROM students
WHERE name LIKE ?
";

// Chuẩn bị câu lệnh SQL.
$stmtCount = $conn->prepare($sqlCount);

// Thực thi.
//
// Dấu % giúp tìm kiếm gần đúng.
//
// Ví dụ:
//
// keyword = An
//
// SQL:
//
// WHERE name LIKE '%An%'
//
$stmtCount->execute([
    "%" . $keyword . "%"
]);

// Lấy số lượng sinh viên.
$totalRecords = $stmtCount->fetchColumn();

// Tính tổng số trang.
//
// Ví dụ:
//
// Có 23 sinh viên.
//
// Mỗi trang 5 sinh viên.
//
// ceil(23/5)
//
// = 5 trang.
//
$totalPages = ceil($totalRecords / $limit);

/*======================================================
LẤY DANH SÁCH SINH VIÊN
======================================================*/

$sql = "

SELECT *

FROM students

WHERE name LIKE ?

ORDER BY id DESC

LIMIT ?

OFFSET ?

";

// Chuẩn bị câu lệnh SQL.
$stmt = $conn->prepare($sql);

// Gán giá trị cho tham số thứ nhất.
//
// PDO::PARAM_STR
//
// Vì keyword là chuỗi.
$stmt->bindValue(
    1,
    "%" . $keyword . "%",
    PDO::PARAM_STR
);

// Gán số dòng cần lấy.
//
// LIMIT
//
// Là kiểu số nguyên.
$stmt->bindValue(
    2,
    $limit,
    PDO::PARAM_INT
);

// Gán OFFSET.
//
// Là kiểu số nguyên.
$stmt->bindValue(
    3,
    $offset,
    PDO::PARAM_INT
);

// Thực thi câu lệnh SQL.
$stmt->execute();

// Lấy toàn bộ danh sách sinh viên.
//
// fetchAll()
// lấy tất cả dữ liệu.
//
// PDO::FETCH_ASSOC
// trả về dạng mảng kết hợp.
//
// Ví dụ:
//
// $row["name"]
// $row["email"]
//
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>