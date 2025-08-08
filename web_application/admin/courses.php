<?php
session_start();
include('../db.php');

// Check login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Add Course
if (isset($_POST['add_course'])) {
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $course_link = $_POST['course_link'];

    $query = "INSERT INTO courses (course_name, description, course_link) 
              VALUES ('$course_name', '$description', '$course_link')";
    mysqli_query($conn, $query);
}

// Delete Course
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM courses WHERE id=$id");
}

// Fetch Courses
$courses = mysqli_query($conn, "SELECT * FROM courses");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Courses</title>
    <link rel="stylesheet" href="../admin.css">
    <style>
        body {
            background-color: #f5f6fa;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 70%;
            margin: 30px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-box {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007BFF;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #007BFF;
            color: white;
        }
        .delete-btn {
            background: red;
            color: white;
            padding: 5px 8px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Courses</h2>

    <!-- Add Course Form -->
    <div class="form-box">
        <form method="post">
            <input type="text" name="course_name" placeholder="Course Name" required>
            <textarea name="description" placeholder="Course Description"></textarea>
            <input type="text" name="course_link" placeholder="Course Link" required>
            <button type="submit" name="add_course">Add Course</button>
        </form>
    </div>

    <!-- List Courses -->
    <h3>All Courses</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Description</th>
            <th>Link</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($courses)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><a href="<?php echo $row['course_link']; ?>" target="_blank">View</a></td>
            <td><a href="?delete=<?php echo $row['id']; ?>" class="delete-btn">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
