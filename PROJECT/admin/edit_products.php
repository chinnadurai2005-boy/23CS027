<?php
session_start();
include("../includes/db_connect.php");

/* OPTIONAL ADMIN LOGIN CHECK */
/*
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
*/

/* GET PRODUCT ID */
if(!isset($_GET['id'])){
    die("Product ID Missing");
}

$id = $_GET['id'];

/* FETCH PRODUCT */
$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($result);

if(!$product){
    die("Product Not Found");
}

/* UPDATE PRODUCT */
if(isset($_POST['update'])){

    $name     = $_POST['name'];
    $price    = $_POST['price'];
    $category = $_POST['category'];

    $image_name = $_FILES['image']['name'];
    $tmp_name   = $_FILES['image']['tmp_name'];

    /* IMAGE UPDATE */
    if($image_name!=""){

        $new_name = time()."_".$image_name;
        move_uploaded_file($tmp_name,"../uploads/product_images/".$new_name);

        mysqli_query($conn,"
            UPDATE products 
            SET name='$name', price='$price', category='$category', image='$new_name'
            WHERE id='$id'
        ");

    } else {

        mysqli_query($conn,"
            UPDATE products 
            SET name='$name', price='$price', category='$category'
            WHERE id='$id'
        ");
    }

    echo "<script>alert('Product Updated Successfully');</script>";
    echo "<script>window.location='manage_products.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>

<style>
.form-box{
    width:350px;
    margin:50px auto;
    padding:20px;
    background:#ffffff;
    border:1px solid #ccc;
    box-shadow:0px 0px 10px #ccc;
}

input, select{
    width:100%;
    padding:10px;
    margin-bottom:12px;
}

button{
    width:100%;
    padding:10px;
    background:green;
    color:white;
    border:none;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:darkgreen;
}

img{
    width:80px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<div class="form-box">

<h2 align="center">Edit Product</h2>

<form method="post" enctype="multipart/form-data">

<input type="text" name="name"
       value="<?php echo $product['name']; ?>" required>

<input type="number" name="price"
       value="<?php echo $product['price']; ?>" required>

<select name="category" required>
    <option value="Dairy" <?php if($product['category']=="Dairy") echo "selected"; ?>>Dairy</option>
    <option value="Fruits" <?php if($product['category']=="Fruits") echo "selected"; ?>>Fruits</option>
    <option value="Vegetables" <?php if($product['category']=="Vegetables") echo "selected"; ?>>Vegetables</option>
</select>

<!-- CURRENT IMAGE -->
<?php if($product['image']!=""){ ?>
    <center>
        <img src="../uploads/product_images/<?php echo $product['image']; ?>">
    </center>
<?php } ?>

<input type="file" name="image">

<button type="submit" name="update">Update Product</button>

</form>

</div>

</body>
</html>