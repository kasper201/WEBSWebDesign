<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaspers Shop</title>
    <link rel="stylesheet" href="../Design/Template.css">
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
        <a href="../php/Basket.php">
            <img src="../Images/Basket.png" alt="cart" class="BasketImage">
        </a>
        <a href="../php/Login.php">
            <img src="../Images/Login.png" alt="Login" class="LoginImage">
        </a>
    </div>
    <div class="content">
        <h2>Welcome to Kaspers Shop</h2>
        <p>This website is made as a project made by Kasper Janssen. They are a second year student studying Embedded Software/Computer Science in The Netherlands. </p>
        <h3>Hobbies</h3>
        <p>In their free time Kasper likes to game, especially Beat Saber. For this game he has also made multiple overlays for tournaments. Furthermore they love playing the bass-guitar, especially in their band called "De Stichting". Here they play mostly Rock/Pop-Rock and are constantly looking for fun gigs! Kasper has also grown up on a boat and loves sailing.</p>
        <h3>Future</h3>
        <p>Kasper hopes to finish the study within 4 years and is thinking about doing a masters afterwards. </p>
    </div>
    <footer>
        <p>&copy; 2024 Kasper Janssen</p>
    </footer>
</div>
<script src="../JS/Template.js"></script>
</body>
</html>
<?php
