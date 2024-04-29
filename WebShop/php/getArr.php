<?php

/**
 * @param $query
 * @param mysqli $mysqli
 * @return array|void
 */
function getArr($query, mysqli $mysqli)
{
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
    return $products;
}