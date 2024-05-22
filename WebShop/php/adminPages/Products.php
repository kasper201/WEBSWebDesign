<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add products</title>
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
                <?php
                include '../../php/getCategories.php';
                include '../../php/getMysqli.php';
                $mysqli = getMysqli();
                $menuGenerator = new MenuGenerator($mysqli);
                $categories = $menuGenerator->getCategories();
                ?>

                <select id="category" name="category" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['ID'] ?>"><?= $category['Name'] ?></option>
                    <?php endforeach; ?>
                </select><br>
                <label for="onSale">On Sale:</label><br>
                <input type="checkbox" id="onSale" name="onSale"><br>
                <label for="image">Image:</label><br>
                <input type="file" id="image" name="image" required><br>
                <input type="submit" value="Submit">
            </form>
    </div>
</div>
</body>
</html>
<!-- TODO: connect to categories -->