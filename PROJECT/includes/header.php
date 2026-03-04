<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Grocery Store</title>
    <link rel="stylesheet" href=" ">
</head>
<body>

<!-- NAVIGATION BAR -->
<header class="navbar">
    <div class="logo">
        <p><a href="index.php">Grocery Store</a></p>
    </div>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="admin/admin_login.php">Admin Login</a></li>
            <li><a href="products.php">Products</a></li>

            <!-- Show Login/Register if user not logged in -->
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <li><a href="users/login.php">Login</a></li>
                <li><a href="users/register.php">Register</a></li>
                 <li><a href="users/logout.php">Logout</a></li>

            <!-- If logged in, show logout -->
            <?php } else { ?>
                <li><a href="cart.php">Cart</a></li>
                 <li><a href="users/user_dashboard.php">Dashboard</a></li>
                <li><a href="users/logout.php">Logout</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>

<!-- Page Content Starts -->
<div class="content">
    </div> <!-- content end -->


<style>
/* ===== NAVBAR CONTAINER ===== */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 35px;
    background:linear-gradient(135deg,#15803d,#22c55e);
    box-shadow:0 4px 18px rgba(0,0,0,0.25);
    position:sticky;
    top:0;
    z-index:999;
}

/* ===== LOGO ===== */
.logo a{
    font-size:22px;
    font-weight:600;
    color:white;
    text-decoration:none;
    letter-spacing:0.4px;
}

/* subtle glow */
.logo a:hover{
    opacity:0.9;
}

/* ===== NAVIGATION ===== */
.navbar ul{
    list-style:none;
    display:flex;
    align-items:center;
    margin:0;
    padding:0;
}

/* spacing */
.navbar li{
    margin-left:22px;
}

/* ===== LINKS ===== */
.navbar a{
    color:white;
    text-decoration:none;
    font-size:14.5px;
    font-weight:500;
    padding:6px 10px;
    border-radius:6px;
    transition:0.25s ease;
    position:relative;
}

/* hover effect */
.navbar a:hover{
    background:rgba(255,255,255,0.15);
}

/* underline animation */
.navbar a::after{
    content:'';
    position:absolute;
    left:10px;
    bottom:2px;
    width:0;
    height:2px;
    background:white;
    transition:0.25s ease;
}

.navbar a:hover::after{
    width:calc(100% - 20px);
}

/* ===== SPECIAL BUTTONS ===== */

/* Admin login highlight */
.navbar a[href*="admin"]{
    background:rgba(0,0,0,0.15);
    padding:7px 14px;
    border-radius:18px;
}

.navbar a[href*="admin"]:hover{
    background:rgba(0,0,0,0.3);
}

/* Cart button */
.navbar a[href*="cart"]{
    background:#020617;
    padding:7px 16px;
    border-radius:18px;
    box-shadow:0 0 12px rgba(0,0,0,0.35);
}

.navbar a[href*="cart"]:hover{
    background:black;
}

/* Logout warning color */
.navbar a[href*="logout"]{
    background:rgba(239,68,68,0.25);
    border-radius:18px;
    padding:7px 16px;
}

.navbar a[href*="logout"]:hover{
    background:#ef4444;
}

/* ===== MOBILE RESPONSIVE ===== */
@media(max-width:768px){

    .navbar{
        flex-direction:column;
        padding:15px;
    }

    .navbar ul{
        flex-wrap:wrap;
        justify-content:center;
        margin-top:10px;
    }

    .navbar li{
        margin:6px;
    }
}
    </style>
</body>
</html>

