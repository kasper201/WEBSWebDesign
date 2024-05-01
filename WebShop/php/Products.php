<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaspers Shop</title>
    <link rel="stylesheet" href="../Design/Template.css">
    <link rel="stylesheet" href="../Design/OverviewPages.css">
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
                    <a href="../php/Products.php?category=0">Electronics</a>
                    <a href="../php/Products.php?category=1">Clothing</a>
                    <a href="../php/Products.php?category=2">Books</a>
                    <a href="../php/Products.php?category=3">Games</a>
                    <a href="../php/Products.php?category=4">Movies</a>
                    <a href="../php/Products.php?category=5">Boats</a>
                </ul>
            </div>
        </div>
        <button class="GoToContact">Contact</button>
        <button class="GoToAbout">About Us</button>
        <a href="./Basket.php">
            <img src="../Images/Basket.png" alt="Basket" class="BasketImage">
        </a>
        <a href="./Login.php">
            <img src="../Images/Login.png" alt="Login" class="LoginImage">
        </a>
    </div>
    <div class="content">
        <div class="items">

        </div>

    </div>
    <footer>
        <p>&copy; 2024 Kasper Janssen</p>
    </footer>
</div>
<script src="../JS/Template.js"></script>
<script src="../JS/OverviewPages.js"></script>
<script>
    // Get the URL parameters
    var urlParams = new URLSearchParams(window.location.search);

    // Get the value of id
    var category = urlParams.get('category');

    fetchGeneral({category: category})
</script>
</body>
</html>