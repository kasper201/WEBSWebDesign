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
    <?php include './standardised/header.php'; ?>
    <div class="content">
        <h2>Welcome to Kaspers Shop</h2>
        <div class="items">
            <!-- this is an example of how the structure of the product should be -->
            <!--<div class="product">
                <a href="../php/Product.css">
                    <img src="../Images/LogoColour.png" alt="Logo" class="productImage">
                    <h3>Product</h3>
                    <p>Price: €0.00</p>
                </a>
            </div>-->
        </div>
    </div>
    <?php include './standardised/footer.php'; ?>
</div>
<script src="../JS/Template.js"></script>
<script src="../JS/OverviewPages.js"></script>
<script>
    fetchGeneral({onSale: "true", category: null, query: null});
</script>
</body>
</html>