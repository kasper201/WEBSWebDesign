<?php
// Start the session
session_start();

include 'getMysqli.php';

$mysqli = getMysqli();
// Check if $mysqli is set and if it's a valid mysqli object
if (isset($mysqli) && $mysqli instanceof mysqli) {
    // Kill the current connection
    $mysqli->kill($mysqli->thread_id);
    // Close the current connection
    $mysqli->close();
    // Unset the $mysqli object
    unset($mysqli);
}

// Retrieve the username and password from the POST request
$username = $_POST['username'];
$password = $_POST['password'];

$host = "localhost";
$port = 3306;
$database = "test";

// Store the database credentials in the session
$_SESSION['db_host'] = $host;
$_SESSION['db_port'] = $port;
$_SESSION['db_username'] = $username;
$_SESSION['db_password'] = $password;
$_SESSION['db_database'] = $database;

try {
    // Create a new database connection
    $mysqli = new mysqli($host, $username, $password, $database, $port);
    header('Location: ./adminPages/admin.php');
} catch (mysqli_sql_exception $e) { // Failed to connect to the database server
    http_response_code(500); // Send a 500 status code
    if($e->getCode() === 1045) {
        echo '<script>alert("Invalid username or password")</script>';
    } else {
        echo '<script>alert("Failed to connect to MySQL")</script>';
    }
    //echo '<script>alert("Failed to connect to MySQL")</script>';
    echo '<script>window.location.href = "./adminLoginPage.php";</script>';
    exit;
}