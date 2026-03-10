<?php
session_start();
include("includes/db_connect.php");

/* USER LOGIN CHECK */
if(!isset($_SESSION['user_id'])){
    header("Location: user/login.php");
    exit();
}

/* CART CHECK */
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    echo "Cart is empty";
    exit();
}

/* PLACE ORDER */
if(isset($_POST['place_order'])){

    $user_id = $_SESSION['user_id'];

    /* GET SHIPPING DETAILS */
    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $address  = mysqli_real_escape_string($conn,$_POST['address']);
    $city     = mysqli_real_escape_string($conn,$_POST['city']);
    $mobile   = mysqli_real_escape_string($conn,$_POST['mobile']);

    $total_amount = 0;

    /* CALCULATE TOTAL */
    foreach($_SESSION['cart'] as $pid => $qty){

        $pid = intval($pid);
        $qty = intval($qty);

        $result = mysqli_query($conn,"SELECT price FROM products WHERE id='$pid'");
        $row = mysqli_fetch_assoc($result);

        if($row){
            $total_amount += $row['price'] * $qty;
        }
    }

    /* INSERT ORDER */
    mysqli_query($conn,"
    INSERT INTO orders(user_id,total_amount,order_date)
    VALUES('$user_id','$total_amount',NOW())
    ");

    $order_id = mysqli_insert_id($conn);

    /* INSERT ORDER ITEMS */
    foreach($_SESSION['cart'] as $pid => $qty){

        $pid = intval($pid);
        $qty = intval($qty);

        $result = mysqli_query($conn,"SELECT price FROM products WHERE id='$pid'");
        $row = mysqli_fetch_assoc($result);

        if($row){

            $price = $row['price'];

            mysqli_query($conn,"
            INSERT INTO order_items(order_id,product_id,quantity,price)
            VALUES('$order_id','$pid','$qty','$price')
            ");
        }
    }

    /* INSERT SHIPPING */
    mysqli_query($conn,"
    INSERT INTO shipping(order_id,fullname,address,city,mobile)
    VALUES('$order_id','$fullname','$address','$city','$mobile')
    ");

    /* CLEAR CART */
    unset($_SESSION['cart']);

    /* REDIRECT TO BILL PAGE */
    header("Location: bill.php?order_id=".$order_id);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
</head>

<body>

<h2>Shipping Details</h2>

<form method="post">

<input type="text" name="fullname" placeholder="Full Name" required>
<br><br>

<textarea name="address" placeholder="Address" required></textarea>
<br><br>

<input type="text" name="city" placeholder="City" required>
<br><br>

<input type="text" name="mobile" placeholder="Mobile Number" required>
<br><br>

<button type="submit" name="place_order">
Place Order
</button>

</form>
<style>
    <style> /* PAGE BACKGROUND */ body{ margin:0; font-family:'Segoe UI', Arial, sans-serif; background:linear-gradient(135deg,#020617,#040b1a); display:flex; justify-content:center; align-items:center; min-height:100vh; color:white; } /* CHECKOUT CARD */ .checkout-box{ width:420px; background:rgba(255,255,255,0.04); backdrop-filter:blur(12px); border:1px solid rgba(255,255,255,0.08); padding:30px; border-radius:14px; box-shadow:0 0 35px rgba(0,0,0,0.65); animation:fadeIn 0.4s ease; } /* TITLE */ .checkout-box h2{ margin-top:0; margin-bottom:20px; text-align:center; font-weight:600; letter-spacing:0.5px; color:#22c55e; } /* INPUTS */ input, textarea{ width:100%; padding:12px; margin-top:12px; border-radius:8px; border:1px solid rgba(255,255,255,0.08); background:rgba(255,255,255,0.05); color:white; font-size:14px; transition:0.2s ease; outline:none; } /* INPUT FOCUS EFFECT */ input:focus, textarea:focus{ border-color:#22c55e; box-shadow:0 0 12px rgba(34,197,94,0.35); background:rgba(255,255,255,0.07); } /* TEXTAREA */ textarea{ resize:none; min-height:80px; } /* PLACE ORDER BUTTON */ button{ width:100%; margin-top:20px; padding:12px; border:none; border-radius:25px; background:linear-gradient(135deg,#22c55e,#15803d); color:white; font-size:15px; font-weight:600; cursor:pointer; transition:0.25s ease; box-shadow:0 0 18px rgba(34,197,94,0.35); } /* BUTTON HOVER */ button:hover{ transform:translateY(-1px); box-shadow:0 0 28px rgba(34,197,94,0.65); } /* PLACEHOLDER COLOR */ ::placeholder{ color:#9ca3af; } /* FADE ANIMATION */ @keyframes fadeIn{ from{ opacity:0; transform:translateY(8px); } to{ opacity:1; transform:translateY(0); } } </style>
    </style>

</body>
</html>