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
        <h1>Categories</h1>
        <div class="admin">
            <form action="../../php/adminPages/addCategory.php" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br>
                <label for="parent">Parent:</label><br>
                <select id="parent" name="parent">
                <?php
                include '../../php/getCategories.php';
                include '../../php/getMysqli.php';
                $mysqli = getMysqli();
                $menuGenerator = new MenuGenerator($mysqli);
                $categories = $menuGenerator->getCategories();
                ?>
                    <option value="null">No category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['ID'] ?>"><?= $category['Name'] ?></option>
                    <?php endforeach; ?>
                </select><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
<!-- one WILL get errors however they won't affect the functionality of the webpage -->