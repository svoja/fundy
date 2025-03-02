<?php
session_start();
include "database.php"; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: home.php");
    exit();
}

$teams = $conn->query("SELECT * FROM teams ORDER BY name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $team_id = $_POST["team_id"];
    $position = $_POST["position"];

    $stmt = $conn->prepare("INSERT INTO players (name, team_id, position) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $team_id, $position);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error adding player.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player</title>
</head>
<body>
    <h2>Add New Player</h2>
    <form method="POST">
        Player Name: <input type="text" name="name" required><br>
        Team:
        <select name="team_id" required>
            <?php while ($team = $teams->fetch_assoc()): ?>
                <option value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        Position: <input type="text" name="position" required><br>
        <button type="submit">Add Player</button>
    </form>
</body>
</html>
