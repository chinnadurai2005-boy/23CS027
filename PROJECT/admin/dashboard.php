<?php
/*************************************************
 * File: admin/dashboard.php
 * Style: Old / Procedural
 * PHP Version: 5.6.40
 *************************************************/

session_start();
include("../includes/db_connect.php");
/*
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
/*

/* =========================
   FETCH COUNTS
=========================*/

// Total Products
$product_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM products")
)['total'];

// Total Orders
$order_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders")
)['total'];

// Pending Orders
$pending_orders = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE status='Pending'")
)['total'];

// Confirmed Orders
$confirmed_orders = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE status='Confirmed'")
)['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#020617;
    color:white;
}

/* HEADER */
.header{
    background:black;
    padding:15px;
    text-align:center;
    font-size:20px;
    color:#22c55e;
    border-bottom:2px solid #22c55e;
}

/* CONTAINER */
.container{
    width:90%;
    margin:30px auto;
}

/* STATS GRID */
.stats{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
    justify-content:center;
}

/* CARD */
.card{
    width:220px;
    background:#0f172a;
    padding:20px;
    border-radius:8px;
    text-align:center;
    box-shadow:0 0 10px black;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h3{
    margin:0;
    font-size:16px;
    color:#22c55e;
}

.card p{
    font-size:26px;
    margin:10px 0 0;
}

/* MENU */
.menu{
    margin-top:35px;
    text-align:center;
}

.menu a{
    display:inline-block;
    padding:10px 18px;
    background:green;
    color:white;
    text-decoration:none;
    margin:6px;
    border-radius:5px;
    font-size:14px;
}

.menu a:hover{
    background:darkgreen;
}
</style>
</head>

<body>

<div class="header">
    Admin Dashboard
</div>

<div class="container">

<div class="stats">

    <div class="card">
        <h3>Total Products</h3>
        <p><?php echo $product_count; ?></p>
    </div>

    <div class="card">
        <h3>Total Orders</h3>
        <p><?php echo $order_count; ?></p>
    </div>

    <div class="card">
        <h3>Pending Orders</h3>
        <p><?php echo $pending_orders; ?></p>
    </div>

    <div class="card">
        <h3>Confirmed Orders</h3>
        <p><?php echo $confirmed_orders; ?></p>
    </div>

</div>

<div class="menu">

    <a href="add_product.php">➕ Add Product</a>
    <a href="edit_products.php">✏ Edit Products</a>
    <a href="manage_orders.php">📦 Manage Orders</a>
    <a href="../index.php">🏠 View Website</a>
    <a href="logout.php">🚪 Logout</a>

</div>

</div>

</body>
</html>