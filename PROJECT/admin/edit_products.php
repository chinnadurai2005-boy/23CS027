<?php
session_start();
include("../includes/db_connect.php");

/* GET PRODUCT ID */
if(!isset($_GET['id'])){
    echo "Product Not Found";
    exit();
}

$id = intval($_GET['id']);

/* FETCH PRODUCT */
$res = mysqli_query($conn,"SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($res);

if(!$product){
    echo "Product Not Found";
    exit();
}

/* UPDATE PRODUCT */
if(isset($_POST['update'])){

    $name     = mysqli_real_escape_string($conn,$_POST['name']);
    $price    = mysqli_real_escape_string($conn,$_POST['price']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);

    $image_name = $_FILES['image']['name'];
    $tmp_name   = $_FILES['image']['tmp_name'];

    if($image_name!=""){

        $new_name = time()."_".$image_name;
        move_uploaded_file($tmp_name,"../uploads/product_images/".$new_name);

        mysqli_query($conn,"
        UPDATE products 
        SET name='$name',
            price='$price',
            category='$category',
            image='$new_name'
        WHERE id='$id'
        ");

    }else{

        mysqli_query($conn,"
        UPDATE products 
        SET name='$name',
            price='$price',
            category='$category'
        WHERE id='$id'
        ");

    }

    echo "<script>alert('Product Updated Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#020617,#0f172a,#022c22);
    min-height:100vh;
}

/* FORM BOX */
.form-box{
    width:380px;
    margin:60px auto;
    padding:25px;
    background:rgba(255,255,255,0.08);
    border-radius:14px;
    box-shadow:0 20px 50px rgba(0,0,0,0.8);
    color:white;
}

.form-box h2{
    text-align:center;
    color:#22c55e;
}

/* INPUTS */
input,select{
    width:100%;
    padding:10px;
    margin-bottom:12px;
    border:none;
    border-radius:8px;
    background:#020617;
    color:white;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:25px;
    background:linear-gradient(135deg,#22c55e,#4ade80);
    font-weight:bold;
    cursor:pointer;
}

/* BACK BUTTON */
.back-btn{
    display:block;
    text-align:center;
    margin-top:10px;
    padding:10px;
    background:#334155;
    color:white;
    text-decoration:none;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="form-box">

<h2>Edit Product</h2>

<form method="post" enctype="multipart/form-data">

<input type="text" name="name"
value="<?php echo htmlspecialchars($product['name']); ?>" required>

<input type="number" name="price"
value="<?php echo htmlspecialchars($product['price']); ?>" required>

<select name="category" required>

<option value="Dairy" <?php if($product['category']=="Dairy") echo "selected"; ?>>Dairy</option>

<option value="Fruits" <?php if($product['category']=="Fruits") echo "selected"; ?>>Fruits</option>

<option value="Vegetables" <?php if($product['category']=="Vegetables") echo "selected"; ?>>Vegetables</option>

</select>

<p>Current Image:</p>

<img src="../uploads/product_images/<?php echo $product['image']; ?>"
width="100">

<br><br>

<input type="file" name="image">

<button type="submit" name="update">Update Product</button>

</form>

<a class="back-btn" href="dashboard.php">⬅ Back to Dashboard</a>

</div>

</body>
</html>