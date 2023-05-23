<?php

require_once("../../common_files/php/database.php");

$table = $_POST['table'];
$column = $_POST['column'];
$data = $_POST['user_data'];

$get_data = "SELECT $column FROM $table WHERE $column = '$data'";
$reponse = $db->query($get_data);

if ($reponse) {

    if ($reponse->num_rows == 0) {

        echo "not match";

    } else {

        echo "Already Exists !";
    }
} else {

    echo "not match";
}

?>