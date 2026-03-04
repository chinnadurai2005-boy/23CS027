<?php
session_start();
include("../includes/db_connect.php");
include("../includes/functions.php");

if(isset($_POST['submit'])){

    $name     = $_POST['name'];
    $price    = $_POST['price'];
    $category = $_POST['category'];

    $image_name = $_FILES['image']['name'];
    $tmp_name   = $_FILES['image']['tmp_name'];

    if($image_name!=""){
        $new_name = time()."_".$image_name;
        move_uploaded_file($tmp_name,"../uploads/product_images/".$new_name);
    }else{
        $new_name = "";
    }

    mysqli_query($conn,"
        INSERT INTO products(name,price,image,category)
        VALUES('$name','$price','$new_name','$category')
    ");

    echo "<script>alert('Product Added Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>

<style>
/* ================= PAGE ================= */
body{
    margin:0;
    padding:0;
    font-family:Arial, sans-serif;
    background:linear-gradient(135deg,#020617,#0f172a,#022c22);
    min-height:100vh;
}

/* ================= FORM CONTAINER ================= */
.form-box{
    width:380px;
    margin:60px auto;
    padding:25px;
    background:rgba(255,255,255,0.08);
    border-radius:14px;
    box-shadow:0 20px 50px rgba(0,0,0,0.8);
    backdrop-filter:blur(12px); /* Safe fallback if unsupported */
    color:white;
    transition:0.35s ease;
}

/* Hover Lift Effect */
.form-box:hover{
    transform:translateY(-6px);
    box-shadow:0 28px 70px rgba(0,0,0,0.95);
}

/* ================= TITLE ================= */
.form-box h2{
    margin-bottom:18px;
    color:#22c55e;
    letter-spacing:1px;
    text-shadow:0 0 12px rgba(34,197,94,0.4);
}

/* ================= INPUTS ================= */
input, select{
    width:100%;
    padding:11px;
    margin-bottom:14px;
    border:none;
    border-radius:8px;
    background:#020617;
    color:white;
    font-size:14px;
    outline:none;
    border:1px solid rgba(255,255,255,0.08);
    transition:0.25s;
}

/* Focus Glow */
input:focus, select:focus{
    border:1px solid #22c55e;
    box-shadow:0 0 10px rgba(34,197,94,0.4);
}

/* Dropdown background */
select option{
    background:#020617;
}

/* ================= BUTTON ================= */
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:25px;
    background:linear-gradient(135deg,#22c55e,#4ade80);
    color:#022c22;
    font-size:15px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s ease;
    box-shadow:0 0 18px rgba(34,197,94,0.35);
}

/* Button Hover */
button:hover{
    transform:translateY(-2px);
    box-shadow:0 0 28px rgba(34,197,94,0.7);
}

/* ================= FILE INPUT ================= */
input[type="file"]{
    background:#020617;
    padding:8px;
    cursor:pointer;
}

/* ================= BACK BUTTON ================= */
.back-btn{
    display:block;
    text-align:center;
    margin-top:12px;
    padding:10px;
    border-radius:22px;
    background:linear-gradient(135deg,#334155,#0f172a);
    color:#e5e7eb;
    text-decoration:none;
    font-size:13px;
    font-weight:bold;
    transition:0.3s;
    border:1px solid rgba(255,255,255,0.08);
}

/* Back Hover */
.back-btn:hover{
    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:#022c22;
    box-shadow:0 0 18px rgba(34,197,94,0.6);
}

/* ================= RESPONSIVE ================= */
@media(max-width:480px){
    .form-box{
        width:92%;
        margin-top:30px;
    }
}
</style>
</head>

<body>

<div class="form-box">

<h2 align="center">Add Product</h2>

<form method="post" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Product Name" required>

<input type="number" name="price" placeholder="Price" required>

<select name="category" required>
    <option value="">Select Category</option>
    <option value="Dairy">Dairy</option>
    <option value="Fruits">Fruits</option>
    <option value="Vegetables">Vegetables</option>
</select>

<input type="file" name="image" required>

<button type="submit" name="submit">Add Product</button>

</form>

<!-- ✅ Back to Dashboard -->
<a class="back-btn" href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>
</html>