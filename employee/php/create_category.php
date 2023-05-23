<?php

require_once("../../common_files/php/database.php");

$category = json_decode($_POST['category']);
$details = json_decode($_POST['details']);

$message = '';

// length of the category field 
$length = count($category);

// get all categories
$get_category = "SELECT * FROM category";
$reponse = $db->query($get_category);

if ($reponse) {

    // insert into category table 
    for ($i = 0; $i < $length; $i++) {

        $store_data = "INSERT INTO category (category_name, details) 
        VALUES('$category[$i]', '$details[$i]')";

        if ($db->query($store_data)) {
            $message = "success";
        } else {
            $message = $i . " category details insert failed";
        }
    }

    echo $message;

} else {

    // create category table
    $create_table = "CREATE TABLE category (
        id INT NOT NULL AUTO_INCREMENT,
        category_name VARCHAR(50) NOT NULL,
        details VARCHAR(100),
        PRIMARY KEY(id)
    )";

    $reponse = $db->query($create_table);

    if ($reponse) {

        // insert into category table 
        for ($i = 0; $i < $length; $i++) {

            $store_data = "INSERT INTO category (category_name, details) 
            VALUES('$category[$i]', '$details[$i]')";

            if ($db->query($store_data)) {
                $message = "success";
            } else {
                $message = $i . " category details insert failed";
            }
        }

        echo $message;

    } else {
        echo " Error creating table: " . $reponse;
    }
}

?>