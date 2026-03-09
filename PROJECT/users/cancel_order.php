<?php
session_start();
include("../includes/db_connect.php");

/* CHECK USER LOGIN */
if(!isset($_SESSION['user_id'])){
    header("Location: user/login.php");
    exit();
}

/* CHECK ORDER ID */
if(!isset($_GET['order_id'])){
    echo "Invalid Order!";
    exit();
}

$order_id = intval($_GET['order_id']);
$user_id  = $_SESSION['user_id'];

/* VERIFY ORDER BELONGS TO USER */
$sql = "SELECT id FROM orders WHERE id='$order_id' AND user_id='$user_id'";
$result = mysqli_query($conn, $sql);

if(!$result){
    echo "Database Error!";
    exit();
}

if(mysqli_num_rows($result) == 0){
    echo "Order not found or not allowed!";
    exit();
}

/* CANCEL ORDER */
$update = mysqli_query($conn, "UPDATE orders SET status='Cancelled' WHERE id='$order_id'");

if($update){
    header("Location: my_orders.php?msg=cancelled");
    exit();
}else{
    echo "Unable to cancel order!";
}
?>