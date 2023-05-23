<?php

require_once("../../common_files/php/database.php");

$category = $_POST['course-category'];
$code = $_POST['course-code'];
$course_name = $_POST['course-name'];
$detail = $_POST['course-detail'];
$duration = $_POST['course-duration'];
$course_time = $_POST['course-time'];
$fee = $_POST['course-fee'];
$course_fee_time = $_POST['course-fee-time'];
$file = $_FILES['course-logo'];
$added_by = $_POST['course-added-by'];
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
    $logo = "course/" . $name;
}

$get_data = "SELECT * FROM course";
$reponse = $db->query($get_data);

if ($reponse) {

    $insert_data = "INSERT INTO course (
        category, code, name, detail, duration, course_time, fee, course_fee_time, logo, added_by, status)VALUES (
            '$category', '$code', '$course_name', '$detail', '$duration', '$course_time', '$fee',
            '$course_fee_time', '$logo', '$added_by', '$status'
        )";

    if ($db->query($insert_data)) {

        echo 'success';
        move_uploaded_file($location, "../course/" . $name);
    } else {

        echo "Unable to store data";
    }
} else {

    $create_table = "CREATE TABLE course(
        id INT(11) NOT NULL AUTO_INCREMENT,
        category VARCHAR(255),
        code VARCHAR(255),
        name VARCHAR(255),
        detail VARCHAR(255),
        duration VARCHAR(255),
        course_time VARCHAR(255),
        fee VARCHAR(255),
        course_fee_time VARCHAR(255),
        logo VARCHAR(255),
        added_by VARCHAR(255),
        added_date datetime DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(255),
        PRIMARY KEY (id)
    )";

    if ($db->query($create_table)) {

        $insert_data = "INSERT INTO course (
            category, code, name, detail, duration, course_time, fee, course_fee_time, logo, added_by, status)VALUES (
                '$category', '$code', '$course_name', '$detail', '$duration', '$course_time', '$fee',
                '$course_fee_time', '$logo', '$added_by', '$status'
            )";

        if ($db->query($insert_data)) {

            echo 'success';
            move_uploaded_file($location, "../course/" . $name);
        } else {

            echo "Unable to store data";
        }

    } else {

        echo "Unable to create table";
    }
}

?>