<div class="menu">
    <a href="./Main.php">
        <img src="../Images/Logo.png" alt="Logo" class="logo" onclick="">
    </a>
    <form action="./Search.php" method="post">
        <label>
            <input type="text" class="SearchBar" name="Search" placeholder="Search..">
        </label>
    </form>
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
    <div class="loginInfo">
        <span>
            <a href="./Login.php">
                <img src="../Images/Login.png" alt="Login" class="LoginImage">
            </a>
        </span>
        <div class='submenuLogin'>
            <?php
            if(isset($_COOKIE['user'])) {
                // User is logged in
                echo '<button type="button" class="logOut" onclick="logoutUser()">Log out</button>';
                echo "<a href='./Profile.php'>Profile</a>";
            } else {
                // User is not logged in
                echo "<a href='./Login.php'>Login</a>";
                echo "<a href='./Login.php'>Register</a>";
            }
            ?>
        </div>
    </div>
    <script>
        function logoutUser() {
            document.cookie = 'user=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            window.location.href = './Main.php';
        }
    </script>

</div>