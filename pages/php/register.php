<?php

require_once("../../common_files/php/database.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$description = $_POST['description'];

$check_table = "SELECT * FROM register";
$response = $db->query($check_table);

if ($response) {

    $insert_data = "INSERT INTO register (name, mobile, email, description)VALUES (
        '$name', '$mobile', '$email', '$description'
    )";

    if ($db->query($insert_data)) {

        require("sendsms.php");

    } else {

        echo "Unable to insert data";
    }

} else {

    $create_table = "CREATE TABLE register (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255),
        mobile VARCHAR(20),
        email VARCHAR(255),
        description VARCHAR(255),
        status VARCHAR(255) DEFAULT 'pending',
        reg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    )";

    if ($db->query($create_table)) {

        $insert_data = "INSERT INTO register (name, mobile, email, description)VALUES (
            '$name', '$mobile', '$email', '$description'
        )";

        if ($db->query($insert_data)) {

            require("sendsms.php");

        } else {

            echo "Unable to insert data";
        }

    } else {

        echo "Unable to create table";
    }
}

?>