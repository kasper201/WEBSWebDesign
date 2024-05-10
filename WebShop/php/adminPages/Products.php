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
        <button class="BackButton" onclick="window.location.href='admin.php'">Back</button>
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
                <label for="subcategory">Subcategory:</label><br>
                <select id="subcategory" name="subcategory" required>
                    <option value="0">Phones</option>
                    <option value="1">Laptops</option>
                    <option value="2">Tablets</option>
                    <option value="3">T-Shirts</option>
                    <option value="4">Pants</option>
                    <option value="5">Hoodies</option>
                    <option value="6">Fantasy</option>
                    <option value="7">Sci-Fi</option>
                    <option value="8">Horror</option>
                    <option value="9">Action</option>
                    <option value="10">Comedy</option>
                    <option value="11">Thriller</option>
                    <option value="12">Fishing</option>
                    <option value="13">Sailing</option>
                    <option value="14">Speedboats</option>
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
<!-- TODO: make categories and subcategories dynamic -->