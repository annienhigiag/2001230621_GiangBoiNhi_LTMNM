<?php
// Lấy giá trị name từ dữ liệu POST, nếu không có thì dùng giá trị Bạn
$name = $_POST['name'] ?? 'Bạn';

// Trả về câu xin chào và dùng htmlspecialchars để xử lý ký tự đặc biệt
echo "Xin chào, " . htmlspecialchars($name);
?>