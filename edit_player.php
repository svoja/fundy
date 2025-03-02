<?php
session_start();
include "database.php"; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];
$player = $conn->query("SELECT * FROM players WHERE id = $id")->fetch_assoc();
$teams = $conn->query("SELECT * FROM teams ORDER BY name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $team_id = $_POST["team_id"];
    $position = $_POST["position"];

    $stmt = $conn->prepare("UPDATE players SET name=?, team_id=?, position=? WHERE id=?");
    $stmt->bind_param("sisi", $name, $team_id, $position, $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating player.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player</title>
</head>
<body>
    <h2>Edit Player</h2>
    <form method="POST">
        Player Name: <input type="text" name="name" value="<?php echo $player['name']; ?>" required><br>
        Team:
        <select name="team_id" required>
            <?php while ($team = $teams->fetch_assoc()): ?>
                <option value="<?php echo $team['id']; ?>" <?php if ($team['id'] == $player['team_id']) echo 'selected'; ?>>
                    <?php echo $team['name']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        Position: <input type="text" name="position" value="<?php echo $player['position']; ?>" required><br>
        <button type="submit">Update Player</button>
    </form>
</body>
</html>
