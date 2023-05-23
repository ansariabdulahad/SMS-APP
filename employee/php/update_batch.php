<?php

require_once("../../common_files/php/database.php");

$id = $_POST['id'];
$category = $_POST['batch-category'];
$course = $_POST['batch-course'];
$code = $_POST['batch-code'];
$batch_name = $_POST['batch-name'];
$detail = $_POST['batch-detail'];
$batch_from = $_POST['batch-from'];
$batch_to = $_POST['batch-to'];
$batch_from_date = $_POST['batch-from-date'];
$batch_to_date = $_POST['batch-to-date'];
$file = $_FILES['batch-logo'];
$added_by = $_POST['batch-added-by'];
$status = $_POST['status'];

$logo = '';
$name = '';
$location = '';

if ($file['name'] == '') {

    $logo = '';
    $name = '';
    $location = '';
} else {

    $name = $file['name'];
    $location = $file['tmp_name'];
    $logo = "batch/" . $name;
}

// update batch information coding
if ($file['name'] == '') {

    $update_batch = "UPDATE batch SET category = '$category', course = '$course', code = '$code', name = '$batch_name', 
    detail = '$detail', batch_from = '$batch_from', batch_to = '$batch_to', batch_from_date = '$batch_from_date', batch_to_date = '$batch_to_date',
    logo = '$logo', added_by = '$added_by', status = '$status' WHERE id = '$id'";

    if ($db->query($update_batch)) {

        echo "success";
    } else {

        echo "Unable To Update Data";
    }
} else {

    $update_batch = "UPDATE batch SET category = '$category', course = '$course', code = '$code', name = '$batch_name', 
    detail = '$detail', batch_from = '$batch_from', batch_to = '$batch_to', batch_from_date = '$batch_from_date', batch_to_date = '$batch_to_date',
    logo = '$logo', added_by = '$added_by', status = '$status' WHERE id = '$id'";

    if ($db->query($update_batch)) {

        echo "success";
        move_uploaded_file($location, "../batch/" . $name);
    } else {

        echo "Unable To Update Data";
    }
}

?>