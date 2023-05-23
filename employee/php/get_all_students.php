<?php

require_once("../../common_files/php/database.php");

$table = $_POST['table'];
$category = $_POST['category'];
$batch = $_POST['batch'];

$get_students = "SELECT * FROM $table WHERE category = '$category' AND batch = '$batch'";
$reponse = $db->query($get_students);

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