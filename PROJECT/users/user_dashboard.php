<?php
session_start();
include("../includes/db_connect.php");

/* LOGIN CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* FETCH USER DATA */
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user  = mysqli_fetch_assoc($query);

/* SAFETY CHECK */
if(!$user){
    die("User not found");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>

<style>
/* ===== GLOBAL RESET ===== */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}

/* ===== BODY BACKGROUND ===== */
body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#022c22,#14532d);
    background-size:400% 400%;
    animation:bgMove 10s infinite alternate;
}

/* Animated gradient */
@keyframes bgMove{
    0%{ background-position:0% 50%; }
    100%{ background-position:100% 50%; }
}

/* ===== DASHBOARD CARD ===== */
.dashboard{
    width:420px;
    padding:35px;
    border-radius:20px;

    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(20px);
    -webkit-backdrop-filter:blur(20px);

    box-shadow:0 25px 60px rgba(0,0,0,0.6);
    border:1px solid rgba(255,255,255,0.15);

    text-align:center;
    color:white;

    transition:0.4s;
}

/* Card hover glow */
.dashboard:hover{
    transform:translateY(-6px);
    box-shadow:0 30px 80px rgba(34,197,94,0.35);
}

/* ===== TITLE ===== */
.dashboard h2{
    font-size:24px;
    margin-bottom:10px;
    background:linear-gradient(135deg,#22c55e,#4ade80);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

/* ===== USER INFO ===== */
.info{
    font-size:14px;
    color:#d1fae5;
    margin-bottom:25px;
    padding:10px;
    background:rgba(34,197,94,0.12);
    border-radius:10px;
}

/* ===== BUTTONS ===== */
.btn{
    display:block;
    margin:10px 0;
    padding:12px;

    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:white;
    text-decoration:none;

    border-radius:12px;
    font-size:14px;
    font-weight:600;

    transition:0.3s;
    box-shadow:0 8px 20px rgba(0,0,0,0.4);
}

/* Button hover */
.btn:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(34,197,94,0.4);
}

/* Logout button */
.logout{
    background:linear-gradient(135deg,#ef4444,#dc2626);
}

.logout:hover{
    box-shadow:0 12px 25px rgba(239,68,68,0.45);
}

/* ===== RESPONSIVE ===== */
@media(max-width:500px){

    .dashboard{
        width:90%;
        padding:25px;
    }

    .dashboard h2{
        font-size:20px;
    }
}
</style>

</head>

<body>

<div class="dashboard">

<h2>Welcome, <?php echo htmlspecialchars($user['name']); ?> 👋</h2>

<div class="info">
    Email: <?php echo htmlspecialchars($user['email']); ?>
</div>

<a class="btn" href="../products.php">🛒 Shop Now</a>

<a class="btn" href="my_orders.php">📦 My Orders</a>

<a class="btn logout" href="logout.php">🚪 Logout</a>

</div>

</body>
</html>