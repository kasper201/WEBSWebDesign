<?php

include 'getMysqli.php';
include 'getArr.php';

$mysqli = getMysqli();

//get id from the URL parameters
$id = $_GET['productNr'];

error_log("id: " . $id);

$query = "select * from Product where ID = $id";

error_log("Query: " . $query);

$products = getArr($query, $mysqli);

error_log("Products: " . print_r($products, true));

foreach ($products as $key => $product) {
    if (!isset($product['image']) || !isset($product['thumbnail'])) {
        error_log("Image or thumbnail not set for product: " . print_r($product, true)); // this shouldn't even be possible but just in case
        continue;
    }
    $products[$key]['image'] = base64_encode($product['image']);
    $products[$key]['thumbnail'] = base64_encode($product['thumbnail']); // encode the image and thumbnail as base64
}

// Return products information as JSON
header('Content-Type: application/json');
echo json_encode($products);
