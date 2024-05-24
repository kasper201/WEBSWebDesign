<?php
$loadPage = $_GET['LOAD'];
echo "<script>console.log('LOAD: $loadPage');</script>";
error_log("LOAD: $loadPage");
$id = 1;

if($loadPage == "true"){
    include './getArr.php';
    include './getMysqli.php';
    $mysqli = getMysqli();
    $sql = "CALL userInfo('$id')";
    $arr = getArr($sql, $mysqli);
    echo json_encode($arr);
    exit;
}

$email = $_GET['email'];
$name = $_GET['name'];
$country = $_GET['country'];
$street = $_GET['street'];
$postal = $_GET['GETal'];
$city = $_GET['city'];

echo json_encode($email);