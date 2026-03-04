<?php
/* Make sure session is started */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* ================= ADD PRODUCT TO CART ================= */
function addToCart($id, $qty){

    $id  = intval($id);
    $qty = intval($qty);

    if($qty <= 0){
        return;
    }

    if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id] += $qty;
    } else {
        $_SESSION['cart'][$id] = $qty;
    }
}


/* ================= GET SINGLE PRODUCT ================= */
function getProduct($conn, $id){

    $id = intval($id);

    $query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id' LIMIT 1");

    if($query && mysqli_num_rows($query) > 0){
        return mysqli_fetch_assoc($query);
    }

    return false;
}


/* ================= CALCULATE CART TOTAL ================= */
function cartTotal($conn){

    $total = 0;

    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){

        foreach($_SESSION['cart'] as $id => $qty){

            $product = getProduct($conn, $id);

            if($product){
                $total += ($product['price'] * $qty);
            }
        }
    }

    return $total;
}


/* ================= REMOVE ITEM FROM CART ================= */
function removeFromCart($id){

    $id = intval($id);

    if(isset($_SESSION['cart'][$id])){
        unset($_SESSION['cart'][$id]);
    }
}
?>