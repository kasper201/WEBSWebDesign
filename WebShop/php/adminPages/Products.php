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
        <h1>Add Products</h1>
        <div class="admin">
            <form action="../../php/adminPages/addProduct.php" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br>
                <label for="price">Price:</label><br>
                <input type="text" id="price" name="price" pattern="^\d*(\.\d{0,2})?$" required><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" required></textarea><br>
                <label for="category">Category:</label><br>
                <select id="category" name="category" required>
                    <option value="0">Electronics</option>
                    <option value="1">Clothing</option>
                    <option value="2">Books</option>
                    <option value="3">Games</option>
                    <option value="4">Movies</option>
                    <option value="5">Boats</option>
                </select><br>
                <label for="onSale">On Sale:</label><br>
                <input type="checkbox" id="onSale" name="onSale"><br>
                <label for="image">Image:</label><br>
                <input type="file" id="image" name="image" required><br>
                <input type="submit" value="Submit">
            </form>
    </div>
</div>
<script src="../../JS/Template.js"></script>
</body>
</html>
<!-- one WILL get errors however they won't affect the functionality of the webpage -->