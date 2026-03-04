<?php
session_start();
include("../includes/db_connect.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    /* FETCH ORDER + USER DATA */
    $query = mysqli_query($conn,"
        SELECT 
            o.*,
            u.name,
            u.email
        FROM orders o
        JOIN users u ON o.user_id = u.id
        WHERE o.id = '$id'
    ");

    $row = mysqli_fetch_assoc($query);

    /* UPDATE STATUS */
    if($row['status'] != 'Confirmed'){
        mysqli_query($conn,"
            UPDATE orders 
            SET status='Confirmed' 
            WHERE id='$id'
        ");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Confirm Order</title>

<style>
body{
    background:#020617;
    color:white;
    font-family:Arial;
}

.box{
    width:420px;
    margin:60px auto;
    padding:25px;
    background:#0f172a;
    border-radius:10px;
    box-shadow:0 0 20px rgba(0,0,0,0.5);
}

.success{
    background:#064e3b;
    padding:10px;
    border-radius:6px;
    text-align:center;
    margin-bottom:15px;
}

.label{
    color:#94a3b8;
}
.value{
    color:#22c55e;
    font-weight:bold;
}
a{
    color:#22c55e;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="box">

<h2 align="center" style="color:#22c55e;">Confirm Order</h2>

<div class="success">
    Order Confirmed Successfully!
</div>

<p><span class="label">Order ID:</span> <span class="value"><?php echo $row['id']; ?></span></p>

<!-- ✅ FIXED -->
<p><span class="label">Customer:</span> <span class="value"><?php echo $row['name']; ?></span></p>

<!-- ✅ FIXED -->
<p><span class="label">Email:</span> <span class="value"><?php echo $row['email']; ?></span></p>

<p><span class="label">Total Amount:</span> <span class="value">₹ <?php echo $row['total_amount']; ?></span></p>

<p><span class="label">Status:</span> <span class="value"><?php echo $row['status']; ?></span></p>

<br>
<a href="manage_orders.php">← Back to Orders</a>

</div>

</body>
</html>