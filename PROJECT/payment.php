<?php
session_start();
include("db_connect.php");

if(isset($_POST['place_order']))
{
    $payment_method = $_POST['payment_method'];

    // Example order insert
    $query = "INSERT INTO orders (payment_method, status) 
              VALUES ('$payment_method','Pending')";
    mysqli_query($conn,$query);

    echo "<script>alert('Order Placed Successfully');</script>";
}
?>

<h2>Select Payment Method</h2>

<form method="post">

<label>
<input type="radio" name="payment_method" value="UPI" required>
UPI Payment
</label>
<br><br>

<label>
<input type="radio" name="payment_method" value="COD">
Cash on Delivery
</label>
<br><br>

<button type="submit" name="place_order">Place Order</button>

</form>