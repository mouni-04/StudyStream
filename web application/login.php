<?php
session_start();
include("db.php");

// Get input safely
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Basic validation
if (empty($email) || empty($password)) {
    echo "❌ Email and password are required.";
    exit();
}

// Prepared statement to avoid SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        // Start session and store user info
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];

        header("Location: Sessions/Live_Sessions.html");
        exit();

        // header("Location: dashboard.php"); // Optional redirect
    } else {
        echo "❌ Incorrect password!";
    }
} else {
    echo "❌ User not found!";
}

$stmt->close();
$conn->close();
?>
