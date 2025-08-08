<?php
session_start();
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' LIMIT 1");
    $admin = mysqli_fetch_assoc($result);

    if ($admin && $password === $admin['password']) { 
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $admin['email'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login | StudyStream</title>
<link rel="stylesheet" href="../headerfooter.css">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        background: #fff;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    /* Diagonal Gradient Stripe positioned in center */
    body::before {
        content: '';
        position: absolute;
        top: 50%; /* Align stripe center with screen center */
        left: 0;
        width: 150%;
        height: 280px;
        background: linear-gradient(90deg, #FF3A6D, #F75959);
        transform: translateY(-50%) rotate(-5deg); /* Move it up to align with login box */
        z-index: 0;
    }

    .login-box {
        position: relative;
        z-index: 1;
        background: white;
        padding: 35px 30px;
        width: 360px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        text-align: center;
        animation: fadeIn 0.8s ease-in-out;
    }
    .login-box img {
        width: 70px;
        margin-bottom: 10px;
    }
    .login-box h2 {
        margin-bottom: 20px;
        color: #222;
        font-weight: 600;
    }
    .input-field {
        width: 100%;
        padding: 12px;
        margin: 12px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        outline: none;
        transition: border 0.3s ease;
    }
    .input-field:focus {
        border-color: #FF3A6D;
        box-shadow: 0 0 5px rgba(255,58,109,0.4);
    }
    .btn {
        width: 100%;
        background: linear-gradient(135deg, #FF3A6D, #F75959);
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }
    .btn:hover {
        opacity: 0.9;
    }
    .error {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>
<div class="login-box">
    <img src="../images/icon/logo.png" alt="StudyStream Logo">
    <h2>Admin Login</h2>
    <form method="post">
        <input class="input-field" type="email" name="email" placeholder="Admin Email" required>
        <input class="input-field" type="password" name="password" placeholder="Admin Password" required>
        <button class="btn" type="submit">Login</button>
    </form>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
</div>
</body>
</html>
