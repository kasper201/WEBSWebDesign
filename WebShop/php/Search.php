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
        <?php
            $session["Search"] = $_POST['Search'];
            $search = $session["Search"];
            echo "<h2>Results for: $search</h2>";
            $searchQuery = "SELECT * FROM Product WHERE Name LIKE '%$search%' OR Description LIKE '%$search%'";
        ?>
        <div class="items"></div>
    </div>
    <?php include './standardised/footer.php'; ?>
</div>
<script src="../JS/Template.js"></script>
<script src="../JS/OverviewPages.js"></script>
<script>
    if(!"<?php echo $search; ?>") {
        window.location.href = "./Main.php";
    }
    fetchGeneral({onSale: "null", category:"null", productNr: "null", query: "<?php echo $searchQuery; ?>"});
</script>
</body>
</html>