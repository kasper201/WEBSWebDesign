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
        <h1>All Orders</h1>
        <div class="admin">

        </div>
    </div>
    <script src="../../JS/Template.js"></script>
    <script src="../../JS/orders.js"></script>
</body>
</html>
<?php
include './getAdminMysqli.php';
include '../getArr.php';

$mysqli = getAdminMysqli();
$orders = getArr($_GET['query'], $mysqli);
?>
<!-- one WILL get errors however they won't affect the functionality of the webpage -->