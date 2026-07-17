<?php
// Danh sách sinh viên
$students = [
    ["hoten" => "Nguyễn Văn A", "diem" => 8.5],
    ["hoten" => "Trần Thị B", "diem" => 9.2],
    ["hoten" => "Lê Văn C", "diem" => 7.4],
    ["hoten" => "Phạm Thị D", "diem" => 8.9]
];

// Hàm tìm sinh viên có điểm cao nhất
function findMaxStudent($students) {

    // Giả sử sinh viên đầu tiên có điểm cao nhất
    $maxStudent = $students[0];

    // Duyệt qua danh sách sinh viên
    foreach ($students as $sv) {

        // Nếu điểm sinh viên hiện tại lớn hơn điểm cao nhất
        if ($sv["diem"] > $maxStudent["diem"]) {
            $maxStudent = $sv;
        }
    }

    return $maxStudent;
}

// Gọi hàm
$best = findMaxStudent($students);

// In danh sách sinh viên
echo "<h3>Danh sách sinh viên</h3>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>Họ tên</th><th>Điểm</th></tr>";

foreach ($students as $sv) {
    echo "<tr>";
    echo "<td>{$sv['hoten']}</td>";
    echo "<td>{$sv['diem']}</td>";
    echo "</tr>";
}

echo "</table>";

// In sinh viên điểm cao nhất
echo "<h3>Sinh viên có điểm cao nhất</h3>";
echo "Họ tên: {$best['hoten']}<br>";
echo "Điểm: {$best['diem']}";
?>