<?php
session_start();
include("includes/db_connect.php");
include("includes/header.php");

/* =========================
   ADD TO CART FUNCTIONALITY
========================= */
if(isset($_POST['add_to_cart']) && isset($_POST['product_id'])){

    $id = intval($_POST['product_id']);

    if($id > 0){

        if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }

        if(array_key_exists($id, $_SESSION['cart'])){
            $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + 1;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        echo "<script>window.location='cart.php';</script>";
        exit();
    }
}

/* =========================
   CATEGORY FILTER
========================= */

$category = "";
if(isset($_GET['category'])){
    $category = $_GET['category'];
}
?>

<style>
/* ===== PAGE BACKGROUND ===== */
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:linear-gradient(135deg,#020617,#071a2f);
    color:white;
}

/* ===== CONTAINER ===== */
.products-container{
    width:92%;
    margin:25px auto;
}

/* ===== PAGE TITLE ===== */
.products-container h2{
    text-align:center;
    margin-bottom:20px;
    font-size:26px;
    letter-spacing:0.5px;
    color:#22c55e;
}

/* ===== CATEGORY MENU ===== */
.category-menu{
    text-align:center;
    margin-bottom:30px;
}

.category-menu a{
    display:inline-block;
    padding:8px 18px;
    background:#15803d;
    color:white;
    text-decoration:none;
    margin:6px;
    border-radius:20px;
    font-size:14px;
    transition:0.25s ease;
    box-shadow:0 0 10px rgba(34,197,94,0.25);
}

.category-menu a:hover{
    background:#22c55e;
    transform:translateY(-2px);
    box-shadow:0 0 18px rgba(34,197,94,0.6);
}

/* ===== PRODUCT GRID ===== */
.product-grid{
    display:flex;
    flex-wrap:wrap;
    gap:22px;
    justify-content:flex-start;
}

/* ===== PRODUCT CARD ===== */
.product-card{
    width:23%;
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(12px);
    border-radius:14px;
    padding:12px;
    text-align:center;
    transition:0.3s ease;
    box-shadow:0 10px 25px rgba(0,0,0,0.5);
    position:relative;
    overflow:hidden;
}

/* Hover Animation */
.product-card:hover{
    transform:translateY(-6px) scale(1.02);
    box-shadow:0 18px 40px rgba(0,0,0,0.8);
}

/* subtle glow effect */
.product-card:before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(120deg,transparent,rgba(255,255,255,0.12),transparent);
    transition:0.6s;
}

.product-card:hover:before{
    left:100%;
}

/* ===== PRODUCT IMAGE ===== */
.product-card img{
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:10px;
    margin-bottom:8px;
}

/* ===== PRODUCT NAME ===== */
.product-card h3{
    margin:8px 0;
    font-size:16px;
    font-weight:bold;
    color:#f9fafb;
}

/* ===== PRICE ===== */
.product-card p{
    font-size:17px;
    color:#22c55e;
    font-weight:bold;
    margin:5px 0 10px;
}

/* ===== BUTTONS ===== */
.product-card a,
.product-card button{
    display:inline-block;
    background:linear-gradient(135deg,#f59e0b,#f97316);
    padding:7px 14px;
    color:white;
    text-decoration:none;
    border-radius:18px;
    font-size:13px;
    border:none;
    cursor:pointer;
    transition:0.25s ease;
    margin:4px;
    box-shadow:0 0 12px rgba(249,115,22,0.3);
}

/* Hover Effect */
.product-card a:hover,
.product-card button:hover{
    transform:translateY(-2px);
    box-shadow:0 0 20px rgba(249,115,22,0.7);
}

/* ===== FORM ALIGNMENT ===== */
.product-card form{
    margin-top:8px;
}

/* ===== MOBILE RESPONSIVE ===== */
@media(max-width:992px){
    .product-card{ width:31%; }
}

@media(max-width:768px){
    .product-card{ width:48%; }
}

@media(max-width:480px){
    .product-card{ width:100%; }
}
</style>

<div class="products-container">

<h2 style="text-align:center;">All Products</h2>

<div class="category-menu">
    <a href="products.php">All</a>
    <a href="products.php?category=Dairy">Dairy</a>
    <a href="products.php?category=Fruits">Fruits</a>
    <a href="products.php?category=Vegetables">Vegetables</a>
</div>

<div class="product-grid">

<?php
if($category!=""){
    $query = mysqli_query($conn,"SELECT * FROM products WHERE category='$category'");
}else{
    $query = mysqli_query($conn,"SELECT * FROM products");
}

while($row = mysqli_fetch_assoc($query)){
?>

<div class="product-card">

    <img src="uploads/product_images/<?php echo $row['image']; ?>">

    <h3><?php echo $row['name']; ?></h3>

    <p>₹<?php echo $row['price']; ?></p>

    <a href="product_view.php?id=<?php echo $row['id']; ?>">View</a>

    <!-- ADD TO CART FORM -->
    <form method="post" action="products.php" style="margin-top:10px;">
        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
        <button type="submit" name="add_to_cart">Add To Cart</button>
    </form>

</div>

<?php } ?>

</div>
</div>

<?php include("includes/footer.php"); ?>
