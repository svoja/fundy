<a href="logout.php" class="logout-btn">Logout</a>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
