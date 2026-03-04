<?php
session_start();
include("includes/db_connect.php");
include("includes/functions.php");
include("includes/header.php");

// Add product from products.php
if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    addToCart($product_id, 1);
    header("Location: cart.php");
    exit();
}

// Remove item
if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$remove_id]);
    header("Location: cart.php");
    exit();
}
?>
<style>
/* PAGE BACKGROUND */
body{
    margin:0;
    font-family:'Segoe UI', Arial, sans-serif;
    background:linear-gradient(135deg,#020617,#040b1a);
    color:white;
}

/* CART CONTAINER */
.cart-container{
    width:95%;
    max-width:1100px;
    margin:40px auto;
    background:rgba(255,255,255,0.03);
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:14px;
    padding:25px;
    box-shadow:0 0 30px rgba(0,0,0,0.65);
    animation:fadeIn 0.35s ease;
}

/* TITLE */
.cart-container h2{
    margin-top:0;
    color:#22c55e;
    font-weight:600;
    letter-spacing:0.4px;
}

/* TABLE */
.cart-container table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
    overflow:hidden;
    border-radius:10px;
}

/* TABLE HEADER */
.cart-container th{
    background:linear-gradient(135deg,#15803d,#22c55e);
    padding:12px;
    font-weight:600;
    font-size:14px;
    border:none;
}

/* TABLE CELLS */
.cart-container td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid rgba(255,255,255,0.05);
    font-size:14px;
}

/* ROW HOVER */
.cart-container tr:hover td{
    background:rgba(255,255,255,0.03);
}

/* REMOVE BUTTON */
.cart-container a{
    text-decoration:none;
    color:#ef4444;
    font-weight:500;
    transition:0.2s ease;
}

.cart-container a:hover{
    color:#f87171;
}

/* GRAND TOTAL */
.cart-container h3{
    margin-top:20px;
    font-weight:600;
    color:#22c55e;
}

/* CHECKOUT BUTTON */
.btn{
    display:inline-block;
    padding:10px 22px;
    border-radius:25px;
    background:linear-gradient(135deg,#22c55e,#15803d);
    color:white !important;
    font-weight:600;
    font-size:14px;
    transition:0.25s ease;
    box-shadow:0 0 15px rgba(34,197,94,0.35);
}

/* BUTTON HOVER */
.btn:hover{
    transform:translateY(-1px);
    box-shadow:0 0 25px rgba(34,197,94,0.65);
}

/* EMPTY CART TEXT */
.cart-container p{
    text-align:center;
    padding:30px;
    color:#9ca3af;
}

/* ANIMATION */
@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(8px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
    </style>


<div class="cart-container">

    <h2>Your Cart</h2>

    <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>

        <p>Your cart is empty</p>

    <?php } else { ?>

    <table border="1" width="100%" cellpadding="10">
        <tr>
            <th>Product</th>
            <th>Price (₹)</th>
            <th>Qty</th>
            <th>Total (₹)</th>
            <th>Action</th>
        </tr>

        <?php foreach ($_SESSION['cart'] as $id => $qty) {

            $product = getProduct($conn, $id);
            if (!$product) continue;

            $total = $product['price'] * $qty;
        ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo number_format($product['price'], 2); ?></td>
            <td><?php echo $qty; ?></td>
            <td><?php echo number_format($total, 2); ?></td>
            <td>
                <a href="cart.php?remove=<?php echo $id; ?>">Remove</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h3 style="text-align:right;">
        Grand Total: ₹<?php echo number_format(cartTotal($conn), 2); ?>
    </h3>

    <div style="text-align:right;">
        <a href="checkout.php" class="btn">Proceed to Checkout</a>
    </div>

    <?php } ?>

</div>

<?php include("includes/footer.php"); ?>
