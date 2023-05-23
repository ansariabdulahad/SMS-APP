<?php

require_once("../common_files/php/database.php");

$enrollment = $_SESSION['enrollment'];
$name = $_SESSION['name'];
$category = $_SESSION['category'];
$course = $_SESSION['course'];
$batch = $_SESSION['batch'];
$paid_fee = $_SESSION['total'];
$pending = $_SESSION['pending'];
$fee_time = $_SESSION['fee-time'];
$invoice_recent = $_SESSION['recent'];
$date = $_SESSION['date'];

$get_data = "SELECT * FROM invoice";
$response = $db->query($get_data);

if ($response) {

    $insert_data = "INSERT INTO invoice(
        enrollment, name, category, course, batch, paid_fee, pending, fee_time, recent_paid, date
    )
    VALUES(
        '$enrollment', '$name', '$category', '$course', '$batch', '$paid_fee', '$pending', '$fee_time', '$invoice_recent', '$date'
    )";

    if ($db->query($insert_data)) {

        $update_student = "UPDATE students SET paid_fee = '$paid_fee' WHERE enrollment = '$enrollment'";
        $db->query($update_student);

        header("Location:http://localhost/sms-APP/student/index.php");

    } else {

        echo "Unable To Insert Data";
    }

} else {

    $create_table = "CREATE TABLE invoice(
        id INT(11) NOT NULL AUTO_INCREMENT,
        enrollment VARCHAR(255),
        name VARCHAR(255),
        category VARCHAR(255),
        course VARCHAR(255),
        batch VARCHAR(255),
        paid_fee VARCHAR(255),
        pending VARCHAR(255),
        fee_time VARCHAR(255),
        recent_paid VARCHAR(255),
        date VARCHAR(255),
        PRIMARY KEY (id)
    )";

    if ($db->query($create_table)) {

        $insert_data = "INSERT INTO invoice(
            enrollment, name, category, course, batch, paid_fee, pending, fee_time, recent_paid, date
        )
        VALUES(
            '$enrollment', '$name', '$category', '$course', '$batch', '$paid_fee', '$pending', '$fee_time', '$invoice_recent', '$date'
        )";

        if ($db->query($insert_data)) {

            $update_student = "UPDATE students SET paid_fee = '$paid_fee' WHERE enrollment = '$enrollment'";
            $db->query($update_student);

            echo "success";

        } else {

            echo "Unable To Insert Data";
        }

    } else {

        echo "Unable to create table";
    }
}

?>