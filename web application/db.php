<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish connection
$conn = new mysqli("localhost", "root", "", "studystream_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
