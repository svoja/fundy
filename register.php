<?php
session_start();
include "database.php"; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // ตรวจสอบว่ารหัสผ่านและยืนยันรหัสผ่านตรงกันหรือไม่
    if ($password !== $confirm_password) {
        $error = "❌ Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน

        // ตรวจสอบว่ามี username หรือ email ซ้ำหรือไม่
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error = "❌ Username or email already exists!";
        } else {
            
            $stmt = $conn->prepare("INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $phone, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                header("Location: league-pass.php"); // ✅ เปลี่ยนเส้นทางไปยังหน้า League Pass
                exit();
            } else {
                $error = "❌ Error registering user!";
            }
            $stmt->close();
        }
        $checkStmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NBA Clone</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

    <div class="register-container">
        <div class="register-box">
            <div class="logo-container">
                <img src="logo.png" alt="NBA Logo"> <!-- โลโก้ NBA -->
            </div>
            <h2>Create Account</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input type="text" name="username" required placeholder="Enter your full name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" required placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" required placeholder="Enter your number">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" required placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" required placeholder="Confirm your password">
                </div>
                <button type="submit" class="btn-register">REGISTER</button>
            </form>
            <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>

</body>
</html>
