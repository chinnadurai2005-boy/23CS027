<?php
session_start();
include("../includes/db_connect.php");

// Login Check
// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

// Fetch Products
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body{
    margin:0;
    font-family:Arial;
}

/* SIDEBAR */
.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:220px;
    height:100%;
    background:#2c3e50;
}

.sidebar h2{
    color:white;
    text-align:center;
    padding:15px;
    margin:0;
    background:#1abc9c;
}

.sidebar a{
    display:block;
    padding:12px;
    color:white;
    text-decoration:none;
    border-bottom:1px solid #34495e;
}

.sidebar a:hover{
    background:#1abc9c;
}

/* CONTENT */
.content{
    margin-left:220px;
    padding:20px;
    background:#f4f4f4;
    min-height:100vh;
}

h2{
    margin-top:0;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table, th, td{
    border:1px solid #aaa;
}

th, td{
    padding:10px;
    text-align:center;
}

th{
    background:#1abc9c;
    color:white;
}

.btn{
    padding:5px 10px;
    text-decoration:none;
    color:white;
    border-radius:3px;
}

.edit{ background:#2980b9; }
.delete{ background:#e74c3c; }
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<h2>ADMIN PANEL</h2>
<a href="../index.php">Home</a>
<a href="dashboard.php">Dashboard</a>
<a href="add_product.php">Add Product</a>
<a href="manage_orders.php">Manage Orders</a>
<a href="dashboard.php?logout=1">Logout</a>
</div>

<!-- CONTENT -->
<div class="content">

<h2>Product List</h2>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Image</th>
<th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td>₹<?php echo $row['price']; ?></td>
<td>
<img src="../uploads/product_images/<?php echo $row['image']; ?>" width="60">
</td>
<td>
<a class="btn edit" href="edit_products.php?id=<?php echo $row['id']; ?>">Edit</a>
<a class="btn delete"
   href="delete_product.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Delete this product?')">
Delete
</a>
</td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>
