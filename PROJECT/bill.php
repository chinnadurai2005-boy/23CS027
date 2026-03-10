<?php
session_start();
include("includes/db_connect.php");
include("includes/header.php");

if(!isset($_GET['order_id'])){
    echo "Invalid Order!";
    exit();
}

$order_id = intval($_GET['order_id']);

/* FETCH ORDER + SHIPPING DETAILS */
$sql = "SELECT o.*, 
        s.fullname,
        s.address,
        s.city,
        s.mobile
        FROM orders o
        LEFT JOIN shipping s ON o.id = s.order_id
        WHERE o.id='$order_id'";

$order_q = mysqli_query($conn,$sql);

if(!$order_q){
    echo "Database Error!";
    exit();
}

$order = mysqli_fetch_assoc($order_q);

if(!$order){
    echo "Order Not Found!";
    exit();
}

/* FETCH ORDER ITEMS */
$item_sql = "SELECT oi.*, p.name AS product_name
             FROM order_items oi
             JOIN products p ON oi.product_id = p.id
             WHERE oi.order_id='$order_id'";

$item_q = mysqli_query($conn,$item_sql);

if(!$item_q){
    echo "Items Fetch Error!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>

<style>
body{
    font-family: Arial;
}

.bill-box{
    width:75%;
    margin:auto;
    border:1px solid black;
    padding:20px;
}

.bill-header{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table,th,td{
    border:1px solid black;
}

th,td{
    padding:8px;
    text-align:center;
}

.print-btn{
    text-align:center;
    margin-top:20px;
}

@media print{
    .print-btn{
        display:none;
    }
}
</style>
</head>

<body>

<div class="bill-box">

<div class="bill-header">
<h2>Online Grocery Store</h2>
<b>Invoice / Bill</b>
</div>

<br>

<b>Order ID:</b> <?php echo htmlspecialchars($order['id']); ?><br>
<b>Order Date:</b> <?php echo htmlspecialchars($order['order_date']); ?><br><br>

<b>Customer Name:</b> <?php echo htmlspecialchars($order['fullname']); ?><br>
<b>Phone:</b> <?php echo htmlspecialchars($order['mobile']); ?><br>
<b>City:</b> <?php echo htmlspecialchars($order['city']); ?><br>
<b>Address:</b> <?php echo htmlspecialchars($order['address']); ?><br>

<table>

<tr>
<th>Product</th>
<th>Price (₹)</th>
<th>Qty</th>
<th>Total (₹)</th>
</tr>

<?php
$grand_total = 0;

while($row = mysqli_fetch_assoc($item_q)){

    $price = $row['price'];
    $qty = $row['quantity'];
    $total = $price * $qty;

    $grand_total = $grand_total + $total;
?>

<tr>
<td><?php echo htmlspecialchars($row['product_name']); ?></td>
<td><?php echo number_format($price,2); ?></td>
<td><?php echo $qty; ?></td>
<td><?php echo number_format($total,2); ?></td>
</tr>

<?php } ?>

<tr>
<th colspan="3">Grand Total</th>
<th>₹<?php echo number_format($grand_total,2); ?></th>
</tr>

</table>

<div class="print-btn">
<button onclick="window.print()">Print Bill</button>
</div>
<a href="payment.php?order_id=<?php echo $order_id; ?>">
<button>Pay Now</button>
</a>

</div>

</body>
</html>

<?php include("includes/footer.php"); ?>