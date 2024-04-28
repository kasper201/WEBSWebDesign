<?php
include 'getMysqli.php';

$mysqli = getMysqli();

$query = "SELECT * FROM Product WHERE OnSale = 1";
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
    while($row = $result->fetch_assoc()) {
        array_push($products, $row);
    }
}

// Return products information as JSON
header('Content-Type: application/json');
echo json_encode($products);