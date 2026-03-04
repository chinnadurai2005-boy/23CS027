<?php  
include("includes/db_connect.php");  
include("includes/header.php");
?>  <!-- ================= HERO SECTION ================= -->  <section class="hero-banner">  
    <div class="hero-content container">  
        <p class="organic-tag">100% ORGANIC</p>  
        <h1>Healthy Food & Organic Market</h1>  
        <img src="uploads/product_images/1769862545_orange.webp">
        <a href="products.php" class="shop-btn">Shop Now</a>  
    </div>  
</section>  <!-- ================= FEATURES ================= -->  <section class="features-bar container">  
    <div class="feature-item">Organic Certified</div>  
    <div class="feature-item">Money Back Guarantee</div>  
    <div class="feature-item">Always Fresh</div>  
</section>  <!-- ================= SHOP BY CATEGORY ================= -->  <section class="shop-by-category container">  
    <section class="shop-by-category container">
    <h2 class="section-title">Shop By Category</h2>

    <div class="category-grid">

        <a href="products.php?category=Dairy" class="category-card">
            <img src="uploads/product_images/dairy.png">
            <span>Dairy Products</span>
        </a>

        <a href="products.php?category=Fruits" class="category-card">
            <img src="uploads/product_images/fruits.png">
            <span>Fruits</span>
        </a>

        <a href="products.php?category=Vegetables" class="category-card">
            <img src="uploads/product_images/vegetables.png">
            <span>Vegetables</span>
        </a>

    </div>
</section>


</section>  <!-- ================= DEALS OF THE DAY ================= -->  <section class="deals-of-the-day container">  
    <h2 class="section-title">Deals of The Day</h2>  <div class="deal-grid">  
    <div class="deal-item">  
        <div class="deal-image"></div>  
        <h3>Fresh Cabbage</h3>  
        <p class="price">$12.00</p>  
        <a href="#" class="add-to-cart">Add to Cart</a>  
    </div>  

    <div class="deal-item">  
        <div class="deal-image"></div>  
        <h3>Gherkins Pickles</h3>  
        <p class="price">$15.50</p>  
        <a href="#" class="add-to-cart">Add to Cart</a>  
    </div>  
</div>

</section>  <!-- ================= FEATURED PRODUCTS ================= -->  <section class="featured-products container">  
    <h2 class="section-title">Featured Products</h2>  <div class="product-grid">  
    <div class="product-card">  
        <div class="product-image"></div>  
        <p class="product-name">Brownie Spread</p>  
        <p class="product-price">$18.00</p>  
        <a href="#" class="quick-view">Quick View</a>  
    </div>  
</div>

</section>  <!-- ================= MOTTO BANNER ================= -->  <section class="motto-banner">  
    <div class="motto-content">  
        <h2 class="section-title">Live Healthy</h2>  
        <p>Eat fresh, stay strong, live long!</p>  
    </div>  <div class="brand-logos">  
    <div class="logo-item">Chavy</div>  
    <div class="logo-item">Three Bears</div>  
</div>

</section>  <!-- ================= LATEST NEWS ================= -->  <section class="latest-news container">  
    <h2 class="section-title">Latest News</h2>  <div class="news-grid">  
    <article>  
        <div class="news-image"></div>  
        <h3>The best organic farms</h3>  
        <p>Read more...</p>  
    </article>  

    <article>  
        <div class="news-image"></div>  
        <h3>Benefits of fresh juices</h3>  
        <p>Read more...</p>  
    </article>  
</div>
<div>
<a href="../users/user_dashboard.php">Back to Dashboard</a>
</div>

<style>
/* ================= GLOBAL ================= */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:linear-gradient(135deg,#020617,#071a2f);
    color:#fff;
}

/* ================= CONTAINER ================= */
.container{
    width:92%;
    max-width:1200px;
    margin:auto;
}

