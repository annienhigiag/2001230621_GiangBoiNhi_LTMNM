<?php
// ==========================================================
// File: connect.php
// Chức năng:
// - Kết nối chương trình PHP với cơ sở dữ liệu MySQL.
// - Sử dụng thư viện PDO (PHP Data Objects).
// - File này sẽ được các bài 01 → 07 sử dụng thông qua require.
// ==========================================================


// ----------------------------------------------------------
// Khai báo biến $host
//
// $host:
// - Là biến lưu địa chỉ máy chủ MySQL.
// - localhost nghĩa là MySQL đang chạy trên chính máy tính.
// ----------------------------------------------------------
$host = "localhost";


// ----------------------------------------------------------
// Khai báo tên cơ sở dữ liệu.
//
// $dbname:
// - Lưu tên database cần kết nối.
// - Phải đúng với tên đã tạo trong database.sql.
// ----------------------------------------------------------
$dbname = "lab3_shop";


// ----------------------------------------------------------
// Khai báo tên đăng nhập MySQL.
//
// $username:
// - Là tài khoản đăng nhập MySQL.
// - Laragon, XAMPP thường mặc định là root.
// ----------------------------------------------------------
$username = "Annie";


// ----------------------------------------------------------
// Khai báo mật khẩu MySQL.
//
// $password:
// - Lưu mật khẩu tài khoản root.
// - Nếu dùng Laragon hoặc XAMPP mặc định thường để rỗng.
// ----------------------------------------------------------
$password = "1234";


// ----------------------------------------------------------
// try
//
// try là cấu trúc xử lý ngoại lệ.
//
// Chức năng:
// - Thử thực hiện đoạn code bên trong.
// - Nếu có lỗi sẽ chuyển sang catch.
// ----------------------------------------------------------
try
{

    // ------------------------------------------------------
    // new PDO()
    //
    // new:
    // - Tạo một đối tượng mới.
    //
    // PDO:
    // - Là lớp (Class) có sẵn của PHP.
    // - Dùng để kết nối nhiều hệ quản trị CSDL.
    //
    // $conn:
    // - Là biến lưu đối tượng PDO.
    // - Các bài sau sẽ dùng $conn để truy vấn SQL.
    // ------------------------------------------------------
    $conn = new PDO(

        // --------------------------------------------------
        // "mysql:host=$host;dbname=$dbname;charset=utf8"
        //
        // mysql:
        // - Chỉ định sử dụng hệ quản trị MySQL.
        //
        // host=$host
        // - Địa chỉ máy chủ MySQL.
        //
        // dbname=$dbname
        // - Tên cơ sở dữ liệu.
        //
        // charset=utf8
        // - Thiết lập bảng mã UTF-8.
        // - Giúp hiển thị tiếng Việt không bị lỗi font.
        // --------------------------------------------------
        "mysql:host=$host;dbname=$dbname;charset=utf8",

        // -----------------------------------------------
        // $username
        // - Tên đăng nhập MySQL.
        // -----------------------------------------------
        $username,

        // -----------------------------------------------
        // $password
        // - Mật khẩu MySQL.
        // -----------------------------------------------
        $password

    );


    // ------------------------------------------------------
    // setAttribute()
    //
    // Hàm của PDO.
    //
    // Chức năng:
    // - Thiết lập thuộc tính cho đối tượng PDO.
    // ------------------------------------------------------
    $conn->setAttribute(

        // -----------------------------------------------
        // PDO::ATTR_ERRMODE
        //
        // ::
        // - Toán tử truy cập hằng số (constant).
        //
        // ATTR_ERRMODE
        // - Thuộc tính quản lý cách PDO xử lý lỗi.
        // -----------------------------------------------
        PDO::ATTR_ERRMODE,

        // -----------------------------------------------
        // PDO::ERRMODE_EXCEPTION
        //
        // ERRMODE_EXCEPTION
        // - Nếu xảy ra lỗi SQL sẽ phát sinh Exception.
        // - Dễ kiểm tra và xử lý lỗi hơn.
        // -----------------------------------------------
        PDO::ERRMODE_EXCEPTION

    );

}
// ----------------------------------------------------------
// catch
//
// Nếu có lỗi trong khối try
// chương trình sẽ chạy vào đây.
// ----------------------------------------------------------
catch(PDOException $e)
{

    // ------------------------------------------------------
    // PDOException
    //
    // Là lớp ngoại lệ của PDO.
    //
    // $e
    // - Biến lưu thông tin lỗi.
    // ------------------------------------------------------


    // ------------------------------------------------------
    // die()
    //
    // Hàm của PHP.
    //
    // Chức năng:
    // - Hiển thị thông báo.
    // - Dừng chương trình ngay lập tức.
    // ------------------------------------------------------
    die(

        // -----------------------------------------------
        // getMessage()
        //
        // Hàm của Exception.
        //
        // Chức năng:
        // - Lấy nội dung lỗi.
        // -----------------------------------------------
        "Kết nối thất bại: " . $e->getMessage()

    );

}

?>