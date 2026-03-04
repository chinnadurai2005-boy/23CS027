<?php
session_start();
include("../includes/db_connect.php");
include("../includes/header.php");

$error = "";

// If admin already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "All fields are required";
    } else {

        // Fetch admin from DB
        $query = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $admin = mysqli_fetch_assoc($result);

            // Password verify (works in PHP 5.6)
            if ($password==$admin['password']) {

                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];

                header("Location: dashboard.php");
                exit();

            } else {
                $error = "Invalid username or password";
            }

        } else {
            $error = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .login-box {
            width: 350px;
            margin: 100px auto;
            background: #fff;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
        }
        button {
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if ($error != "") { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post">
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
<?php include("../includes/footer.php");?>
</body>
</html>
