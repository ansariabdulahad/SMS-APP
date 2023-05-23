<?php

require_once("../../common_files/php/database.php");

$table = $_POST['table'];
$category = $_POST['category'];

$get_data = "SELECT name FROM $table WHERE category = '$category'";
$reponse = $db->query($get_data);

$all_data = [];

if ($reponse) {

    if ($reponse->num_rows != 0) {

        while ($data = $reponse->fetch_assoc()) {

            array_push($all_data, $data);
        }

        echo json_encode($all_data);
    } else {

        echo "There Is No Data";
    }

} else {

    echo "There Is No Data";
}

?>