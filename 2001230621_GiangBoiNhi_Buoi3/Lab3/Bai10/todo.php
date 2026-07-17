<?php
// Tên file JSON lưu công việc
$file = 'tasks.json';

// Nếu file chưa tồn tại
if (!file_exists($file)) {
    // Tạo file với mảng JSON rỗng
    file_put_contents($file, '[]');
}

// Đọc nội dung file
$content = file_get_contents($file);

// Chuyển JSON thành mảng PHP
$tasks = json_decode($content, true);

// Kiểm tra có action gửi bằng POST
if (isset($_POST['action'])) {
    // Lấy action
    $action = $_POST['action'];

    // Nếu action là add
    if ($action === 'add') {
        // Thêm công việc mới
        $tasks[] = [
            // Tạo id duy nhất
            'id' => uniqid(),
            // Lấy nội dung công việc
            'text' => $_POST['text'],
            // Trạng thái ban đầu là chưa hoàn thành
            'completed' => false
        ];
    }

    // Nếu action là toggle
    if ($action === 'toggle') {
        // Duyệt từng công việc bằng tham chiếu
        foreach ($tasks as &$task) {
            // So sánh id
            if ($task['id'] === $_POST['id']) {
                // Đảo trạng thái hoàn thành
                $task['completed'] = !$task['completed'];
            }
        }
    }

    // Nếu action là delete
    if ($action === 'delete') {
        // Lọc bỏ công việc có id cần xóa
        $tasks = array_filter(
            $tasks,
            fn($task) => $task['id'] !== $_POST['id']
        );

        // Đánh lại chỉ số mảng
        $tasks = array_values($tasks);
    }

    // Lưu danh sách mới vào file
    file_put_contents($file, json_encode($tasks));
}

// Khai báo kiểu dữ liệu JSON
header('Content-Type: application/json');

// Trả danh sách công việc
echo json_encode($tasks);
?>