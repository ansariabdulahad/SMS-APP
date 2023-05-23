<?php

require_once("../../common_files/php/database.php");

$category = $_POST['stu-category'];
$course = $_POST['stu-course'];
$batch = $_POST['stu-batch'];
$enrollment = $_POST['enrollment'];
$name = $_POST['name'];
$father = $_POST['father'];
$mother = $_POST['mother'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$mobile = $_POST['mobile'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$fee = $_POST['fee'];
$fee_time = $_POST['fee-time'];
$status = $_POST['status'];
$added_by = $_POST['added-by'];

$get_data = "SELECT * FROM students";
$reponse = $db->query($get_data);

if ($reponse) {

    $insert_data = "INSERT INTO students (
        category, course, batch, enrollment, name, father_name, mother_name, dob, gender, email, password, mobile,
        country, state, city, pincode, fee, fee_time, status, added_by)VALUES 
        (
            '$category', '$course', '$batch', '$enrollment', '$name', '$father', '$mother', '$dob', '$gender', '$email', '$password', '$mobile',
            '$country', '$state', '$city', '$pincode', '$fee', '$fee_time', '$status', '$added_by'
        )";

    if ($db->query($insert_data)) {

        echo 'success';

    } else {

        echo "Unable to store data";
    }

} else {

    $create_table = "CREATE TABLE students(
        id INT(11) NOT NULL AUTO_INCREMENT,
        category VARCHAR(255),
        course VARCHAR(255),
        batch VARCHAR(255),
        enrollment VARCHAR(255),
        name VARCHAR(255),
        father_name VARCHAR(255),
        mother_name VARCHAR(255),
        dob VARCHAR(255),
        gender VARCHAR(255),
        email VARCHAR(255),
        password VARCHAR(255),
        mobile VARCHAR(255),
        country VARCHAR(255),
        state VARCHAR(255),
        city VARCHAR(255),
        pincode VARCHAR(255),
        fee VARCHAR(255),
        fee_time VARCHAR(255),
        paid_fee VARCHAR(20) DEFAULT 0,
        photo VARCHAR(255),
        signature VARCHAR(255),
        id_proof VARCHAR(255),
        status VARCHAR(255),
        added_by VARCHAR(255),
        added_date datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    )";

    if ($db->query($create_table)) {

        $insert_data = "INSERT INTO students (
            category, course, batch, enrollment, name, father_name, mother_name, dob, gender, email, password, mobile,
            country, state, city, pincode, fee, fee_time, status, added_by)VALUES 
            (
                '$category', '$course', '$batch', '$enrollment', '$name', '$father', '$mother', '$dob', '$gender', '$email', '$password', '$mobile',
                '$country', '$state', '$city', '$pincode', '$fee', '$fee_time', '$status', '$added_by'
            )";

        if ($db->query($insert_data)) {

            echo 'success';

        } else {

            echo "Unable to store data";
        }

    } else {

        echo "Unable to create table";
    }
}

?>