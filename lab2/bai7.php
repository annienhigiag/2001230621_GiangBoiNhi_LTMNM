<?php
session_start();

// Gắn sẵn 3 Ebook cứng khi chạy lần đầu
if (!isset($_SESSION["ebooks"])) {
    $_SESSION["ebooks"] = [
        [
            "title" => "Lập trình PHP cơ bản",
            "author" => "Nguyen Van A",
            "price" => 120000,
            "fileSize" => 5.5
        ],
        [
            "title" => "PHP OOP nâng cao",
            "author" => "Tran Thi B",
            "price" => 150000,
            "fileSize" => 8.2
        ],
        [
            "title" => "Thiết kế Web với PHP",
            "author" => "Le Van C",
            "price" => 180000,
            "fileSize" => 10.4
        ]
    ];
}

// Interface Downloadable
interface Downloadable {
    public function download();
}

// Class Book
class Book {
    protected $title;
    protected $author;
    protected $price;

    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getPrice() {
        return $this->price;
    }
}

// Class Ebook kế thừa Book và triển khai Downloadable
class Ebook extends Book implements Downloadable {
    private $fileSize;

    public function __construct($title, $author, $price, $fileSize) {
        parent::__construct($title, $author, $price);
        $this->fileSize = $fileSize;
    }

    public function getFileSize() {
        return $this->fileSize;
    }

    public function download() {
        return "Có thể tải xuống";
    }
}

// Class hệ thống quản lý thư viện
class LibrarySystem {
    private $ebooks;

    public function __construct(&$ebooks) {
        $this->ebooks = &$ebooks;
    }

    public function addEbook($title, $author, $price, $fileSize) {
        if ($title == "" || $author == "") {
            return "Vui lòng nhập đầy đủ tên sách và tác giả.";
        }

        if ($price < 0 || $fileSize < 0) {
            return "Giá và dung lượng file không được âm.";
        }

        $this->ebooks[] = [
            "title" => $title,
            "author" => $author,
            "price" => $price,
            "fileSize" => $fileSize
        ];

        return "Thêm Ebook vào hệ thống thành công.";
    }

    public function displayEbooks() {
        $html = "";

        foreach ($this->ebooks as $index => $item) {
            $ebook = new Ebook(
                $item["title"],
                $item["author"],
                $item["price"],
                $item["fileSize"]
            );

            $stt = $index + 1;
            $title = htmlspecialchars($ebook->getTitle());
            $author = htmlspecialchars($ebook->getAuthor());
            $price = number_format($ebook->getPrice(), 0, ",", ".");
            $fileSize = htmlspecialchars($ebook->getFileSize());
            $download = htmlspecialchars($ebook->download());

            $html .= "
                <tr>
                    <td>$stt</td>
                    <td>$title</td>
                    <td>$author</td>
                    <td>$price VNĐ</td>
                    <td>$fileSize MB</td>
                    <td><span class='badge bg-success'>$download</span></td>
                </tr>
            ";
        }

        return $html;
    }
}

$library = new LibrarySystem($_SESSION["ebooks"]);
$message = "";
$alertClass = "alert-success";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $author = trim($_POST["author"]);
    $price = (float)$_POST["price"];
    $fileSize = (float)$_POST["fileSize"];

    $message = $library->addEbook($title, $author, $price, $fileSize);

    if (str_contains($message, "Vui lòng") || str_contains($message, "không")) {
        $alertClass = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 07 - Hệ thống quản lý thư viện</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Bài 07: Hệ thống quản lý thư viện</h4>

            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#bookModal">
                Nhập
            </button>
        </div>

        <div class="card-body">

            <?php if ($message != "") { ?>
                <div class="alert <?php echo $alertClass; ?>">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <h5 class="mb-3">Danh sách Ebook trong thư viện</h5>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>STT</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                        <th>Giá</th>
                        <th>Dung lượng</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>

                <tbody>
                    <?php echo $library->displayEbooks(); ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- Modal nhập Ebook -->
<div class="modal fade" id="bookModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Thêm Ebook mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Tên sách</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tác giả</label>
                    <input type="text" name="author" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="price" class="form-control" min="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dung lượng file MB</label>
                    <input type="number" name="fileSize" class="form-control" min="0" step="0.1" required>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-success">Xác nhận</button>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>