<?php
session_start();
include "database.php"; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];
$team = $conn->query("SELECT * FROM teams WHERE id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $city = $_POST["city"];

    $stmt = $conn->prepare("UPDATE teams SET name=?, city=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $city, $id);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating team.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
</head>
<body>
    <h2>Edit Team</h2>
    <form method="POST">
        Team Name: <input type="text" name="name" value="<?php echo $team['name']; ?>" required><br>
        City: <input type="text" name="city" value="<?php echo $team['city']; ?>" required><br>
        <button type="submit">Update Team</button>
    </form>
</body>
</html>
