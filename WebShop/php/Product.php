<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaspers Shop</title>
    <link rel="stylesheet" href="../Design/Template.css">
    <link rel="stylesheet" href="../Design/Product.css">
    <link rel="icon" href="../Images/LogoColour.png">
</head>
<body>
<div class="main">
    <div class="menu">
        <a href="../HTML/Main.html">
            <img src="../Images/Logo.png" alt="Logo" class="logo" onclick="">
        </a>
        <div class="Products">
            <span class="GoToProducts"><a href="../php/Products.php" >Products</a></span>
            <div class="submenu-container">
                <ul class="submenu">
                    <a href="../php/Products.php">All</a>
                    <a href="../php/Products.php?category=1">Electronics</a>
                    <a href="../php/Products.php?category=2">Clothing</a>
                    <a href="../php/Products.php?category=3">Books</a>
                    <a href="../php/Products.php?category=4">Games</a>
                    <a href="../php/Products.php?category=5">Movies</a>
                    <a href="../php/Products.php?category=6">People</a>
                </ul>
            </div>
        </div>
        <button class="GoToContact">Contact</button>
        <button class="GoToAbout">About Us</button>
        <a href="Basket.php">
            <img src="../Images/Basket.png" alt="Basket" class="BasketImage">
        </a>
        <a href="Login.php">
            <img src="../Images/Login.png" alt="Login" class="LoginImage">
        </a>
    </div>
    <div class="content">
        <div class="product">
            <!--<div class="productImage">
                <img src="../Images/ohno.png" alt="Product Image" class="product-image">
            </div>
            <div class="product-info">
                <h1 class="product-name">
                    Kaas
                </h1>
                <p class="product-price"></p>
                <p class="selectAmount">Select Amount: <input type="number" class="amount" value="1" min="1"></p>
                <button class="addToBasket">Add to Basket</button>
                <p class="product-description"></p>
            </div>-->
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Kasper Janssen</p>
    </footer>
</div>
<script src="../JS/Template.js"></script>
<script src="../JS/Product.js"></script>
</body>
</html>
