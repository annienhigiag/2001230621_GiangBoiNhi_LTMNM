<?php
// Hàm autoload tự động nạp class theo namespace App
spl_autoload_register(function ($class) {
    // Tiền tố namespace cần xử lý
    $prefix = "App\\";

    // Thư mục gốc chứa namespace App
    $baseDir = __DIR__ . "/app/";

    // Kiểm tra class có bắt đầu bằng App\ không
    $length = strlen($prefix);

    if (strncmp($prefix, $class, $length) !== 0) {
        return;
    }

    // Lấy phần còn lại sau App\
    $relativeClass = substr($class, $length);

    // Đổi dấu \ thành / để tạo đường dẫn file
    $file = $baseDir . str_replace("\\", "/", $relativeClass) . ".php";

    // Nếu file tồn tại thì require file đó
    if (file_exists($file)) {
        require $file;
    }
});
?>