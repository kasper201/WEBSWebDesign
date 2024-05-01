<?php
include 'OverviewPages.php';
// TODO: Implement the function overviewPages
$category = $_GET['category'] - 1;
overviewPages("select * from Product where OnSale = 1");