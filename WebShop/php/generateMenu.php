<?php

include 'getArr.php';

function generateMenu($categoryID, $mysqli) {
    $categories = getArr("SELECT * FROM Category WHERE parent_id " . ($categoryID ? "= " . $categoryID : "IS NULL"), $mysqli);

    if (count($categories) > 0) {
        echo '<ul class="menu' . ($categoryID ? ' sub-menu' : '') . '">';

        foreach ($categories as $category) {
            echo '<li class="menu-item"><a href="./Products.php?category=' . $category['ID'] . '">' . $category['Name'] . '</a>';

            // Check if the category has subcategories
            $subCategories = getArr("SELECT * FROM Category WHERE parent_id = " . $category['ID'], $mysqli);
            if (count($subCategories) > 0) {
                generateMenu($category['ID'], $mysqli);
            }

            echo '</li>';
        }

        echo '</ul>';
    }
}

$mysqli = getMysqli();
generateMenu(null, $mysqli);