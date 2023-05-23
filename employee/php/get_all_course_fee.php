<?php

require_once("../../common_files/php/database.php");

$table = $_POST['table'];
$category = $_POST['category'];
$course = $_POST['course'];

$get_fee = "SELECT fee, course_fee_time FROM $table WHERE category = '$category' AND name = '$course'";
$reponse = $db->query($get_fee);

$all_data = [];

if ($reponse) {

    if ($reponse->num_rows != 0) {

        $data = $reponse->fetch_assoc();

        echo json_encode($data);
    } else {

        echo "There Is No Data";
    }

} else {

    echo "There Is No Data";
}

?>