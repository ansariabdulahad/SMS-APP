<?php

require_once("../../common_files/php/database.php");

$file = "";
$location = "";
$file_binary = "";

if ($_FILES['title-image']['name'] != "") {

    $file = $_FILES['title-image'];
    $location = $file['tmp_name'];
    $file_binary = addslashes(file_get_contents($location));
} else {

    $file = "";
    $location = "";
    $file_binary = "";
}

$json_data = json_encode($_POST['css_data']);
$tmp_data = json_decode($json_data, true);
$all_data = json_decode($tmp_data, true);

$option = $all_data['option'];

$title_text = addslashes($all_data['title_text']);
$title_size = addslashes($all_data['title_size']);
$title_color = addslashes($all_data['title_color']);

$subtitle_text = addslashes($all_data['subtitle_text']);
$subtitle_size = addslashes($all_data['subtitle_size']);
$subtitle_color = addslashes($all_data['subtitle_color']);

$v_align = addslashes($all_data['v_align']);
$h_align = addslashes($all_data['h_align']);

$buttons = addslashes($all_data['buttons']);

$check_table = "SELECT count(id) AS result FROM header_showcase";
$response = $db->query($check_table);

if ($response) {

    $data = $response->fetch_assoc();
    $count_rows = $data['result'];

    if ($count_rows < 3) {

        if ($option == "choose title") {

            $store_data = "INSERT INTO header_showcase(
                title_image, title_text, title_size, title_color, subtitle_text, subtitle_size, subtitle_color, h_align, v_align, buttons
            )VALUES(
                '$file_binary', '$title_text', '$title_size', '$title_color', '$subtitle_text', '$subtitle_size', '$subtitle_color',
                '$h_align', '$v_align', '$buttons'
            )";

            if ($db->query($store_data)) {

                echo "success";
            } else {

                echo "Unable to insert data";
            }

        } else {

            if ($file_binary != "") {

                $update_data = "UPDATE header_showcase SET title_image = '$file_binary', title_text = '$title_text', title_size = '$title_size', 
                title_color = '$title_color', subtitle_text = '$subtitle_text', subtitle_size = '$subtitle_size', 
                subtitle_color = '$subtitle_color', h_align = '$h_align', v_align = '$v_align', buttons = '$buttons' WHERE id = '$option'";

                if ($db->query($update_data)) {

                    echo "edit success";

                } else {

                    echo "Unable to update data";
                }

            } else {

                $update_data = "UPDATE header_showcase SET title_text = '$title_text', title_size = '$title_size', 
                title_color = '$title_color', subtitle_text = '$subtitle_text', subtitle_size = '$subtitle_size', 
                subtitle_color = '$subtitle_color', h_align = '$h_align', v_align = '$v_align', buttons = '$buttons' WHERE id = '$option'";

                if ($db->query($update_data)) {

                    echo "edit success";

                } else {

                    echo "Unable to update data";
                }

            }

        }

    } else if ($count_rows >= 3) {

        if ($option == "choose title") {

            echo "Limit Full !";
        } else {

            if ($file_binary != "") {

                $update_data = "UPDATE header_showcase SET title_image = '$file_binary', title_text = '$title_text', title_size = '$title_size', 
                title_color = '$title_color', subtitle_text = '$subtitle_text', subtitle_size = '$subtitle_size', 
                subtitle_color = '$subtitle_color', h_align = '$h_align', v_align = '$v_align', buttons = '$buttons' WHERE id = '$option'";

                if ($db->query($update_data)) {

                    echo "edit success";

                } else {

                    echo "Unable to update data";
                }

            } else {

                $update_data = "UPDATE header_showcase SET title_text = '$title_text', title_size = '$title_size', 
                title_color = '$title_color', subtitle_text = '$subtitle_text', subtitle_size = '$subtitle_size', 
                subtitle_color = '$subtitle_color', h_align = '$h_align', v_align = '$v_align', buttons = '$buttons' WHERE id = '$option'";

                if ($db->query($update_data)) {

                    echo "edit success";

                } else {

                    echo "Unable to update data";
                }

            }
        }
    }

} else {
    $create_table = "CREATE TABLE header_showcase(

        id INT(11) NOT NULL AUTO_INCREMENT,
        title_image MEDIUMBLOB,
        title_text VARCHAR(255),
        title_size VARCHAR(255),
        title_color VARCHAR(255),
        subtitle_text VARCHAR(255),
        subtitle_size VARCHAR(255),
        subtitle_color VARCHAR(255),
        h_align VARCHAR(255),
        v_align VARCHAR(255),
        buttons MEDIUMTEXT,
        PRIMARY KEY (id)

    )";

    if ($db->query($create_table)) {

        $store_data = "INSERT INTO header_showcase(
            title_image, title_text, title_size, title_color, subtitle_text, subtitle_size, subtitle_color, h_align, v_align, buttons
        )VALUES(
            '$file_binary', '$title_text', '$title_size', '$title_color', '$subtitle_text', '$subtitle_size', '$subtitle_color',
            '$h_align', '$v_align', '$buttons'
        )";

        if ($db->query($store_data)) {

            echo "success";
        } else {

            echo "Unable to insert data";
        }

    } else {

        echo "Unable to create table";
    }
}

?>