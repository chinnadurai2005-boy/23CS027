<?php
if(!isset($_GET['order_id'])){
    echo "Invalid Order!";
    exit();
}

$order_id = intval($_GET['order_id']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Successful</title>
</head>

<body style="font-family:Arial;text-align:center;margin-top:100px;">

<h2 style="color:green;">Payment Successful</h2>

<p>Your payment has been completed.</p>

<p><b>Order ID:</b> <?php echo $order_id; ?></p>

<a href="bill.php?order_id=<?php echo $order_id; ?>">
View Invoice
</a>

</body>
</html>