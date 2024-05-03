<?php

include 'getMysqli.php';
include 'getArr.php';

function overviewPages($queryIn)
{
    $mysqli = getMysqli();

    $query = $queryIn;
    $products = getArr($query, $mysqli);

    /*
    foreach ($products as $key => $product) {
        if (!isset($product['image']) || !isset($product['thumbnail'])) {
            error_log("Image or thumbnail not set for product: " . print_r($product, true));
            continue;
        }
        $products[$key]['image'] = base64_encode($product['image']);
        $products[$key]['thumbnail'] = base64_encode($product['thumbnail']);
    }
*/
    // Return products information as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
}