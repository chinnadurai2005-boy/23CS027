<?php
session_start();
include("includes/db_connect.php");
include("includes/header.php");

if(!isset($_GET['order_id'])){
    echo "Invalid Order!";
    exit();
}

$order_id = intval($_GET['order_id']);

/* FETCH ORDER + USER */
$order_q = mysqli_query($conn,"
SELECT orders.*, 
users.name, users.email, users.phone, users.address
FROM orders
JOIN users ON orders.user_id = users.id
WHERE orders.id='$order_id'
");

$order = mysqli_fetch_assoc($order_q);

if(!$order){
    echo "Order Not Found!";
    exit();
}

/* FETCH ORDER ITEMS */
$item_q = mysqli_query($conn,"
SELECT oi.*, p.name AS product_name
FROM order_items oi
JOIN products p ON oi.product_id=p.id
WHERE oi.order_id='$order_id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>

<style>
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
    .print-btn{display:none;}
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

<b>Order ID:</b> <?php echo $order['id']; ?><br>
<b>Order Date:</b> <?php echo $order['order_date']; ?><br><br>

<b>Customer Name:</b> <?php echo $order['name']; ?><br>
<b>Email:</b> <?php echo $order['email']; ?><br>
<b>Phone:</b> <?php echo $order['phone']; ?><br>
<b>Address:</b> <?php echo $order['address']; ?><br>

<table>
<tr>
<th>Product</th>
<th>Price (₹)</th>
<th>Qty</th>
<th>Total (₹)</th>
</tr>

<?php
$grand_total = 0;
while($row=mysqli_fetch_assoc($item_q)){
    $total = $row['price'] * $row['quantity'];
    $grand_total += $total;
?>
<tr>
<td><?php echo $row['product_name']; ?></td>
<td><?php echo number_format($row['price'],2); ?></td>
<td><?php echo $row['quantity']; ?></td>
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

</div>

</body>
</html>

<?php include("includes/footer.php"); ?>
