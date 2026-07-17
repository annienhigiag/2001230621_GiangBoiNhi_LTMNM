<?php

// Địa chỉ máy chủ MySQL
$host = "127.0.0.1";

// Tài khoản MySQL giống trong HeidiSQL
$user = "Annie";

// Mật khẩu của tài khoản Annie
$pass = "1234";

// Tên cơ sở dữ liệu
$db = "userdb";

// Cổng MySQL
$port = 3306;

// Tạo kết nối MySQL
$conn = new mysqli(
    $host,
    $user,
    $pass,
    $db,
    $port
);

// Kiểm tra lỗi kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập bảng mã UTF-8 để lưu tiếng Việt
$conn->set_charset("utf8mb4");

// Lấy tên đăng nhập từ dữ liệu POST
$username = trim($_POST["username"] ?? "");

// Lấy email từ dữ liệu POST
$email = trim($_POST["email"] ?? "");

// Lấy mật khẩu từ dữ liệu POST
$password = $_POST["password"] ?? "";

// Kiểm tra dữ liệu rỗng
if ($username === "" || $email === "" || $password === "") {
    echo "Dữ liệu không hợp lệ!";
    $conn->close();
    exit;
}

// Kiểm tra email bằng PHP
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email không hợp lệ!";
    $conn->close();
    exit;
}

// Kiểm tra độ dài mật khẩu
if (strlen($password) < 6) {
    echo "Mật khẩu phải có ít nhất 6 ký tự!";
    $conn->close();
    exit;
}

// Kiểm tra tên đăng nhập hoặc email đã tồn tại
$check = $conn->prepare(
    "SELECT id
     FROM users
     WHERE username = ? OR email = ?"
);

// Gắn dữ liệu vào câu lệnh kiểm tra
$check->bind_param(
    "ss",
    $username,
    $email
);

// Thực thi câu lệnh kiểm tra
$check->execute();

// Lưu kết quả kiểm tra
$check->store_result();

// Nếu tìm thấy tài khoản trùng
if ($check->num_rows > 0) {
    echo "Tên đăng nhập hoặc email đã tồn tại!";
    $check->close();
    $conn->close();
    exit;
}

// Đóng câu lệnh kiểm tra
$check->close();

// Mã hóa mật khẩu trước khi lưu
$hash = password_hash(
    $password,
    PASSWORD_DEFAULT
);

// Chuẩn bị câu lệnh thêm tài khoản
$stmt = $conn->prepare(
    "INSERT INTO users
        (username, email, password)
     VALUES
        (?, ?, ?)"
);

// Gắn dữ liệu vào câu lệnh SQL
$stmt->bind_param(
    "sss",
    $username,
    $email,
    $hash
);

// Thực thi câu lệnh thêm dữ liệu
if ($stmt->execute()) {
    echo "Đăng ký thành công!";
} else {
    echo "Lỗi: " . $stmt->error;
}

// Đóng câu lệnh
$stmt->close();

// Đóng kết nối MySQL
$conn->close();

?>