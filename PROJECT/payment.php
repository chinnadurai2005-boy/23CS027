<?php
session_start();
include("includes/db_connect.php");

/* CHECK ORDER ID FROM URL */
if(!isset($_GET['order_id'])){
    echo "Invalid Order!";
    exit();
}

$order_id = intval($_GET['order_id']);

/* PAYMENT SUBMIT */
if(isset($_POST['pay_now'])){

    $order_id = intval($_POST['order_id']);
    $payment_method = mysqli_real_escape_string($conn,$_POST['payment_method']);

    /* UPDATE PAYMENT METHOD */
    mysqli_query($conn,"
    UPDATE orders
    SET payment_method='$payment_method'
    WHERE id='$order_id'
    ");

    /* REDIRECT TO SUCCESS PAGE */
    header("Location: payment_success.php?order_id=".$order_id);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Select Payment Method</title>

<style>

body{
    font-family:Arial;
    background:#f4f4f4;
}

.payment-box{
    width:400px;
    margin:80px auto;
    padding:25px;
    background:white;
    border:1px solid #ccc;
    text-align:center;
}

.pay-option{
    display:block;
    text-align:left;
    padding:10px;
    border:1px solid #ddd;
    margin-bottom:10px;
}

button{
    margin-top:20px;
    padding:10px 25px;
    background:#28a745;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#218838;
}

</style>

</head>

<body>

<div class="payment-box">

<h2>Select Payment Method</h2>

<form method="post">

<!-- IMPORTANT HIDDEN ORDER ID -->
<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

<label class="pay-option">
<input type="radio" name="payment_method" value="UPI" required>
UPI Payment
</label>

<label class="pay-option">
<input type="radio" name="payment_method" value="Debit Card">
Debit Card
</label>

<label class="pay-option">
<input type="radio" name="payment_method" value="Net Banking">
Net Banking
</label>

<label class="pay-option">
<input type="radio" name="payment_method" value="Cash on Delivery">
Cash on Delivery
</label>

<button type="submit" name="pay_now">
Confirm Payment
</button>

</form>

</div>

</body>
</html>