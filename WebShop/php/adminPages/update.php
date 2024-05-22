<?php
include './getAdminMysqli.php';
include '../getArr.php';

// Get the form data
$column = $_POST['column'];
$id = $_POST['id'];
$newValue = $_POST['newValue'];

if($column == "state")
{
    $query = "UPDATE `Order` SET state = '$newValue' WHERE ID = $id";
} else {
    exit;
}

error_log("Column: " . $column);
$mysqli = getAdminMysqli();
$response = getArr($query, $mysqli);
error_log("Response: " . print_r($response, true));