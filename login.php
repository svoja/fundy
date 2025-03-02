<?php
session_start();
include "database.php"; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // ตรวจสอบผู้ใช้และ role
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        // Debugging: ตรวจสอบค่าที่ดึงจากฐานข้อมูล
        error_log("User input: " . $password);
        error_log("Stored hash: " . $hashed_password);
        error_log("Role: " . $role);

        if (password_verify($password, $hashed_password)) {
            // ตั้งค่า session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role; // บันทึก role ใน session

            // เช็ค role และ redirect ไปหน้าที่เหมาะสม
            if ($role == 'admin') {
                header("Location: admin.php"); // ถ้าเป็น Admin ให้ไปที่ admin panel
            } else {
                header("Location: home.php"); // ถ้าเป็น User ให้ไปหน้า home
            }
            exit();
        } else {
            $error = "❌ Incorrect password!";
        }
    } else {
        $error = "❌ Username not found!";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA - Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <img src="logo.png" alt="NBA Logo">
            </div>
            <h1>Login</h1>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form action="login.php" method="POST">
                <label for="username" class="input-label">Username</label>
                <input type="text" name="username" required placeholder="Enter your username" class="input-field">
                
                <label for="password" class="input-label">Password</label>
                <input type="password" name="password" required placeholder="Enter your password" class="input-field">
                
                <button type="submit">LOGIN</button>
            </form>
            <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>

</body>
</html>
