<?php
session_start();
include("includes/db_connect.php");

if(!isset($_SESSION['user_id'])){
    header("Location: user/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Shipping Details</title>

<style>
.form-box{
    width:400px;
    margin:50px auto;
    border:1px solid #ccc;
    padding:20px;
}
input,textarea{
    width:100%;
    padding:10px;
    margin:8px 0;
}
button{
    background:green;
    color:white;
    padding:10px;
    width:100%;
    border:none;
}
</style>
</head>

<body>

<div class="form-box">
<h2>Shipping Address</h2>

<form method="post" action="checkout.php">

<input type="text" name="fullname" placeholder="Full Name" required>

<textarea name="address" placeholder="Full Address" required></textarea>

<input type="text" name="city" placeholder="City" required>

<input type="text" name="mobile" placeholder="Mobile Number" required>

<button type="submit">Continue to Checkout</button>

</form>

</div>

</body>
</html>
