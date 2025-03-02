<?php
session_start();
include "database.php"; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบการล็อกอินและสิทธิ์การเข้าถึง
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
$subscription = 'none';

// ดึงข้อมูล Subscription จากฐานข้อมูล
if ($user_id) {
    $stmt = $conn->prepare("SELECT subscription FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($subscription);
    $stmt->fetch();
    $stmt->close();

    $_SESSION['subscription'] = $subscription;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA Clone - Home</title>
    <link rel="stylesheet" href="home.css">
    <style>
        /* ปุ่ม Login/Register/Logout */
        .auth-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .auth-buttons a {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-left: 10px;
        }

        .auth-buttons .btn-logout {
            background-color: #c8102e;
        }

        .auth-buttons a:hover {
            background-color: #0056b3;
        }

        .auth-buttons .btn-logout:hover {
            background-color: #a10e2b;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: center;
            background: white;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            margin: 0 15px;
            text-decoration: none;
            color: #000;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s, transform 0.2s;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .navbar a:hover {
            color: #c8102e;
            background: rgba(0, 0, 0, 0.1);
            transform: scale(1.1);
        }

        /* Main News */
        .main-news {
            text-align: center;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
        }

        .main-news img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .main-news h2 {
            margin-top: 10px;
            color: #1d428a;
            font-weight: bold;
        }

        /* Latest News */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1000px;
            margin: auto;
        }

        .news-item {
            background: white;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .news-item img {
            width: 100%;
            border-radius: 10px;
        }

        .news-item a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        .news-item a:hover {
            color: #c8102e;
        }
    </style>
</head>
<body>

<header>
    <img src="logo.png" alt="NBA Logo">
    <div class="auth-buttons">
        <?php if ($user_id): ?>
            <a href="logout.php" class="btn-logout">LOGOUT</a>
        <?php else: ?>
            <a href="register.php" class="btn-register">REGISTER</a>
            <a href="login.php" class="btn-login">LOGIN</a>
        <?php endif; ?>
    </div>
</header>

<!-- ✅ Navbar -->
<nav class="navbar">
    <a href="home.php">Home</a>
    <a href="schedule.php">Schedule</a>

    <?php if ($role == 'admin'): ?>
        <a href="admin.php">Admin Panel</a> <!-- เมนูเฉพาะ Admin -->
    <?php endif; ?>

    <?php if ($subscription == 'premium' || $role == 'admin'): ?>
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

< <div class="container">
        <div class="main-news">
            <img src="https://cdn.nba.com/manage/2025/02/mitchell-guarding-tatum.jpg?w=1568&h=882" alt="Main NBA News"><br>
            <h2>10 Key Storylines Following All-Star Break</h2>
            <p>Playoff positioning, the race for Kia MVP and NBA Draft Lottery odds will all come into focus over the next 2 months.</p>
        </div><br><br>
        
        <h2>Latest News</h2>
        <div class="news-grid">
            <div class="news-item">
                <a href="KD_news.html">
                    <img src="https://cdn.nba.com/manage/2025/02/durant-reaction.jpg?w=1470&h=826" alt="Durant Homecoming">
                    <p>DURANT 'EXCITED' FOR AUSTIN HOMECOMING ON THURSDAY</p>
                </a>
            </div>
            <div class="news-item">
                <a href="ranking_news.html">
                    <img src="https://cdn.nba.com/manage/2025/02/shai-gilgeous-alexander-smiles.jpg?w=1470&h=826" alt="Power Rankings">
                    <p>POWER RANKINGS: CLIPPERS, WARRIORS RISING</p>
                </a>
            </div>
            <div class="news-item">
                <a href="all_star_news.html">
                    <img src="https://cdn.nba.com/teams/uploads/sites/1610612744/2025/01/AS25_Generic_1280x720.jpg" alt="All-Star Weekend">
                    <p>5 Takeaways: All-Star Weekend ripe with change</p>
                </a>
            </div>
            <div class="news-item">
                <a href="currymvp_news.html">
                    <img src="https://d.newsweek.com/en/full/2589568/steph-curry.jpg?w=1200&f=4a6eaa6040b65644f2c77097a4369785" alt="Curry MVP">
                    <p>Curry MVP as Shaq's OGs win All-Star tournament</p>
                </a>
            </div>
            <div class="news-item">
                <a href="mcclung_news.html">
                    <img src="https://imageio.forbes.com/specials-images/imageserve/65d58f20f5c9d23822149572/Mac-McClung--Osceola-Magic-/960x0.jpg?format=jpg&width=960" alt="McClung Dunk Champion">
                    <p>Three-peat! McClung wins AT&T Slam Dunk</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
