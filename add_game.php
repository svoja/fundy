<?php
session_start();
include "database.php"; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $home_team = $_POST["home_team"];
    $home_score = $_POST["home_score"];
    $away_team = $_POST["away_team"];
    $away_score = $_POST["away_score"];
    $venue = $_POST["venue"];

    $stmt = $conn->prepare("INSERT INTO games (date, home_team, home_score, away_team, away_score, venue) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiis", $date, $home_team, $home_score, $away_team, $away_score, $venue);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error adding game.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Game</title>
</head>
<body>
    <h2>Add New Game</h2>
    <form method="POST">
        Date: <input type="date" name="date" required><br>
        Home Team: <input type="text" name="home_team" required><br>
        Home Score: <input type="number" name="home_score" required><br>
        Away Team: <input type="text" name="away_team" required><br>
        Away Score: <input type="number" name="away_score" required><br>
        Venue: <input type="text" name="venue" required><br>
        <button type="submit">Add Game</button>
    </form>
</body>
</html>
