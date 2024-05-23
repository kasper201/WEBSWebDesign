<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaspers Shop</title>
    <link rel="stylesheet" href="../Design/Template.css">
    <link rel="stylesheet" href="../Design/Login.css">
    <link rel="icon" href="../Images/Logo.png">
</head>
<body>
<div class="main">
    <?php include './standardised/header.php'; ?>
    <div class="content">
        <h1>Login</h1>
        <form action="./processLogin.php" method="post">
            <label>
                <input type="text" id="email" name="email" placeholder="Email" required="required" />
                <span id="emailValidation"></span>
            </label>
            <label>
                <input type="password" name="password" placeholder="Password" required="required" />
            </label>
            <button type="submit" name="login" id="loginButton" class="login">Login</button>
            <button type="submit" name="register" id="registerButton" class="register">Register</button>
        </form>
        <button type="button" class="logOut" onclick="deleteCookie('username'); window.location.href = './Main.php';">Log out</button>
    </div>
    <?php include './standardised/footer.php'; ?>
</div>
<script src="../JS/Template.js"></script>
<script src="../JS/account.js"></script>
</body>
</html>