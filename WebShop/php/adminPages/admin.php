<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaspers Shop</title>
    <link rel="stylesheet" href="../../Design/Template.css">
    <link rel="stylesheet" href="../../Design/Admin.css">
    <link rel="icon" href="../../Images/LogoColour.png">
</head>
<body>
<div class="main">
    <div class="content">
        <button class="BackButton" onclick="window.location.href='../Main.php'">home</button>
        <h1>Admin</h1>
        <div class="admin">
            <a href="./Products.php">
                <button class="adminButton">Add Products</button>
            </a>
            <a href="./manageProducts.php">
                <button class="adminButton">Manage Products</button>
            </a>
            <a href="./Categories.php">
                <button class="adminButton">Categories</button>
            </a>
            <a href="./Orders.php">
                <button class="adminButton">Orders</button>
            </a>
            <a href="../Main.php">
                <button class="adminButton">back to home</button>
            </a>
        </div>
    </div>
</div>
<script src="../../JS/Template.js"></script>
</body>
</html>
<!-- one WILL get errors however they won't affect the functionality of the webpage -->