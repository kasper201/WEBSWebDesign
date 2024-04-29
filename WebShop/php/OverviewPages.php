<?php

include 'getMysqli.php';

function overviewPages($queryIn)
{
    $mysqli = getMysqli();

    $query = $queryIn;
    error_log("Executing query: " . $query);

    $result = $mysqli->query($query);
    error_log("Number of rows: " . $result->num_rows);

    if ($mysqli->error) {
        error_log("SQL error: " . $mysqli->error); // Log the error
        http_response_code(500); // Send a 500 status code
        echo "SQL error: " . $mysqli->error;
        exit;
    }

    $products = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($products, $row);
        }
    }

    foreach ($products as $key => $product) {
        if (!isset($product['image']) || !isset($product['thumbnail'])) {
            error_log("Image or thumbnail not set for product: " . print_r($product, true));
            continue;
        }
        $products[$key]['image'] = base64_encode($product['image']);
        $products[$key]['thumbnail'] = base64_encode($product['thumbnail']);
    }

    // Return products information as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
}