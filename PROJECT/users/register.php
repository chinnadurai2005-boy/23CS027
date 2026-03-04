<?php
session_start();
include "../includes/db_connect.php"; 


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);

    // basic validation
    if (empty($name) || empty($email) || empty($password)) {
        $message = "All fields are required!";
    } else {
        // check if email already exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        
        if (mysqli_num_rows($check) > 0) {
            $message = "Email already registered!";
        } else {
            // password hashing
            $password=$password;
            // insert new user
            $query = "INSERT INTO users(name, email, password,phone,address) VALUES('$name', '$email', '$password','$phone','$address')";
            
            if (mysqli_query($conn, $query)) {
                $message = "Registration successful! Please login.";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <style>
/* ===== GENERAL ===== */

body{
    margin:0;
    padding:0;
    background:#f2f2f2;
    font-family:Arial, Helvetica, sans-serif;
}

/* ===== FORM CONTAINER ===== */

.form-container{
    width:400px;
    background:#ffffff;
    margin:80px auto;
    padding:30px;
    border-radius:6px;
    box-shadow:0px 0px 10px rgba(0,0,0,0.2);
}

/* ===== TITLE ===== */

.form-container h2{
    text-align:center;
    margin-bottom:25px;
    color:#2c3e50;
}

/* ===== INPUT FIELDS ===== */

.form-container input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:4px;
    font-size:14px;
}

/* Focus Effect */
.form-container input:focus{
    outline:none;
    border-color:green;
}

/* ===== BUTTON ===== */

.form-container button{
    width:100%;
    padding:12px;
    background:green;
    color:white;
    border:none;
    font-size:16px;
    border-radius:4px;
    cursor:pointer;
}

.form-container button:hover{
    background:darkgreen;
}

/* ===== ALERT MESSAGE ===== */

.alert{
    background:#ffe0e0;
    color:#b30000;
    padding:10px;
    text-align:center;
    border-radius:4px;
    margin-bottom:15px;
}

/* ===== LINK ===== */

.form-container p{
    text-align:center;
    margin-top:15px;
}

.form-container a{
    color:green;
    text-decoration:none;
}

.form-container a:hover{
    text-decoration:underline;
}

/* ===== MOBILE RESPONSIVE ===== */

@media(max-width:500px){
    .form-container{
        width:90%;
    }
}

        </style>

<div class="form-container">
    <h2>Create Account</h2>

    <?php if ($message != "") { ?>
        <p class="alert"><?php echo $message; ?></p>
    <?php } ?>

    <form action="" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="text" name="phone" placeholder="phone number" required>

        <input type="text" name="address" placeholder="Enter Address" required>

        <button type="submit">Register</button>

        <p>Already have an account?
            <a href="login.php">Login Here</a>
        </p>
    </form>
</div>

</body>
</html>
