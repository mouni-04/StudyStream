<?php
session_start();
include('../db.php');
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Add Live Session
if (isset($_POST['add_session'])) {
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $zoom_link = $_POST['zoom_link'];

    mysqli_query($conn, "INSERT INTO live_sessions (class, subject, start_time, end_time, zoom_link) 
                         VALUES ('$class', '$subject', '$start_time', '$end_time', '$zoom_link')");
}

// Delete Live Session
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM live_sessions WHERE id=$id");
}

// Fetch all sessions
$sessions = mysqli_query($conn, "SELECT * FROM live_sessions");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Live Sessions</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 85%;
        margin: 30px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        color: #004080;
    }
    form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px;
    }
    input {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        background: #004080;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background: #003366;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }
    th {
        background: #004080;
        color: white;
    }
    a.delete-btn {
        background: #e74c3c;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 4px;
    }
    a.delete-btn:hover {
        background: #c0392b;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Manage Live Sessions</h2>

    <!-- Add Session Form -->
    <form method="post">
        <input type="text" name="class" placeholder="Class (e.g. 10th Grade)" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="datetime-local" name="start_time" required>
        <input type="datetime-local" name="end_time" required>
        <input type="text" name="zoom_link" placeholder="Zoom Link" required>
        <button type="submit" name="add_session">Add Session</button>
    </form>

    <!-- Sessions Table -->
    <h3 style="text-align:center;">All Live Sessions</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Class</th>
            <th>Subject</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Zoom Link</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($sessions)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['start_time']; ?></td>
            <td><?php echo $row['end_time']; ?></td>
            <td><a href="<?php echo $row['zoom_link']; ?>" target="_blank">Join</a></td>
            <td><a class="delete-btn" href="?delete=<?php echo $row['id']; ?>">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
