<?php

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category = $_POST['category'];
$onSale = isset($_POST['onSale']) ? 1 : 0;

if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
    // Handle the error, e.g., set a default image or show an error message
    die("Image is not set or there was an error uploading the file.");
}

$image = $_FILES['image']['tmp_name'];

// Get the image details
$imageDetails = getimagesize($image);

// Load the image
if ($imageDetails[2] == IMAGETYPE_JPEG) {
    $originalImage = imagecreatefromjpeg($image);
} elseif ($imageDetails[2] == IMAGETYPE_PNG) {
    $originalImage = imagecreatefrompng($image);
} else {
    die("The image is not a JPEG or PNG.");
}

// Get original image dimensions
$originalWidth = imagesx($originalImage);
$originalHeight = imagesy($originalImage);

// Define the thumbnail dimensions
$thumbnailWidth = 200;
$thumbnailHeight = 200;

// Create a new true color image
$thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbnailHeight);

// Copy and resize the original image to the new image
imagecopyresampled($thumbnail, $originalImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $originalWidth, $originalHeight);

// Save the thumbnail as a JPEG when debugging
imagejpeg($thumbnail, "tmp.jpg");

// now save everything to the database
include '../getMysqli.php';
include '../getArr.php';

$mysqli = getMysqli();

$result = getArr('SELECT MAX(ID) FROM Product', $mysqli);
$maxId = $result[0];
$id = $maxId['MAX(ID)'] + 1;

// add the product to the database
$stmt = mysqli_prepare($mysqli, "INSERT INTO Product (ID, Name, Price, Description, OnSale, image, thumbnail) VALUES (?, ?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

// Bind the variables to the prepared statement
$bind = mysqli_stmt_bind_param($stmt, 'sdsbss', $ID,$name, $price, $description, $OnSale, $image, $thumbnail);
if ($bind === false) {
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// Execute the prepared statement
$exec = mysqli_stmt_execute($stmt);
if ($exec === false) {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

// Close the statement
mysqli_stmt_close($stmt);