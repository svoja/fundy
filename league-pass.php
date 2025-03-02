<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // ป้องกันการเข้าถึงโดยตรง
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA League Pass</title>
    <link rel="stylesheet" href="league-pass.css">
</head>
<body>

<header>
    <div class="logo-container">
        <img src="logo.png" alt="NBA Logo"> <!-- โลโก้ NBA -->
    </div>
    <h1 class="header-title">NBA League Pass</h1>
</header>

<div class="container">
    <!-- ✅ League Pass (ฟรี) -->
    <div class="plan">
        <h2>LEAGUE PASS</h2>
        <p>Home and Schedule.</p>
        <p><strong>Price: Free</strong></p>
        <form action="subscribe.php" method="POST">
            <button type="submit" name="league_pass" class="subscribe-btn">Subscribe</button>
        </form>
    </div>

    <!-- ✅ League Pass Premium (จ่ายเงิน) -->
    <div class="plan premium">
        <h2>LEAGUE PASS PREMIUM</h2>
        <p>Watch live and on-demand games.</p>
        <p><strong>Price: 449 THB/month</strong></p>
        <form action="subscribe.php" method="POST">
            <button type="submit" name="premium" class="subscribe-btn">Subscribe</button>
        </form>
    </div>
</div>

</body>
</html>
