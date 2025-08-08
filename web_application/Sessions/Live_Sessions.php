<?php
include '../db.php'; // database connection

// Fetch all sessions (correct column name: class)
$sql = "SELECT * FROM live_sessions ORDER BY class, subject";
$result = mysqli_query($conn, $sql);

// Group by class
$sessions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $sessions[$row['class']][] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Classroom - StudyStream</title>
    <link rel="stylesheet" href="headerfooter.css">
    <link rel="stylesheet" href="Live_Sessions.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header id="header">
        <nav>
            <div class="logo"><a href="index.html"><img src="images/icon/logo.png" alt="logo"></a></div>
            <ul>
                <li><a href="Live_Sessions.php" class="active">Live Sessions</a></li>
                <li><a href="RecordedSessons.html">Recorded Sessions</a></li>
                <li><a href="PreRecodedLecture.html">Pre Recorded Lectures</a></li>
                <li><a href="Courses.php">Courses</a></li>
                <li><a href="notes.html">Notes</a></li>
            </ul>
        </nav>
    </header>

    <!-- Live Sessions Section -->
<section id="live-sessions">
    <h2>Live Sessions</h2>

    <?php foreach ($sessions as $class => $subjects): ?>
        <div class="class-section">
            <h3><?php echo htmlspecialchars($class); ?></h3>
            <div class="subjects-container">
                <?php foreach ($subjects as $sub): ?>
                    <div class="subject-item">
                        <h4><?php echo htmlspecialchars($sub['subject']); ?></h4>
                        <p>
                            Join the <?php echo htmlspecialchars($sub['subject']); ?> class 
                            <?php echo date('H:i', strtotime($sub['start_time'])); ?> 
                            To 
                            <?php echo date('H:i', strtotime($sub['end_time'])); ?>
                        </p>
                        <div class="button-container">
                            <a href="<?php echo htmlspecialchars($sub['zoom_link']); ?>" 
                               target="_blank" 
                               class="join-meeting-btn">
                                Join Now
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <div class="left-col">
                <img src="images/icon/logo.png" style="width: 200px;">
                <div class="social-media">
                    <a href="#"><img src="images/icon/fb.png"></a>
                    <a href="#"><img src="images/icon/insta.png"></a>
                    <a href="#"><img src="images/icon/tt.png"></a>
                    <a href="#"><img src="images/icon/ytube.png"></a>
                    <a href="#"><img src="images/icon/linkedin.png"></a>
                </div><br><br>
                <p class="rights-text">Copyright © 2025 Developed by StudyStream. All Rights Reserved.</p>
                <br>
                <p><img src="images/icon/location.png"> Andhra Pradesh, India<br></p>
                <br>
                <p><img src="images/icon/phone.png"> +91-1234-567-890<br><img src="images/icon/mail.png">&nbsp; info@StudyStream.com</p>
            </div>
            <div class="right-col">
                <h1 style="color: #fff">Our Newsletter</h1>
                <div class="border"></div><br>
                <p>Enter Your Email to get our News and updates.</p>
                <form class="newsletter-form">
                    <input class="txtb" type="email" placeholder="Enter Your Email">
                    <input class="btn" type="submit" value="Subscribe">
                </form>
            </div>
        </div>
    </footer>
</body>
</html>
