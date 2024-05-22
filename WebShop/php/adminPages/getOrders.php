<?php

include './getAdminMysqli.php';
include '../getArr.php';

$mysqli = getAdminMysqli();
$orders = getArr($_GET['query'], $mysqli);
error_log("Orders: " . print_r($orders, true));
$json = json_encode($orders);
echo $json;