/* ================= HERO ================= */
.hero-banner{
    background:linear-gradient(135deg,#14532d,#22c55e);
    padding:70px 0;
    border-radius:18px;
    margin-bottom:25px;
    box-shadow:0 20px 40px rgba(0,0,0,0.5);
}

.hero-content{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.organic-tag{
    background:#020617;
    display:inline-block;
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
    width:max-content;
}

.hero-content h1{
    font-size:38px;
    color:white;
}

.hero-banner img{
    width:180px;
    border-radius:12px;
    margin:10px 0;
}

.shop-btn{
    background:#020617;
    color:white;
    text-decoration:none;
    padding:10px 20px;
    border-radius:22px;
    display:inline-block;
    width:max-content;
    transition:0.25s;
}

.shop-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 0 15px rgba(0,0,0,0.4);
}

/* ================= FEATURES ================= */
.features-bar{
    display:flex;
    justify-content:space-between;
    margin:20px auto;
    gap:15px;
}

.feature-item{
    flex:1;
    background:rgba(255,255,255,0.08);
    padding:14px;
    border-radius:12px;
    text-align:center;
    font-size:14px;
    box-shadow:0 10px 20px rgba(0,0,0,0.4);
}

/* ================= SECTION TITLE ================= */
.section-title{
    margin:35px 0 15px;
    font-size:22px;
    color:#22c55e;
}

/* ================= CATEGORY ================= */
.category-grid{
    display:flex;
    gap:18px;
}

.category-card{
    flex:1;
    background:rgba(255,255,255,0.06);
    border-radius:14px;
    padding:12px;
    text-align:center;
    text-decoration:none;
    color:white;
    transition:0.3s;
    box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

.category-card img{
    width:100%;
    height:110px;
    object-fit:contain;
}

.category-card span{
    display:block;
    margin-top:8px;
    font-size:14px;
    font-weight:bold;
}

.category-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(0,0,0,0.8);
}

/* ================= DEALS ================= */
.deal-grid{
    display:flex;
    gap:18px;
}

.deal-item{
    flex:1;
    background:rgba(255,255,255,0.06);
    padding:14px;
    border-radius:14px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

.deal-image{
    height:150px;
    background:#0f172a;
    border-radius:10px;
    margin-bottom:10px;
}

.price{
    color:#22c55e;
    margin:6px 0;
}

.add-to-cart{
    background:#22c55e;
    padding:6px 14px;
    border-radius:18px;
    text-decoration:none;
    color:#020617;
    font-size:13px;
    display:inline-block;
}

/* ================= PRODUCTS ================= */
.product-grid{
    display:flex;
    gap:18px;
    flex-wrap:wrap;
}

.product-card{
    width:31%;
    background:rgba(255,255,255,0.06);
    padding:12px;
    border-radius:14px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

.product-image{
    height:170px;
    background:#0f172a;
    border-radius:10px;
    margin-bottom:10px;
}

.product-name{
    font-size:14px;
}

.product-price{
    color:#22c55e;
    margin:6px 0;
}

.quick-view{
    background:#3b82f6;
    padding:6px 14px;
    border-radius:18px;
    text-decoration:none;
    color:white;
    font-size:13px;
}

/* ================= MOTTO ================= */
.motto-banner{
    margin:40px 0;
    background:linear-gradient(135deg,#22c55e,#16a34a);
    padding:25px;
    border-radius:18px;
    text-align:center;
    color:#020617;
}

.motto-banner p{
    font-size:14px;
}

/* ================= NEWS ================= */
.news-grid{
    display:flex;
    gap:18px;
}

.news-grid article{
    flex:1;
    background:rgba(255,255,255,0.06);
    padding:14px;
    border-radius:14px;
}

.news-image{
    height:120px;
    background:#0f172a;
    border-radius:10px;
    margin-bottom:10px;
}

/* ================= DASHBOARD BUTTON ================= */
.dashboard-btn{
    display:inline-block;
    margin:25px 0;
    background:#f59e0b;
    color:white;
    padding:10px 18px;
    border-radius:22px;
    text-decoration:none;
    transition:0.25s;
}

.dashboard-btn:hover{
    transform:translateY(-2px);
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){

    .features-bar,
    .category-grid,
    .deal-grid,
    .news-grid{
        flex-direction:column;
    }

    .product-card{
        width:100%;
    }
}

</style>
    </style>

</section> 

<?php include("includes/footer.php"); ?> 