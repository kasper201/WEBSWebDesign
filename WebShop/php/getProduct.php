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

$json = json_encode($products);
error_log("JSON string: " . $json);

foreach ($products as $key => $product) {
    if (!isset($product['image']) || !isset($product['thumbnail'])) {
        error_log("Image or thumbnail not set for product: " . print_r($product, true)); // this shouldn't even be possible but just in case
        continue;
    }
    $products[$key]['image'] = base64_encode($product['image']);
}

$json = json_encode($products);
error_log("JSON string: " . $json);
// Return products information as JSON
header('Content-Type: application/json');
echo json_encode($products);
