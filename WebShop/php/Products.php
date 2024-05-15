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
        <div class="items">

        </div>

    </div>
    <?php include './standardised/footer.php'; ?>
</div>
<script src="../JS/Template.js"></script>
<script src="../JS/OverviewPages.js"></script>
<script>
    // Get the URL parameters
    var urlParams = new URLSearchParams(window.location.search);

    // Get the value of id
    var category = urlParams.get('category');

    fetchGeneral({category: category, productNr: "null", query: "null", onSale: "null"});
</script>
</body>
</html>