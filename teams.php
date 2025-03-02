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
    <h1 style="text-align: center; color: #000000;">NBA Teams</h1>
    <div class="teams">
        <?php
        $result = $conn->query("SELECT * FROM teams");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<img src='{$row['logo']}' alt='{$row['name']}'>";
            echo "<h3>{$row['name']}</h3>";
            echo "<p><strong>Location:</strong> {$row['location']}</p>";
            echo "<p><strong>Coach:</strong> {$row['coach']}</p>";
            echo "<p><strong>Founded:</strong> {$row['founded_year']}</p>";
            echo "<p><strong>Championships:</strong> {$row['championships_won']}</p>";
            echo "<p><strong>Arena:</strong> {$row['arena']}</p>";
            echo "<p><strong>City:</strong> {$row['city']}</p>";
            echo "<p><strong>Owner:</strong> {$row['owner']}</p>";
            echo "<p><strong>GM:</strong> {$row['general_manager']}</p>";
            echo "<p><strong>Conference:</strong> {$row['conference']}</p>";
            echo "<p><strong>Division:</strong> {$row['division']}</p>";
            echo "<p><strong>Last Season Record:</strong> {$row['last_season_record']}</p>";
            echo "<p><strong>Retired Numbers:</strong> {$row['retired_numbers']}</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2025 NBA Teams</p>
</div>

</body>
</html>
