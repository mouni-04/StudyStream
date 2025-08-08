<?php
include '../db.php'; // Database connection

// Fetch all courses from DB
$sql = "SELECT * FROM courses";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - StudyStream</title>
    <link rel="stylesheet" href="headerfooter.css">
    <style>
        .course-section {
            padding: 50px;
            text-align: center;
        }

        .course-section h2 {
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        .course-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .course-card {
            width: 250px;
            height: 180px; /* Fixed height to align items */
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
    
            display: flex;               /* Flexbox to center content */
            flex-direction: column;      /* Stack text & button */
            justify-content: center;     /* Center vertically */
            align-items: center;         /* Center horizontally */
            text-align: center;
        }

        .course-card h3 {
            font-size: 20px;
            margin-bottom: 8px;
            color: #000;
        }

        .course-card p {
            font-size: 14px;
            margin-bottom: 15px;
            color: #666;
        }

        .course-card a {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .course-card a:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <!-- HEADER -->
    <header id="header">
        <nav>
            <div class="logo"><a href="/StudyStream/Web_Application/index.html"><img src="images/icon/logo.png" alt="logo"></a></div>
            <ul>
                <li><a href="Live_Sessions.php">Live Sessions</a></li>
                <li><a href="RecordedSessions.html">Recorded Sessions</a></li>
                <li><a href="PreRecodedLecture.html">Pre Recorded Lectures</a></li>
                <li><a href="Courses.php" class="active">Courses</a></li>
                <li><a href="notes.html">Notes</a></li>
            </ul>
        </nav>
    </header>

    <!-- COURSES SECTION -->
    <section class="course-section">
        <h2>Available Courses</h2>
        <div class="course-grid">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="course-card">
                    <h3><?php echo $row['course_name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <a href="<?php echo $row['course_link']; ?>" target="_blank">View Course</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

        <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <div class="left-col">
                <a href="/StudyStream/Web_Application/index.html"><img src="images/icon/logo.png" style="width: 200px;"></a>
                <div class="logo"></div>
                <div class="social-media">
                    <a href="#"><img src="images/icon/fb.png"></a>
                    <a href="#"><img src="images/icon/insta.png"></a>
                    <a href="#"><img src="images/icon/tt.png"></a>
                    <a href="#"><img src="images/icon/ytube.png"></a>
                    <a href="#"><img src="images/icon/linkedin.png"></a>
                </div><br><br>
                <p class="rights-text">Copyright © 2025 Developed by StudyStream. All Rights Reserved.</p>
                <br>
                <p><img src="images/icon/location.png"> AndhraPradesh, India<br> </p>
                <br>
                <p><img src="images/icon/phone.png"> +91-1234-567-890<br><img src="images/icon/mail.png">&nbsp;
                    info@StudyStream.com</p>
            </div>
            <div class="right-col">
                <h1 style="color: #fff">Our Newsletter</h1>
                <div class="border"></div><br>
                <p>Enter Your Email to get our News and updates.</p>
                <form class="newsletter-form">
                    <input class="txtb" type="email" placeholder="Enter Your Email">
                    <input class="btn" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </footer>
</body>
</html>
