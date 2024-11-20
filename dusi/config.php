<?php
$host = 'localhost';       // เซิร์ฟเวอร์ของฐานข้อมูล
$dbname = 'dusi_db';       // ชื่อฐานข้อมูล
$username = 'root';        // ชื่อผู้ใช้งานฐานข้อมูล
$password = '';            // รหัสผ่าน (สำหรับ XAMPP ปกติจะเป็นค่าว่าง)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
