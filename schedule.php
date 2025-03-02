<?php
session_start();
include "database.php"; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบสถานะการสมัครสมาชิก
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$subscription = 'none';

// ถ้าผู้ใช้ล็อกอิน ให้ดึงข้อมูลจากฐานข้อมูล
if ($user_id) {
    $stmt = $conn->prepare("SELECT subscription FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($subscription);
    $stmt->fetch();
    $stmt->close();

    $_SESSION['subscription'] = $subscription;
}

// ✅ ดึงข้อมูลเกมจากฐานข้อมูล
$sql = "SELECT * FROM games ORDER BY week DESC, date DESC";
$result = $conn->query($sql);

// ✅ จัดกลุ่มข้อมูลตามสัปดาห์
$weeks = [];
while ($game = $result->fetch_assoc()) {
    $weeks[$game["week"]][$game["day"]][] = $game;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA Schedule</title>
    <link rel="stylesheet" href="schedule.css"> <!-- ใช้ไฟล์ CSS เดียวกัน -->
</head>
<body>

<header>
    <img src="logo.png" alt="NBA Logo">
</header>

<!-- ✅ Navbar -->
<nav class="navbar">
    <a href="home.php">Home</a>
    <a href="schedule.php">Schedule</a>

    <?php if ($subscription == 'premium'): ?>
        <a href="watch.html">Watch</a>
        <a href="teams.php">Teams</a>
        <a href="players.php">Players</a>
    <?php elseif ($subscription == 'league_pass'): ?>
        <a href="#" class="disabled" onclick="alert('Upgrade to Premium to access this!'); return false;">Watch</a>
        <a href="#" class="disabled" onclick="alert('Upgrade to Premium to access this!'); return false;">Teams</a>
        <a href="#" class="disabled" onclick="alert('Upgrade to Premium to access this!'); return false;">Players</a>
    <?php else: ?>
        <a href="#" class="disabled" onclick="alert('Register & Subscribe to access!'); return false;">Watch</a>
        <a href="#" class="disabled" onclick="alert('Register & Subscribe to access!'); return false;">Teams</a>
        <a href="#" class="disabled" onclick="alert('Register & Subscribe to access!'); return false;">Players</a>
    <?php endif; ?>
</nav>

<!-- ✅ ตารางการแข่งขัน -->
<section class="schedule">
    <div class="schedule-container">
        <?php if (!empty($weeks)): ?>
            <?php foreach ($weeks as $week => $days): ?>
                <h2>Week <?php echo htmlspecialchars($week); ?></h2>
                <?php foreach ($days as $day => $games): ?>
                    <h3><?php echo htmlspecialchars($day); ?></h3>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Home Team</th>
                                    <th>Score</th>
                                    <th>Away Team</th>
                                    <th>Venue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($games as $game): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($game["date"]); ?></td>
                                        <td><?php echo htmlspecialchars($game["home_team"]); ?></td>
                                        <td class="score">
                                            <?php echo htmlspecialchars($game["home_score"] . " - " . $game["away_score"]); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($game["away_team"]); ?></td>
                                        <td><?php echo htmlspecialchars($game["venue"]); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No games available.</p>
        <?php endif; ?>
    </div>
</section>

</body>
</html>
