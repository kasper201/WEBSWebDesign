<?php
include 'OverviewPages.php';
$category = $_GET['category'];
$onlySale = $_GET['onSale'];
$basket = $_GET['productNr'];
$query = $_GET['query'];

error_log("Received query: " . $query);
error_log("Category: " . $category);
error_log("OnlySale: " . $onlySale);

if($onlySale != "null") {
    if ($category == "null") { // if no category is selected
        overviewPages("select * from Product where OnSale = 1");
    } else { // if a category is selected also look for the category
        overviewPages("select * from Product JOIN ProductCategory ON Product.ID = ProductCategory.ProductID where OnSale = 1 AND ProductCategory.CategoryID = $category");
    }
} elseif ($basket != "null") {
    overviewPages("SELECT * FROM Product WHERE ID IN ($basket)");
} elseif ($query != "null") {
    overviewPages("$query");
} else {
    if ($category == "null") { // this makes it possible to decide on which category to show (not implemented)
        overviewPages("select * from Product");
    } else {
        overviewPages("select * from Product JOIN ProductCategory ON Product.ID = ProductCategory.ProductID where ProductCategory.CategoryID = $category");
    }
}