<?php
session_start();

require "autoload.php";

use App\Students\StudentManager;

// Gắn sẵn 3 sinh viên cứng khi chạy lần đầu
if (!isset($_SESSION["students"])) {
    $_SESSION["students"] = [
        [
            "name" => "Nguyen Van A",
            "age" => 20,
            "studentID" => "SV001"
        ],
        [
            "name" => "Tran Thi B",
            "age" => 21,
            "studentID" => "SV002"
        ],
        [
            "name" => "Le Van C",
            "age" => 22,
            "studentID" => "SV003"
        ]
    ];
}

$studentManager = new StudentManager($_SESSION["students"]);
$message = "";
$alertClass = "alert-success";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $age = (int)$_POST["age"];
    $studentID = trim($_POST["studentID"]);

    $message = $studentManager->addStudent($name, $age, $studentID);

    if (str_contains($message, "Vui lòng") || str_contains($message, "phải") || str_contains($message, "tồn tại")) {
        $alertClass = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 08 - Ứng dụng quản lý sinh viên</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Bài 08: Ứng dụng quản lý sinh viên</h4>

            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#studentModal">
                Nhập
            </button>
        </div>

        <div class="card-body">

            <?php if ($message != "") { ?>
                <div class="alert <?php echo $alertClass; ?>">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <h5 class="mb-3">Danh sách sinh viên</h5>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Họ tên</th>
                        <th>Tuổi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php echo $studentManager->displayStudents(); ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- Modal thêm sinh viên -->
<div class="modal fade" id="studentModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" class="modal-content">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Thêm sinh viên mới</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Họ tên</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tuổi</label>
                    <input type="number" name="age" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mã sinh viên</label>
                    <input type="text" name="studentID" class="form-control" required>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-dark">Xác nhận</button>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>