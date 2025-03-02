<?php
$servername = "localhost"; // หรือ IP ของเซิร์ฟเวอร์ฐานข้อมูล
$username = "root"; // ชื่อผู้ใช้ MySQL (ค่าเริ่มต้นของ XAMPP คือ 'root')
$password = ""; // รหัสผ่าน (XAMPP ปกติจะเป็นค่าว่าง)
$dbname = "user_management"; // ตรวจสอบว่าใช้ชื่อฐานข้อมูลถูกต้อง

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบข้อผิดพลาด
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
