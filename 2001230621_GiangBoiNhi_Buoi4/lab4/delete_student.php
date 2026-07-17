<?php

/*
====================================================
BÀI 5
XÓA SINH VIÊN
====================================================
*/

// ======================================================
// Gọi file kết nối cơ sở dữ liệu.
// Sau khi require, biến $conn sẽ được sử dụng để
// thực hiện các câu lệnh SQL.
// ======================================================
require "connect.php";

/*======================================================
KIỂM TRA ID SINH VIÊN
======================================================*/

// Kiểm tra URL có truyền id hay không.
//
// Ví dụ:
//
// delete_student.php?id=5
//
// Nếu có thì tiến hành xóa.
if (isset($_GET["id"])) {

    // Lấy ID từ URL.
    $id = $_GET["id"];

    // ===================================================
    // Câu lệnh SQL xóa sinh viên.
    //
    // Dấu ? là Placeholder.
    // Giá trị thực sẽ được truyền vào execute().
    // ===================================================
    $sql = "DELETE FROM students
            WHERE id=?";

    // ===================================================
    // Chuẩn bị câu lệnh SQL.
    //
    // prepare() giúp:
    // - Chống SQL Injection.
    // - Kiểm tra cú pháp SQL.
    // ===================================================
    $stmt = $conn->prepare($sql);

    // ===================================================
    // Thực thi câu lệnh SQL.
    //
    // execute([$id])
    //
    // sẽ thay dấu ? bằng giá trị của $id.
    //
    // Ví dụ:
    //
    // $id = 5
    //
    // SQL thực tế:
    //
    // DELETE FROM students
    // WHERE id = 5;
    // ===================================================
    $stmt->execute([$id]);
}

/*======================================================
CHUYỂN VỀ DANH SÁCH SINH VIÊN
======================================================*/

// Sau khi xóa thành công,
// chuyển về trang danh sách sinh viên.
//
// header()
// dùng để chuyển hướng sang trang khác.
header("Location:list_students.php");

// ======================================================
// Dừng chương trình ngay sau khi chuyển trang.
//
// exit()
// giúp chương trình không thực hiện
// các lệnh phía dưới (nếu có).
// ======================================================
exit();

?>