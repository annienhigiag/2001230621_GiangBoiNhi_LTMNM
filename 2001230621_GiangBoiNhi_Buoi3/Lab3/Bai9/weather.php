<?php
// Lấy tên thành phố từ URL và chuyển thành chữ thường
$city = strtolower($_GET['city'] ?? '');

// Khai báo dữ liệu thời tiết giả
$data = [
    "hanoi" => ["temp" => 30, "desc" => "Nắng đẹp"],
    "danang" => ["temp" => 32, "desc" => "Có mây"],
];

// Thiết lập kiểu dữ liệu trả về là JSON
header('Content-Type: application/json');

// Nếu có thành phố thì trả dữ liệu tương ứng, nếu không thì trả dữ liệu mặc định
echo json_encode($data[$city] ?? ["temp" => 0, "desc" => "Không có dữ liệu"]);
?>