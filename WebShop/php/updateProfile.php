<?php
$loadPage = $_GET['LOAD'];
//echo "<script>console.log('LOAD: $loadPage');</script>";
error_log("LOAD: $loadPage");
$id = 1;

if($loadPage == "true"){
    include './getMysqli.php';
    $mysqli = getMysqli();
    $sql = "CALL getProfile('$id')";

    $result = $mysqli->query($sql);
    error_log("Number of rows: " . $result->num_rows);
    if($result->num_rows == 0){
        $row = $result->fetch_assoc();
        echo json_encode($row);
        error_log("Row: " . print_r($row, true));
    }

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
            error_log("Row: " . print_r($row, true));
        }
    }

    echo json_encode($products);
    error_log("arr: " . print_r($products, true));
    exit;
} else {

    $email = $_POST['email'];
    $name = $_POST['name'];
    $country = $_POST['country'];
    $street = $_POST['street'];
    $postal = $_POST['postal'];
    $city = $_POST['city'];

    include './getArr.php';
    include './getMysqli.php';

    $mysqli = getMysqli();
    $arr = getArr("CALL updateAddress('$id', '$street', '$postal', '$city', '$country')", $mysqli);
    $arr = getArr("CALL updateProfile('$id', '$name', '$email')", $mysqli);
    echo json_encode($arr);
    error_log("arr: " . print_r($arr, true));
    exit;
}