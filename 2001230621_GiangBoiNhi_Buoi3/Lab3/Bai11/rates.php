<?php
// Đọc nội dung file rates.json
$data = file_get_contents('rates.json');

// Khai báo kiểu dữ liệu trả về là JSON
header('Content-Type: application/json');

// Trả dữ liệu JSON về JavaScript
echo $data;
?>