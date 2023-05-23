<?php

require_once("../../common_files/php/database.php");

$name = json_decode($_POST['name']);
$enrollment = json_decode($_POST['enrollment']);
$batch = json_decode($_POST['batch']);
$attendance = json_decode($_POST['attendance']);

$length = count($enrollment);
$message = "";

$get_att = "SELECT * FROM attendances";
$response = $db->query($get_att);

if ($response) {

    for ($i = 0; $i < $length; $i++) {

        $insert_data = "INSERT INTO attendances(name, enrollment, batch, attendance) 
        VALUES('$name[$i]', '$enrollment[$i]', '$batch[$i]', '$attendance[$i]')";

        if ($db->query($insert_data)) {

            $message = "success";

        } else {

            $message = "Unable to insert data !";
        }
    }

    echo $message;

} else {

    $create_table = "CREATE TABLE attendances(
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255),
        enrollment INT(50),
        batch VARCHAR(255),
        attendance VARCHAR(255),
        PRIMARY KEY (id)
    )";

    if ($db->query($create_table)) {

        for ($i = 0; $i < $length; $i++) {

            $insert_data = "INSERT INTO attendances(name, enrollment, batch, attendance) 
            VALUES('$name[$i]', '$enrollment[$i]', '$batch[$i]', '$attendance[$i]')";

            if ($db->query($insert_data)) {

                $message = "success";

            } else {

                $message = "Unable to insert data !";
            }
        }

        echo $message;

    } else {

        echo "Unable To Create Table";
    }

}

?>