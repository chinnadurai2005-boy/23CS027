<?php
session_start();
include("../includes/db_connect.php");

/* ADMIN LOGIN CHECK */
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

/* CHECK PRODUCT ID */
if(!isset($_GET['id'])){
    echo "Invalid Request";
    exit();
}

$product_id = intval($_GET['id']);

/* GET PRODUCT IMAGE */
$sql = "SELECT image FROM products WHERE id='$product_id'";
$result = mysqli_query($conn,$sql);

if(!$result){
    die("Database Error: ".mysqli_error($conn));
}

$product = mysqli_fetch_assoc($result);

/* DELETE IMAGE FILE */
if($product && !empty($product['image'])){

    $image_path = "../uploads/product_images/".$product['image'];

    if(file_exists($image_path)){
        unlink($image_path);
    }
}

/* DELETE PRODUCT FROM DATABASE */
$delete_sql = "DELETE FROM products WHERE id='$product_id'";
$delete = mysqli_query($conn,$delete_sql);

if($delete){
    header("Location: dashboard.php?msg=Product Deleted Successfully");
    exit();
}else{
    echo "Error deleting product: ".mysqli_error($conn);
}
?>