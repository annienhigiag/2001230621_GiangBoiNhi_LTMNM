<?php
/*
===========================================
KẾT NỐI MYSQL BẰNG PDO
===========================================
*/

$dsn = "mysql:host=localhost;dbname=labdb;charset=utf8";
$username = "Annie";
$password = "1234";

try
{
    $conn = new PDO($dsn, $username, $password);

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

}
catch(PDOException $e)
{
    die("Kết nối thất bại: ".$e->getMessage());
}
?>