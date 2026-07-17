<?php
// Khai báo tên file lưu tin nhắn
$file = 'chat.txt';

// Kiểm tra có dữ liệu msg gửi bằng POST hay không
if (isset($_POST['msg'])) {
    // Ghi tin nhắn vào cuối file và xuống dòng
    file_put_contents($file, $_POST['msg'] . "\n", FILE_APPEND);
}

// Nếu file tồn tại thì đọc các dòng, nếu không thì dùng mảng rỗng
$messages = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];

// Thiết lập kiểu dữ liệu trả về là JSON
header('Content-Type: application/json');

// Trả về danh sách tin nhắn dưới dạng JSON
echo json_encode($messages);
?>