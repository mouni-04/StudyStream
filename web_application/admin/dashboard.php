<?php
session_start();
include('../db.php');
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch counts from DB
$totalCourses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM courses"))['total'];
$totalStudents = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$totalSessions = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM live_sessions"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - StudyStream</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        display: flex;
    }
    .sidebar {
        width: 220px;
        background: #004aad;
        color: white;
        height: 100vh;
        padding-top: 20px;
        position: fixed;
    }
    .sidebar h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .sidebar a {
        display: block;
        padding: 12px;
        color: white;
        text-decoration: none;
        transition: background 0.3s;
    }
    .sidebar a:hover {
        background: #0055cc;
    }
    .main-content {
        margin-left: 220px;
        padding: 30px;
        flex: 1;
    }
    .dashboard-header {
        font-size: 24px;
        margin-bottom: 20px;
        color: #004aad;
        font-weight: bold;
    }
    .cards {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        justify-content: flex-start;
    }
    .card {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        flex: 1;
        min-width: 250px;
        text-align: center;
        font-size: 20px;
    }
    .card h3 {
        margin-bottom: 10px;
        font-size: 22px;
        color: #333;
    }
    .card p {
        font-size: 26px;
        font-weight: bold;
        color: #004aad;
    }
</style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="courses.php">📚 Manage Courses</a>
    <a href="students.php">👨‍🎓 Manage Students</a>
    <a href="sessions.php">🎥 Manage Live Sessions</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main-content">
    <div class="dashboard-header">Welcome, Admin</div>
    
    <div class="cards">
        <div class="card">
            <h3>Total Courses</h3>
            <p><?php echo $totalCourses; ?></p>
        </div>
        <div class="card">
            <h3>Total Students</h3>
            <p><?php echo $totalStudents; ?></p>
        </div>
        <div class="card">
            <h3>Total Live Sessions</h3>
            <p><?php echo $totalSessions; ?></p>
        </div>
    </div>
</div>

</body>
</html>
