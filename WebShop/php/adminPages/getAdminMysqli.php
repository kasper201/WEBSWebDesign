<?php
/**
 * @return mysqli|void
 */
function getAdminMysqli()
{
    session_start(); // Start the session

    $host = "localhost";
    $port = 3306;
    $database = "WEBDesign";
    $_SESSION['db_host'] = $host;
    $_SESSION['db_port'] = $port;
    $_SESSION['db_database'] = $database;

// Retrieve the database credentials from the session
    $host = $_SESSION['db_host'];
    $port = $_SESSION['db_port'];
    $username = $_SESSION['db_username'];
    $password = $_SESSION['db_password'];
    $database = $_SESSION['db_database'];

    error_log("username: " . $username);

// Create a new database connection
    $mysqli = new mysqli($host, $username, $password, $database, $port);

// Check if the connection was successful
    if ($mysqli->connect_error) {
        http_response_code(500); // Send a 500 status code
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit;
    }
    return $mysqli;
}