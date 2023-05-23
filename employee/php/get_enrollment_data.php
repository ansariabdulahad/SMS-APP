<?php

require_once("../../common_files/php/database.php");

$table = $_POST['table'];
$data = $_POST['user_data'];

$get_data = "SELECT * FROM $table WHERE enrollment = '$data'";
$reponse = $db->query($get_data);

if ($reponse) {

    if ($reponse->num_rows != 0) {

        $data = $reponse->fetch_assoc();
        echo json_encode($data);

    } else {

        echo "not match";
    }
} else {

    echo "not match";
}

?>