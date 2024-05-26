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
    // Preserve transparency
    imagealphablending($originalImage, false);
    imagesavealpha($originalImage, true);
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

// Preserve transparency
imagealphablending($thumbnail, false);
imagesavealpha($thumbnail, true);

// Copy and resize the original image to the new image
imagecopyresampled($thumbnail, $originalImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $originalWidth, $originalHeight);

// get ID for saving the image
include './getAdminMysqli.php';
include '../getArr.php';

$mysqli = getAdminMysqli();

$result = getArr('SELECT MAX(ID) FROM Product', $mysqli);
$maxId = $result[0];
$id = $maxId['MAX(ID)'] + 1;

// Save the thumbnail to a temporary file
$name = str_replace(' ', '_', $name);
$tempFile = '../Images/tmpDB/' . "$name" . '_thumbnail' . '.png';
$imageDir = '../Images/tmpDB/Products/' . "$name.png";
imagepng($thumbnail, ('./../' . $tempFile));
imagepng($originalImage, ('./../' . $imageDir));

// add the product to the database
$stmt = mysqli_prepare($mysqli, "INSERT INTO Product (ID, Name, Price, Description, OnSale, image, thumbnail) VALUES (?, ?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$bind = mysqli_stmt_bind_param($stmt, 'dsssdss', $id, $name, $price, $description, $onSale, $imageDir, $tempFile);
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// save the category to the database

foreach ($_POST['category'] as $categoryId) { // Loop through each category and add it to the database
    getArr("INSERT INTO ProductCategory (ProductID, CategoryID) VALUES ($id, $categoryId)", $mysqli);
}

header('Location: ../adminPages/Products.php');