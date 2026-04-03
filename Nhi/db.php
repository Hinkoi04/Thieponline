<?php
$host = 'localhost';
$dbname = 'TotNghiep';
$username = 'root'; // Thay bằng user MySQL của bạn
$password = '';     // Thay bằng pass MySQL của bạn

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}
?>