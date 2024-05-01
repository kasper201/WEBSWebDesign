<?php
include 'OverviewPages.php';
// TODO: Implement the function overviewPages
$category = $_GET['category'];
$onlySale = $_GET['onSale'];
$basket = $_GET['productNr'];

//SELECT *
//FROM Product
//JOIN ProductCategory ON Product.ID = ProductCategory.ProductID
//WHERE ProductCategory.CategoryID = 0;

if($onlySale) {
    if ($category == "null") { // if no category is selected
        overviewPages("select * from Product where OnSale = 1");
    } else { // if a category is selected also look for the category
        overviewPages("select * from Product JOIN ProductCategory ON Product.ID = ProductCategory.ProductID where OnSale = 1 AND ProductCategory.CategoryID = $category");
    }
} elseif ($basket != "null") {
    overviewPages("SELECT * FROM Product WHERE ID IN ($basket)");
} else {
    if ($category == "null") {
        overviewPages("select * from Product");
    } else {
        overviewPages("select * from Product JOIN ProductCategory ON Product.ID = ProductCategory.ProductID where ProductCategory.CategoryID = $category");
    }
}

error_log("Category: " . $category);
error_log("OnlySale: " . $onlySale);