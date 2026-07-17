<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 4 - Quản lý sinh viên</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, .2);
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: .3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .2);
        }

        .card-title {
            font-weight: bold;
        }

        footer {
            margin-top: 50px;
            color: #666;
        }
    </style>

</head>

<body>

    <!-- Thanh tiêu đề -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand fs-4 fw-bold">
                <i class="bi bi-mortarboard-fill"></i>
                LẬP TRÌNH MÃ NGUỒN MỞ - LAB 4
            </span>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold">HỆ THỐNG QUẢN LÝ SINH VIÊN</h2>

            <p class="text-muted">
                Tương tác Cơ sở dữ liệu MySQL bằng PHP và PDO
            </p>
        </div>

        <div class="row g-4">

            <!-- Bài 1 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-plug-fill text-primary" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 1
                        </h5>

                        <p>Kết nối CSDL bằng PDO</p>

                        <a href="bai1_connect.php" class="btn btn-primary">
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

            <!-- Bài 2 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-database-fill text-success" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 2
                        </h5>

                        <p>Tạo CSDL và bảng students</p>

                        <button class="btn btn-success" disabled>
                            Thực hiện trong phpMyAdmin
                        </button>

                    </div>
                </div>
            </div>

            <!-- Bài 3 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-table text-info" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 3
                        </h5>

                        <p>Hiển thị danh sách sinh viên</p>

                        <a href="list_students.php" class="btn btn-info text-white">
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

            <!-- Bài 4 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-person-plus-fill text-success" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 4
                        </h5>

                        <p>Thêm sinh viên</p>

                        <a href="add_student.php" class="btn btn-success">
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

            <!-- Bài 5 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-trash-fill text-danger" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 5
                        </h5>

                        <p>Xóa sinh viên</p>

                        <a href="list_students.php" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

            <!-- Bài 6 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-pencil-square text-warning" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 6
                        </h5>

                        <p>Cập nhật sinh viên</p>

                        <a href="list_students.php" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

            <!-- Bài 7 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-list-ol text-primary" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 7
                        </h5>

                        <p>Phân trang</p>

                        <a href="list_students.php" class="btn btn-primary">
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

            <!-- Bài 8 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-calendar-date text-secondary" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 8
                        </h5>

                        <p>Birthday</p>

                        <a href="add_student.php" class="btn btn-secondary">
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

            <!-- Bài 9 -->
            <div class="col-md-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-search text-dark" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 9
                        </h5>

                        <p>Tìm kiếm sinh viên</p>

                        <a href="search_students.php" class="btn btn-dark">
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

            <!-- Bài 10 -->
            <div class="col-md-6">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-shield-check text-success" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 10
                        </h5>

                        <p>Prepared Statement</p>

                        <button class="btn btn-success" disabled>
                            Đã áp dụng trong toàn bộ Project
                        </button>

                    </div>
                </div>
            </div>

            <!-- Bài 11 -->
            <div class="col-md-6">
                <div class="card shadow h-100">
                    <div class="card-body text-center">

                        <i class="bi bi-sort-alpha-down text-primary" style="font-size:50px"></i>

                        <h5 class="card-title mt-3">
                            Bài 11
                        </h5>

                        <p>Sắp xếp danh sách</p>

                        <a href="sort_students.php" class="btn btn-primary">
                            Mở bài
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <footer class="text-center">
            <hr>

            <strong>Trường Đại học Công Thương TP.HCM</strong>

            <br>

            Học phần: Lập trình mã nguồn mở - Lab 4

            <br>

            Sinh viên thực hiện: <b>2001230621 - Giang Bội Nhi</b>
        </footer>

    </div>

</body>

</html>