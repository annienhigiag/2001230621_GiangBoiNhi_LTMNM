<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {

    // Lấy nội dung người dùng nhập
    $content = trim($_POST['content']);

    // Tạo dòng dữ liệu để lưu
    $line = date("Y-m-d H:i:s") . " - " . str_replace(["\r", "\n"], "", $content) . PHP_EOL;

    // Ghi thêm vào file note.txt
    file_put_contents('data/note.txt', $line, FILE_APPEND | LOCK_EX);

    echo "Đã lưu nội dung.<hr>";

    // Hiển thị toàn bộ nội dung đã lưu
    echo "<h3>Toàn bộ nội dung</h3>";
    echo "<pre>" . htmlspecialchars(file_get_contents('data/note.txt')) . "</pre>";

} else {
    echo "Vui lòng nhập nội dung.";
}
?>