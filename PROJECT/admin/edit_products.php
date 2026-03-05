<?php
session_start();
include("../includes/db_connect.php");

// Check if product ID exists
if(!isset($_GET['id'])){
    echo "Invalid Product ID";
    exit();
}

$id = intval($_GET['id']);

// Fetch product details
$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($result);

if(!$product){
    echo "Product not found";
    exit();
}

// UPDATE PRODUCT
if(isset($_POST['update_product'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Image upload (optional)
    $image = $product['image'];

    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/product_images/".$image);
    }

    $update = mysqli_query($conn,
        "UPDATE products SET 
        name='$name',
        price='$price',
        category='$category',
        description='$description',
        image='$image'
        WHERE id='$id'"
    );

    if($update){
        echo "<script>alert('Product Updated Successfully');</script>";
        echo "<script>window.location='manage_products.php';</script>";
    } else {
        echo "Update Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<h2>Edit Product</h2>

<form method="post" enctype="multipart/form-data">

    <label>Product Name:</label><br>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>

    <label>Price:</label><br>
    <input type="text" name="price" value="<?php echo $product['price']; ?>" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?php echo $product['category']; ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required><?php echo $product['description']; ?></textarea><br><br>

    <label>Current Image:</label><br>
    <img src="../uploads/product_images/<?php echo $product['image']; ?>" width="100"><br><br>

    <label>Change Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit" name="update_product">Update Product</button>

</form>

</body>
</html>