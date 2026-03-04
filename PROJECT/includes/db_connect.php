<?php
$host = "localhost";     // Database host
$user = "root";          // MySQL username
$pass = "";              // MySQL password
$db   = "grocery";       // Database name

// Create database connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
