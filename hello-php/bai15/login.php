<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === 'admin' && $pass === '123') {
        $_SESSION['user'] = $user;
        header('Location: upload.php');
        exit;
    } else {
        $err = "Sai tài khoản hoặc mật khẩu.";
    }
}
?>
<h2>Đăng nhập</h2>
<form method="post">
    Username:
    <input name="username"><br><br>

    Password:
    <input type="password" name="password"><br><br>

    <input type="submit" value="Đăng nhập">
</form>
<?php
if (!empty($err)) {
    echo "<p style='color:red;'>$err</p>";
}
?>