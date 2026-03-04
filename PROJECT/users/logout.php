<?php
session_start();
include("../includes/db_connect.php");

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
