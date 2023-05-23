<?php

require_once("../../common_files/php/database.php");

$username = $_POST['username'];
$password = $_POST['password'];

$get_user = "SELECT * FROM access";
$response = $db->query($get_user);

if ($response) {

    $insert_data = "INSERT INTO access (email, password) VALUES('$username', '$password')";

    if ($db->query($insert_data)) {

        echo "success";
    } else {

        echo "Unable To Insert Data !";
    }

} else {

    $create_table = "CREATE TABLE access (
        id INT(11) NOT NULL AUTO_INCREMENT,
        email VARCHAR(255),
        password VARCHAR(255),
        PRIMARY KEY (id)
    )";

    if ($db->query($create_table)) {

        $insert_data = "INSERT INTO access (email, password) VALUES('$username', '$password')";

        if ($db->query($insert_data)) {

            echo "success";
        } else {

            echo "Unable To Insert Data !";
        }

    } else {

        echo "Unable To Create Table !";
    }
}

?>