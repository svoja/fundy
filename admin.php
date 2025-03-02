<?php
session_start();
include "database.php"; 

// ตรวจสอบสิทธิ์ Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: home.php");
    exit();
}

// ดึงข้อมูลจากฐานข้อมูล
$games = $conn->query("SELECT * FROM games ORDER BY week DESC, date DESC");
$teams = $conn->query("SELECT * FROM teams ORDER BY name ASC");
$players = $conn->query("SELECT * FROM players ORDER BY name ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>
    <img src="logo.png" alt="NBA Logo">
</header>

<nav class="navbar">
    <a href="logout.php" class="btn-logout">Logout</a>
</nav>

<!-- 🏀 Manage Games -->
<section class="admin-panel">
    <h2>Manage Games</h2>
    <a href="add_game.php" class="btn">+ Add New Game</a>
    
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Home Team</th>
                <th>Score</th>
                <th>Away Team</th>
                <th>Venue</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($game = $games->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $game["date"]; ?></td>
                    <td><?php echo $game["home_team"]; ?></td>
                    <td><?php echo $game["home_score"] . " - " . $game["away_score"]; ?></td>
                    <td><?php echo $game["away_team"]; ?></td>
                    <td><?php echo $game["venue"]; ?></td>
                    <td>
                        <a href="edit_game.php?id=<?php echo $game['id']; ?>" class="edit-btn">Edit</a> | 
                        <a href="delete_game.php?id=<?php echo $game['id']; ?>" onclick="return confirm('Are you sure?');" class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

<!-- 🏀 Manage Teams -->
<section class="admin-panel">
    <h2>Manage Teams</h2>
    <a href="add_team.php" class="btn">+ Add New Team</a>
    
    <table>
        <thead>
            <tr>
                <th>Team Name</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($team = $teams->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $team["name"]; ?></td>
                    <td><?php echo $team["city"]; ?></td>
                    <td>
                        <a href="edit_team.php?id=<?php echo $team['id']; ?>" class="edit-btn">Edit</a> | 
                        <a href="delete_team.php?id=<?php echo $team['id']; ?>" onclick="return confirm('Are you sure?');" class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

<!-- 🏀 Manage Players -->
<section class="admin-panel">
    <h2>Manage Players</h2>
    <a href="add_player.php" class="btn">+ Add New Player</a>
    
    <table>
        <thead>
            <tr>
                <th>Player Name</th>
                <th>Team</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($player = $players->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $player["name"]; ?></td>
                    <td><?php echo $player["team"]; ?></td>
                    <td><?php echo $player["position"]; ?></td>
                    <td>
                        <a href="edit_player.php?id=<?php echo $player['id']; ?>" class="edit-btn">Edit</a> | 
                        <a href="delete_player.php?id=<?php echo $player['id']; ?>" onclick="return confirm('Are you sure?');" class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

</body>
</html>
