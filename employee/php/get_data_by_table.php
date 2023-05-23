<?php

require_once("../../common_files/php/database.php");

$table = $_POST['table'];
$all_category = [];

$get_category = "SELECT * FROM $table";
$reponse = $db->query($get_category);

if ($reponse->num_rows != 0) {

    while ($data = $reponse->fetch_assoc()) {

        array_push($all_category, $data);
    }

    echo json_encode($all_category);

} else {

    echo "There are no categories";
}

?>