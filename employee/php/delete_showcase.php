<?php

require_once("../../common_files/php/database.php");

$id = $_POST['id'];

$delete_row = "DELETE FROM header_showcase WHERE id = '$id'";
$response = $db->query($delete_row);

if ($response) {

    echo "success";
} else {

    echo "Unable to delete title";
}

?>