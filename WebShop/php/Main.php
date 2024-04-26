<?php
include 'getMysqli.php';

$mysqli = getMysqli();

$result = $mysqli->query("SELECT * FROM Products WHERE Sale = 1");
error_log("Number of rows: ", $result->num_rows);

if ($mysqli->error) {
    error_log("SQL error: " . $mysqli->error); // Log the error
    http_response_code(500); // Send a 500 status code
    echo "SQL error: " . $mysqli->error;
    exit;
}

if ($result->num_rows > 0) {
    // Fetch the first row
    $row = $result->fetch_assoc();

    foreach ($row as $key => $value) {
        if (is_null($value)) {
            $row[$key] = "N/A"; // replace with default value
        }
    }

    // Return circuit information as JSON
    header('Content-Type: application/json');
    echo json_encode($row);
}