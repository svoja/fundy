<?php
session_start();
include "database.php"; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $city = $_POST["city"];

    $stmt = $conn->prepare("INSERT INTO teams (name, city) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $city);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error adding team.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team</title>
</head>
<body>
    <h2>Add New Team</h2>
    <form method="POST">
        Team Name: <input type="text" name="name" required><br>
        City: <input type="text" name="city" required><br>
        <button type="submit">Add Team</button>
    </form>
</body>
</html>
