<?php
// Nạp file autoload
require "autoload.php";

// Sử dụng class User trong namespace App\Models
use App\Models\User;

// Tạo đối tượng User
$user = new User();

// Gọi phương thức sayHello()
$user->sayHello();
?>