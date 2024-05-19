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
                <input type="text" name="email" placeholder="Email" required="required" />
            </label>
            <label>
                <input type="password" name="password" placeholder="Password" required="required" />
            </label>
            <button type="submit" name="login" class="login">Login</button>
            <button type="submit" name="register" class="register">Register</button>
        </form>
    </div>
    <?php include './standardised/footer.php'; ?>
</div>
<script src="../JS/Template.js"></script>
</body>
</html>