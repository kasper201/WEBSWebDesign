<?php
$name = $_POST['name'];
$parent = $_POST['parent'];

// get ID for saving the image
include './getAdminMysqli.php';
include '../getArr.php';

$mysqli = getAdminMysqli();

// get the max ID and add 1 to it to get the next ID
$result = getArr('SELECT MAX(ID) FROM Category', $mysqli);
$maxId = $result[0];
$id = $maxId['MAX(ID)'] + 1;

if($parent != "null")
{
$stmt = mysqli_prepare($mysqli, 'INSERT INTO Category (ID, name, categoryID) VALUES (?, ?, ?)');
}
else {
    $stmt = mysqli_prepare($mysqli, 'INSERT INTO Category (ID, name, categoryID) VALUES (?, ?, NULL)');
}
if ($stmt === false) {
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

if($parent != "null") {
    $bind = mysqli_stmt_bind_param($stmt, 'dsd', $id, $name, $parent);
}
else {
    $bind = mysqli_stmt_bind_param($stmt, 'ds', $id, $name);
}
if ($bind === false) {
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// Execute the prepared statement
$exec = mysqli_stmt_execute($stmt);
if ($exec === false) {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

if($stmt->error) {
    error_log("SQL error: " . $stmt->error); // Log the error
    http_response_code(500); // Send a 500 status code
    echo "SQL error: " . $stmt->error;
    exit;
}

header('Location: ../adminPages/Categories.php');