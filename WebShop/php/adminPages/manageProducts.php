<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage products</title>
    <link rel="stylesheet" href="../../Design/Template.css">
    <link rel="stylesheet" href="../../Design/Admin.css">
    <link rel="stylesheet" href="../../Design/Orders.css">
    <link rel="icon" href="../../Images/LogoColour.png">
</head>
<body>
<div class="main">
    <div class="content">
        <button class="BackButton" onclick="window.location.href='admin.php'">Back</button>
        <h1>Manage Exisiting Products</h1>
        <div class="admin">
            <table id="productTable">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price (€)</th>
                    <th>Description</th>
                    <th>OnSale</th>
                </tr>
            </table>
        </div>
    </div>
    <script src="../../JS/changeProducts.js"></script>
</body>
</html>