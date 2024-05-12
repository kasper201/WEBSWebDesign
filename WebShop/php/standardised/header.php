<div class="menu">
    <a href="./Main.php">
        <img src="../Images/Logo.png" alt="Logo" class="logo" onclick="">
    </a>
    <div class="Products">
        <span class="GoToProducts"><a href="./Products.php" >Products</a></span>
        <div class="submenu">
            <?php
            include 'getMysqli.php';
            include 'getCategories.php';

            $mysqli = getMysqli();
            $menuGenerator = new MenuGenerator($mysqli);
            $menuGenerator->generateMenu();
            ?>
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