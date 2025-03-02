<?php
session_start();
include "database.php"; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ตรวจสอบว่าผู้ใช้กดปุ่มสมัคร League Pass หรือ Premium Pass
if (isset($_POST['league_pass'])) {
    $subscription = 'league_pass';
} elseif (isset($_POST['premium'])) {
    $subscription = 'premium';
} else {
    header("Location: league-pass.php");
    exit();
}

// อัปเดตสถานะการสมัครสมาชิกในฐานข้อมูล
$stmt = $conn->prepare("UPDATE users SET subscription = ? WHERE id = ?");
$stmt->bind_param("si", $subscription, $user_id);
if ($stmt->execute()) {
    $_SESSION['subscription'] = $subscription; // อัปเดต session
    header("Location: home.php"); // กลับไปหน้า Home
    exit();
} else {
    echo "Error updating subscription!";
}
$stmt->close();
$conn->close();
?>
