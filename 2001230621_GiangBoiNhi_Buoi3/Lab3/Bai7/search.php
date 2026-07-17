<?php
// Lấy từ khóa q từ URL, nếu không có thì dùng chuỗi rỗng
$keyword = strtolower($_GET['q'] ?? '');

// Khai báo danh sách sản phẩm
$products = [
    ["name" => "Iphone 15", "price" => 30000000],
    ["name" => "Samsung S24", "price" => 25000000]
];

// Lọc sản phẩm có tên chứa từ khóa
$result = array_filter(
    $products,
    fn($p) => strpos(strtolower($p['name']), $keyword) !== false
);

// Thiết lập kiểu dữ liệu trả về là JSON
header('Content-Type: application/json');

// Chuyển kết quả thành JSON và trả về
echo json_encode(array_values($result));
?>