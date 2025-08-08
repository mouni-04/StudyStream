<?php
// Enable full error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include("db.php");

// Get form data
$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Validate fields
if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
    echo "❌ Please fill in all fields.";
    exit();
}

// Check if passwords match
if ($password !== $confirm_password) {
    echo "❌ Passwords do not match.";
    exit();
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Use prepared statement to check if email already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "❌ Email already registered!";
} else {
    // Insert into database safely
    $insert = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $insert->bind_param("sss", $fullname, $email, $hashedPassword);

    if ($insert->execute()) {
        header("Location: Sessions/Live_Sessions.php");
        exit();

    } else {
        echo "❌ Error: " . $insert->error;
    }
    $insert->close();
}

$stmt->close();
$conn->close();
?>
