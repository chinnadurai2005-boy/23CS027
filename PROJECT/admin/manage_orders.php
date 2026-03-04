<?php
session_start();
include("../includes/db_connect.php");

/* FETCH ORDERS WITH USER DATA */
$query = mysqli_query($conn,"
    SELECT 
        o.*,
        u.name,
        u.email
    FROM orders o
    JOIN users u ON o.user_id = u.id
    ORDER BY o.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Orders</title>

<style>
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
    padding:8px 16px;
    border-radius:20px;
    color:white;
    text-decoration:none;
    font-size:14px;
    font-weight:bold;
    transition:0.25s ease;
    box-shadow:0 0 12px rgba(52,152,219,0.4);
}

.back-btn:hover{
    transform:translateY(-1px);
    box-shadow:0 0 18px rgba(52,152,219,0.7);
}
body{
    background:#020617;
    color:white;
    font-family:Arial;
}

table{
    width:95%;
    margin:20px auto;
    border-collapse:collapse;
}

th{
    background:green;
    padding:10px;
}

td{
    padding:10px;
    text-align:center;
    border:1px solid #333;
}

.btn{
    padding:5px 10px;
    color:white;
    text-decoration:none;
    border-radius:4px;
}

.confirmed-label{
    background:#2ecc71;
    padding:6px 12px;
    border-radius:4px;
    color:white;
    font-weight:bold;
}
.delete{ background:red; }
</style>
</head>

<body>

<h2 align="center">Manage Orders</h2>

<div class="top-bar">
    <a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
</div>

<table>
<table>
<tr>
    <th>Order ID</th>
    <th>Customer</th>
    <th>Email</th>
    <th>Total (₹)</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr>
    <td><?php echo $row['id']; ?></td>

    <!-- ✅ FIXED -->
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>

    <td>₹ <?php echo $row['total_amount']; ?></td>

    <!-- ✅ FIXED -->
    <td><?php echo $row['order_date']; ?></td>

  <td class="action-cell">

<?php if($row['status'] == 'Pending'){ ?>

    <a class="confirm-btn"
       href="confirm_order.php?id=<?php echo $row['id']; ?>">
       ✔ Confirm
    </a>

<?php } else { ?>

    <span class="confirmed-label">✔ Confirmed</span>

<?php } ?>

<a class="delete-btn"
   href="manage_orders.php?delete=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure you want to delete this order?');">
   ✖ Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>