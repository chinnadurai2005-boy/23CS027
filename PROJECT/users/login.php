<?php
session_start();
include "../includes/db_connect.php";

$error = "";

// If login form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check user in DB
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if ($password==$user['password']) {

            // Save user session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];

            header("Location:user_dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login - Grocery Store</title>
    <link rel="stylesheet" href=" ">
</head>
<body>
    <style>
/* ===== LOGIN PAGE DESIGN ===== */

body{
    margin:0;
    padding:0;
    background:#f2f2f2;
    font-family:Arial, Helvetica, sans-serif;
}

/* Login Box */
.login-box{
    width:350px;
    background:#ffffff;
    margin:100px auto;
    padding:25px;
    box-shadow:0px 0px 10px #aaa;
    border-radius:6px;
}

/* Title */
.login-box h2{
    text-align:center;
    margin-bottom:20px;
    color:#2c3e50;
}

/* Labels */
.login-box label{
    font-weight:bold;
    display:block;
    margin-bottom:5px;
}

/* Inputs */
.login-box input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:4px;
}

/* Button */
.login-box button{
    width:100%;
    padding:10px;
    background:green;
    color:white;
    border:none;
    font-size:16px;
    border-radius:4px;
    cursor:pointer;
}

.login-box button:hover{
    background:darkgreen;
}

/* Error Message */
.error{
    color:red;
    text-align:center;
    margin-bottom:10px;
}

/* Register Link */
.login-box p{
    text-align:center;
    margin-top:15px;
}

.login-box a{
    color:green;
    text-decoration:none;
}

.login-box a:hover{
    text-decoration:underline;
}

        </style>

<div class="login-box">
    <h2>User Login</h2>

    <?php if ($error != "") { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>

        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
</div>
</body>
</html>