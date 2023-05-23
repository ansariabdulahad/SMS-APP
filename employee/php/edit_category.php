<?php

require_once("../../common_files/php/database.php");

$id = $_POST['id'];
$category = $_POST['category'];
$details = $_POST['details'];

$update_data = "UPDATE category SET category_name = '$category', details = '$details' WHERE id = '$id'";

if ($db->query($update_data)) {

    echo "success";
} else {

    echo "Enable to update data";
}

?>