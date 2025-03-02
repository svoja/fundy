<?php
session_start();
include "database.php"; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบสิทธิ์ Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: home.php");
    exit();
}

// รับค่า ID จาก URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$game_id = $_GET['id'];

// ดึงข้อมูลเกมจากฐานข้อมูล
$stmt = $conn->prepare("SELECT * FROM games WHERE id = ?");
$stmt->bind_param("i", $game_id);
$stmt->execute();
$result = $stmt->get_result();
$game = $result->fetch_assoc();
$stmt->close();

// ตรวจสอบว่าพบข้อมูลเกมหรือไม่
if (!$game) {
    header("Location: admin.php");
    exit();
}

// ถ้ามีการส่งฟอร์มแก้ไข
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $home_team = $_POST['home_team'];
    $home_score = $_POST['home_score'];
    $away_team = $_POST['away_team'];
    $away_score = $_POST['away_score'];
    $venue = $_POST['venue'];

    $stmt = $conn->prepare("UPDATE games SET date=?, home_team=?, home_score=?, away_team=?, away_score=?, venue=? WHERE id=?");
    $stmt->bind_param("ssisssi", $date, $home_team, $home_score, $away_team, $away_score, $venue, $game_id);

    if ($stmt->execute()) {
        echo "<script>alert('Game updated successfully!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Error updating game. Please try again.');</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>
    <img src="logo.png" alt="NBA Logo">
</header>

<nav class="navbar">
    <a href="admin.php">Admin Panel</a>
    <a href="logout.php" class="btn-logout">Logout</a>
</nav>

<section class="admin-panel">
    <h2>Edit Game</h2>
    <form action="" method="POST">
        <label>Date:</label>
        <input type="date" name="date" value="<?php echo $game['date']; ?>" required>

        <label>Home Team:</label>
        <input type="text" name="home_team" value="<?php echo $game['home_team']; ?>" required>

        <label>Home Score:</label>
        <input type="number" name="home_score" value="<?php echo $game['home_score']; ?>" required>

        <label>Away Team:</label>
        <input type="text" name="away_team" value="<?php echo $game['away_team']; ?>" required>

        <label>Away Score:</label>
        <input type="number" name="away_score" value="<?php echo $game['away_score']; ?>" required>

        <label>Venue:</label>
        <input type="text" name="venue" value="<?php echo $game['venue']; ?>" required>

        <button type="submit">Update Game</button>
    </form>
</section>

</body>
</html>
