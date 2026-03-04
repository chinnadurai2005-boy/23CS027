<?php
session_start();
include("../includes/db_connect.php");

// Admin login check
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Check product id
if (!isset($_GET['id'])) {
    echo "Invalid Request";
    exit();
}

$product_id = intval($_GET['id']);

// Get product image (optional)
$img_sql = "SELECT image FROM products WHERE id = '$product_id'";
$img_result = mysqli_query($conn, $img_sql);
$product = mysqli_fetch_assoc($img_result);

if ($product) {
    $image_path = "../uploads/product_images/" . $product['image'];
    if (file_exists($image_path)) {
        unlink($image_path); // delete image
    }
}

// Delete product
$delete_sql = "DELETE FROM products WHERE id = '$product_id'";
if (mysqli_query($conn, $delete_sql)) {
    header("Location: dashboard.php?msg=Product deleted successfully");
} else {
    echo "Error deleting product";
}
?>
