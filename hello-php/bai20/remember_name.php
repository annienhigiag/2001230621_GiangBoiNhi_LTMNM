<?php
// Nếu người dùng bấm xóa tên
if (isset($_GET['delete'])) {
    setcookie('username', '', time() - 3600, '/');
    header('Location: remember_name.php');
    exit;
}

// Nếu người dùng gửi form nhập tên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username'])) {

    // Lưu tên vào cookie trong 1 giờ
    setcookie('username', $_POST['username'], time() + 3600, '/');

    header('Location: remember_name.php');
    exit;
}

// Nếu đã có cookie thì chào lại
if (isset($_COOKIE['username'])) {
    echo "<h3>Chào mừng lại, " . htmlspecialchars($_COOKIE['username']) . "!</h3>";
    echo "<a href='?delete=1'>Xóa tên đã ghi nhớ</a>";
} else {
?>

<h3>Nhập tên của bạn</h3>

<form method="post">
    Tên:
    <input type="text" name="username">

    <input type="submit" value="Lưu tên">
</form>

<?php
}
?>