<?php

// Gọi file kết nối cơ sở dữ liệu.
// Sau khi require, biến $conn sẽ được sử dụng để truy vấn MySQL.
require "connect.php";

// ===============================
// Khởi tạo biến từ khóa tìm kiếm.
// Ban đầu chuỗi rỗng.
// ===============================
$keyword = "";

// ===============================
// Khởi tạo mảng lưu danh sách sinh viên.
// Nếu chưa tìm kiếm thì mảng sẽ rỗng.
// ===============================
$students = [];

// =====================================================
// Kiểm tra xem người dùng đã nhấn nút Tìm kiếm hay chưa.
// Nếu URL có tham số keyword thì thực hiện tìm kiếm.
// Ví dụ:
// search_students.php?keyword=An
// =====================================================
if (isset($_GET["keyword"])) {

    // Lấy giá trị từ ô nhập.
    // trim() dùng để loại bỏ khoảng trắng ở đầu và cuối chuỗi.
    $keyword = trim($_GET["keyword"]);

    // ===================================================
    // Câu lệnh SQL tìm kiếm sinh viên theo tên.
    // Dấu ? là Placeholder dùng với Prepared Statement.
    // ===================================================
    $sql = "SELECT *
            FROM students
            WHERE name LIKE ?";

    // ===================================================
    // Chuẩn bị câu lệnh SQL.
    // prepare() giúp chống SQL Injection.
    // ===================================================
    $stmt = $conn->prepare($sql);

    // ===================================================
    // Thực thi câu lệnh SQL.
    // execute() sẽ thay dấu ? bằng giá trị truyền vào.
    //
    // Ví dụ:
    // Nếu người dùng nhập: An
    //
    // SQL thực tế sẽ là:
    // SELECT * FROM students
    // WHERE name LIKE '%An%'
    //
    // Dấu % giúp tìm kiếm gần đúng.
    // ===================================================
    $stmt->execute([
        "%" . $keyword . "%"
    ]);

    // ===================================================
    // Lấy toàn bộ kết quả tìm kiếm.
    //
    // fetchAll():
    // lấy tất cả bản ghi.
    //
    // PDO::FETCH_ASSOC:
    // trả về mảng kết hợp.
    //
    // Ví dụ:
    //
    // $row["name"]
    // $row["email"]
    //
    // ===================================================
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>Tìm kiếm sinh viên</title>

    <!-- Bootstrap giúp giao diện đẹp hơn -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<!-- mt-4 tạo khoảng cách phía trên -->
<body class="container mt-4">

    <!-- Tiêu đề -->
    <h2 class="text-primary">

        TÌM KIẾM SINH VIÊN

    </h2>

    <!-- ==========================================
         Form tìm kiếm
         method="get"
         Sau khi nhấn tìm sẽ truyền dữ liệu lên URL
         ========================================== -->
    <form method="get">

        <div class="row">

            <!-- Ô nhập tên -->
            <div class="col-md-6">

                <input

                    type="text"

                    name="keyword"

                    class="form-control"

                    placeholder="Nhập tên sinh viên"

                    value="<?= htmlspecialchars($keyword) ?>">

                <!--
                htmlspecialchars()
                giúp chống chèn mã HTML.
                Đồng thời giữ nguyên giá trị sau khi tìm kiếm.
                -->

            </div>

            <!-- Nút tìm kiếm -->
            <div class="col-md-2">

                <button class="btn btn-primary">

                    Tìm kiếm

                </button>

            </div>

        </div>

    </form>

    <br>

    <!-- ==========================================
         Bảng hiển thị kết quả tìm kiếm
         ========================================== -->
    <table class="table table-bordered table-hover">

        <tr>

            <th>ID</th>

            <th>Họ tên</th>

            <th>Email</th>

            <th>SĐT</th>

            <th>Ngày sinh</th>

        </tr>

        <?php

        // =====================================
        // Duyệt toàn bộ sinh viên tìm được.
        // Mỗi vòng lặp tương ứng 1 dòng.
        // =====================================
        foreach ($students as $row) {

        ?>

            <tr>

                <!-- Hiển thị ID -->
                <td>

                    <?= $row["id"] ?>

                </td>

                <!-- Hiển thị Họ tên -->
                <td>

                    <?= htmlspecialchars($row["name"]) ?>

                </td>

                <!-- Hiển thị Email -->
                <td>

                    <?= htmlspecialchars($row["email"]) ?>

                </td>

                <!-- Hiển thị SĐT -->
                <td>

                    <?= htmlspecialchars($row["phone"]) ?>

                </td>

                <!-- Hiển thị Ngày sinh -->
                <td>

                    <?= $row["birthday"] ?>

                </td>

            </tr>

        <?php

        }

        ?>

        <!-- ==========================================
             Nếu không tìm thấy dữ liệu
             ========================================== -->
        <?php if (count($students) == 0 && $keyword != "") { ?>

            <tr>

                <td colspan="5" class="text-center text-danger">

                    Không tìm thấy sinh viên phù hợp.

                </td>

            </tr>

        <?php } ?>

    </table>

    <!-- Nút quay lại -->
    <a
        href="list_students.php"
        class="btn btn-success">

        Quay lại

    </a>

</body>

</html>