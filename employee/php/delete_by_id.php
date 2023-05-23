<?php

require_once("../../common_files/php/database.php");

$table = $_POST['table'];
$id = $_POST['id'];

$delete_data = "DELETE FROM $table WHERE id = '$id'";

if ($db->query($delete_data)) {

    echo "success";
} else {

    echo "Unable to delete the data !";
}

?>