<?php
session_start();
include "database.php"; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];

$conn->query("DELETE FROM players WHERE id = $id");

header("Location: admin.php");
exit();
?>
