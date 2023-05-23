<?php

require_once("../../common_files/php/database.php");

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

$get_data = "SELECT * FROM batch";
$reponse = $db->query($get_data);

if ($reponse) {

    $insert_data = "INSERT INTO batch (
        category, course, code, name, detail, batch_from, batch_to, batch_from_date, batch_to_date, logo, added_by, status)VALUES 
        (
            '$category', '$course', '$code', '$batch_name', '$detail', '$batch_from', '$batch_to', '$batch_from_date',
            '$batch_to_date', '$logo', '$added_by', '$status'
        )";

    if ($db->query($insert_data)) {

        echo 'success';
        move_uploaded_file($location, "../batch/" . $name);
    } else {

        echo "Unable to store data";
    }
} else {

    $create_table = "CREATE TABLE batch(
        id INT(11) NOT NULL AUTO_INCREMENT,
        category VARCHAR(255),
        course VARCHAR(255),
        code VARCHAR(255),
        name VARCHAR(255),
        detail VARCHAR(255),
        batch_from VARCHAR(255),
        batch_to VARCHAR(255),
        batch_from_date VARCHAR(255),
        batch_to_date VARCHAR(255),
        logo VARCHAR(255),
        added_by VARCHAR(255),
        added_date datetime DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(255),
        PRIMARY KEY (id)
    )";

    if ($db->query($create_table)) {

        $insert_data = "INSERT INTO batch (
            category, course, code, name, detail, batch_from, batch_to, batch_from_date, batch_to_date, logo, added_by, status)VALUES 
            (
                '$category', '$course', '$code', '$batch_name', '$detail', '$batch_from', '$batch_to', '$batch_from_date',
                '$batch_to_date', '$logo', '$added_by', '$status'
            )";

        if ($db->query($insert_data)) {

            echo 'success';
            move_uploaded_file($location, "../batch/" . $name);
        } else {

            echo "Unable to store data";
        }

    } else {

        echo "Unable to create table";
    }
}

?>