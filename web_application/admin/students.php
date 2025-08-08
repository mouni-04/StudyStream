<?php
session_start();
include('../db.php');
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Add Student
if (isset($_POST['add_student'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')");
}

// Delete Student
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
}

// Fetch all students
$students = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Students</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
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
        margin-bottom: 20px;
        flex-wrap: wrap;
        justify-content: center;
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
        margin-top: 10px;
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
    <h2>Manage Students</h2>

    <!-- Add Student Form -->
    <form method="post">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="add_student">Add Student</button>
    </form>

    <!-- Students Table -->
    <h3 style="text-align:center;">All Students</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($students)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><a class="delete-btn" href="?delete=<?php echo $row['id']; ?>">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
