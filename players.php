<?php include 'database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <header><img src="logo.png" alt="LOGO NBA"></header>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <a href="home.php">Home</a>
    <a href="schedule.php">Schedule</a>
    <a href="watch.html">Watch</a>
    <a href="teams.php">Teams</a>
    <a href="players.php">Players</a>
</div>

<div class="container">
    <h1 style="text-align: center; color: #000000;">NBA Players</h1>
    <div class="players">
        <?php
        $result = $conn->query("SELECT * FROM players");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<img src='{$row['photo']}' alt='{$row['name']}'>";
            echo "<h3>{$row['name']}</h3>";
            echo "<p><strong>Team:</strong> {$row['team']}</p>";
            echo "<p><strong>Position:</strong> {$row['position']}</p>";
            echo "<p><strong>Height:</strong> {$row['height']} cm</p>";
            echo "<p><strong>Weight:</strong> {$row['weight']} kg</p>";
            echo "<p><strong>Nationality:</strong> {$row['nationality']}</p>";
            echo "<p><strong>Birthdate:</strong> {$row['date_of_birth']}</p>";
            echo "<p><strong>College:</strong> {$row['college']}</p>";
            echo "<p><strong>Draft Year:</strong> {$row['draft_year']}</p>";
            echo "<p><strong>Draft Round:</strong> {$row['draft_round']}</p>";
            echo "<p><strong>Draft Pick:</strong> {$row['draft_pick']}</p>";
            echo "<p><strong>Salary:</strong> \${$row['salary']}M</p>";
            echo "<p><strong>Awards:</strong> {$row['awards']}</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2025 NBA Players</p>
</div>

</body>
</html>
