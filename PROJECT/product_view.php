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
                <div class="back-btn">
    <a href="javascript:history.back()">← Back</a>
</div>
                
            </form>
        </div>

    </div>

</div>
<style>
/* PAGE BACKGROUND */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#020617,#0f172a);
    color:#fff;
}

/* MAIN CONTAINER */
.product-view-container{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:80vh;
    padding:40px;
}

/* PRODUCT CARD */
.product-view-box{
    display:flex;
    gap:40px;
    width:850px;
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:16px;
    padding:35px;
    box-shadow:0 15px 40px rgba(0,0,0,0.6);
    transition:0.3s ease;
}

/* CARD HOVER */
.product-view-box:hover{
    transform:translateY(-5px);
    box-shadow:0 20px 60px rgba(0,0,0,0.8);
}

/* PRODUCT IMAGE AREA */
.product-image{
    width:320px;
    height:320px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#0b1220;
    border-radius:12px;
    overflow:hidden;
}

/* IMAGE STYLE */
.product-image img{
    width:100%;
    height:100%;
    object-fit:contain;
    transition:transform 0.4s ease;
}

/* IMAGE HOVER ZOOM */
.product-image img:hover{
    transform:scale(1.1);
}

/* PRODUCT DETAILS */
.product-details{
    flex:1;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

/* PRODUCT TITLE */
.product-details h2{
    font-size:30px;
    margin-bottom:10px;
    color:#22c55e;
}

/* PRICE STYLE */
.price{
    font-size:26px;
    font-weight:bold;
    margin-bottom:25px;
    color:#38bdf8;
}

/* BUTTON STYLE */
.btn{
    padding:12px 30px;
    border:none;
    border-radius:30px;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    background:linear-gradient(135deg,#22c55e,#15803d);
    color:white;
    transition:0.3s ease;
    box-shadow:0 8px 20px rgba(34,197,94,0.4);
}

/* BUTTON HOVER */
.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 30px rgba(34,197,94,0.7);
}

/* RESPONSIVE DESIGN */
@media(max-width:768px){

.product-view-box{
    flex-direction:column;
    align-items:center;
    width:95%;
}

.product-image{
    width:100%;
    height:260px;
}

.product-details{
    text-align:center;
}

}
/* BACK BUTTON */
.back-btn{
    margin:20px;
}

.back-btn a{
    text-decoration:none;
    color:white;
    background:#1e293b;
    padding:8px 16px;
    border-radius:8px;
    transition:0.3s;
    font-weight:500;
}

.back-btn a:hover{
    background:#22c55e;
}
    </style>

<?php include("includes/footer.php"); ?>
