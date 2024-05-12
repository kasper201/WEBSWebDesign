<?php

include 'getArr.php';

class MenuGenerator {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    private function getCategories() {
        $sql = "SELECT * FROM Category";
        $arr = getArr($sql, $this->mysqli);
        return $arr;
    }

    private function getCategory($ID) {
        $sql = "SELECT * FROM Category WHERE CategoryID " . ($ID ? "= " . $ID : "IS NULL OR CategoryID = 0");
        $arr = getArr($sql, $this->mysqli);
        return $arr;
    }

    private function getParent($ID) {
        $sql = "SELECT * FROM Category WHERE ID = $ID";
        $arr = getArr($sql, $this->mysqli);
        return $arr[0]["CategoryID"];
    }

    public function generateMenu() {
        // Get and display categories with CategoryID of NULL
        $parentCategories = $this->getCategory(NULL);
        foreach ($parentCategories as $category) {
            if($category['CategoryID'] !== NULL) {
                continue;
            }
            echo "<a href='./Products.php?category=" . $category['ID'] . "'>" . $category['Name'] . "</a>";
            echo "<div class='submenu'>";
            // Get and display the rest of the categories
            $allIDs = $this->getCategories();
            $addedSubmenus = array(); // Array to keep track of added submenus
            foreach ($allIDs as $subCategory) {
                if ($subCategory['CategoryID'] === $category["ID"] && !isset($addedSubmenus[$category['ID']])) {
                    echo "<a href='./Products.php?category=" . $subCategory['ID'] . "'>" . $subCategory['Name'] . "</a>";
                    $addedSubmenus[$subCategory['ID']] = true; // Mark submenu as added
                }
            }
            echo "</div>";
        }
    }
}