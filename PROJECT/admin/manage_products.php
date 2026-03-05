<?php
session_start();
include("../includes/db_connect.php");
?>

<h2>Manage Products</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Category</th>
    <th>Image</th>
    <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM products");

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td>₹<?php echo $row['price']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td>
        <img src="../uploads/product_images/<?php echo $row['image']; ?>" width="60">
    </td>
    <td>
        <a href="edit_products.php?id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="delete_product.php?id=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure?');">Delete</a>
    </td>
</tr>

<?php } ?>

</table>