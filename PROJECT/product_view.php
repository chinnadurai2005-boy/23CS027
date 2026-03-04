<?php
session_start();
include("includes/db_connect.php");
include("includes/functions.php");
include("includes/header.php");

// Check product ID
if (!isset($_GET['id'])) {
    echo "<p>Product not found</p>";
    include("includes/footer.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch product
$query = "SELECT * FROM products WHERE id=$id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "<p>Product not found</p>";
    include("includes/footer.php");
    exit();
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    addToCart($id, 1);
    header("Location: cart.php");
    exit();
}
?>

<div class="product-view-container">

    <div class="product-view-box">

        <div class="product-image">
            <img src="uploads/product_images/<?php echo $product['image']; ?>" alt="">
        </div>

        <div class="product-details">
            <h2><?php echo $product['name']; ?></h2>

            <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>

        

            <form method="post">
                <button type="submit" name="add_to_cart" class="btn">
                    Add to Cart
                </button>
            </form>
        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>
