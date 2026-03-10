<?php
session_start();
include("../includes/db_connect.php");

// Check user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user orders
$sql = "SELECT * FROM orders 
        WHERE user_id = '$user_id' 
        ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>

<style>
/* PAGE */
body{
    margin:0;
    font-family: 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(135deg, #020617, #040b1a);
    color:white;
}

/* TITLE */
h2{
    margin-top:25px;
    letter-spacing:1px;
    font-weight:600;
}

/* TOP BAR */
.top-bar{
    width:95%;
    margin:10px auto;
    display:flex;
    justify-content:flex-start;
}

/* BACK BUTTON */
.back-btn{
    background:linear-gradient(135deg,#3498db,#2980b9);
    padding:9px 18px;
    border-radius:25px;
    color:white;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
    transition:0.25s ease;
    box-shadow:0 0 12px rgba(52,152,219,0.35);
}

.back-btn:hover{
    transform:translateY(-1px);
    box-shadow:0 0 20px rgba(52,152,219,0.65);
}

/* TABLE */
table{
    width:95%;
    margin:20px auto;
    border-collapse:collapse;
    background:#050d1f;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 0 25px rgba(0,0,0,0.6);
}

/* HEADER */
th{
    background: linear-gradient(135deg,#16a34a,#15803d);
    padding:12px;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:0.5px;
}

/* CELLS */
td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid rgba(255,255,255,0.05);
    font-size:14px;
    color:#d1d5db;
}

/* ROW HOVER */
tr:hover{
    background:rgba(255,255,255,0.02);
}

/* ACTION CELL */
.action-cell{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
}

/* CONFIRM BUTTON */
.confirm-btn{
    background:linear-gradient(135deg,#22c55e,#16a34a);
    padding:6px 14px;
    border-radius:18px;
    color:white;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    transition:0.2s ease;
    box-shadow:0 0 10px rgba(34,197,94,0.35);
}

.confirm-btn:hover{
    transform:translateY(-1px);
    box-shadow:0 0 18px rgba(34,197,94,0.6);
}

/* DELETE BUTTON */
.delete-btn{
    background:linear-gradient(135deg,#ef4444,#dc2626);
    padding:6px 14px;
    border-radius:18px;
    color:white;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    transition:0.2s ease;
    box-shadow:0 0 10px rgba(239,68,68,0.35);
}

.delete-btn:hover{
    transform:translateY(-1px);
    box-shadow:0 0 18px rgba(239,68,68,0.65);
}

/* CONFIRMED LABEL */
.confirmed-label{
    background:linear-gradient(135deg,#22c55e,#15803d);
    padding:6px 14px;
    border-radius:18px;
    font-size:13px;
    font-weight:600;
    box-shadow:0 0 10px rgba(34,197,94,0.35);
}

/* SCROLL IMPROVEMENT (optional) */
table{
    backdrop-filter: blur(6px);
}
</style>

</head>

<body>

<div class="container">

<h2>My Orders</h2>

<table>
<tr>
<th>Order ID</th>
<th>Total Amount</th>
<th>Order Date</th>
<th>Status</th>
<th>Action</th>
<th>Bill</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td>₹<?php echo number_format($row['total_amount'],2); ?></td>
<td><?php echo $row['order_date']; ?></td>
<td><?php echo $row['status']; ?></td>
<td>
<?php

$status = isset($row['status']) ? $row['status'] : '';

if($status == 'Pending'){
?>

<a href="cancel_order.php?order_id=<?php echo intval($row['id']); ?>"
onclick="return confirm('Are you sure you want to cancel this order?');"
style="color:red;font-weight:bold;">
Cancel Order
</a>

<?php
}
else{

    if($status == 'Cancelled'){
        echo "<span style='color:red;'>Cancelled</span>";
    }
    else if($status == 'Confirmed'){
        echo "<span style='color:lime;'>Confirmed</span>";
    }
    else{
        echo htmlspecialchars($status);
    }

}
?>
</td>
<td>
<a href="../bill.php?order_id=<?php echo $row['id']; ?>" target="_blank">
View Bill
</a>
</td>
</tr>
<?php } ?>

</table>    

<a class="btn" href="user_dashboard.php">Back</a>

</div>

</body>
</html>
