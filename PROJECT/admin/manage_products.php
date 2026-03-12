<?php
session_start();
include("../includes/db_connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Products</title>

<style>

/* PAGE BACKGROUND */
body{
    margin:0;
    font-family:'Segoe UI',Arial;
    background:linear-gradient(135deg,#020617,#0f172a,#022c22);
    color:white;
}

/* PAGE TITLE */
h2{
    text-align:center;
    margin-top:30px;
    color:#22c55e;
    letter-spacing:1px;
}

/* TABLE CONTAINER */
.table-box{
    width:90%;
    margin:40px auto;
    padding:20px;
    border-radius:14px;
    background:rgba(255,255,255,0.06);
    backdrop-filter:blur(10px);
    box-shadow:0 20px 40px rgba(0,0,0,0.8);
}

/* TABLE STYLE */
table{
    width:100%;
    border-collapse:collapse;
}

/* TABLE HEADER */
th{
    background:#020617;
    padding:14px;
    text-align:left;
    border-bottom:2px solid #22c55e;
}

/* TABLE DATA */
td{
    padding:12px;
    border-bottom:1px solid rgba(255,255,255,0.08);
}

/* ROW HOVER EFFECT */
tr:hover{
    background:rgba(34,197,94,0.08);
    transition:0.2s;
}

/* PRODUCT IMAGE */
img{
    border-radius:6px;
    box-shadow:0 4px 12px rgba(0,0,0,0.6);
}

/* ACTION BUTTONS */
.action-btn{
    padding:6px 12px;
    border-radius:20px;
    text-decoration:none;
    font-size:13px;
    font-weight:bold;
}

/* EDIT BUTTON */
.edit-btn{
    background:linear-gradient(135deg,#22c55e,#4ade80);
    color:#022c22;
}

/* DELETE BUTTON */
.delete-btn{
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:white;
}

/* BUTTON HOVER */
.action-btn:hover{
    transform:scale(1.05);
    box-shadow:0 0 12px rgba(0,0,0,0.5);
}

/* RESPONSIVE */
@media(max-width:768px){

table{
    font-size:13px;
}

img{
    width:40px;
}

}

</style>
</head>

<body>

<h2>Manage Products</h2>

<div class="table-box">

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Category</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM products");

while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $row['category']; ?></td>

<td>
<img src="../uploads/product_images/<?php echo $row['image']; ?>" width="60">
</td>

<td>

<a class="action-btn edit-btn"
href="edit_products.php?id=<?php echo $row['id']; ?>">
Edit
</a>

<a class="action-btn delete-btn"
href="delete_product.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure?');">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>