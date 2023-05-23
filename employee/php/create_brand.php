<?php

require_once("../../common_files/php/database.php");

$brand_name = $_POST['brand-name'];
$brand_logo = $_FILES['brand-logo'];
$brand_domain = $_POST['brand-domain'];
$brand_email = $_POST['brand-email'];
$brand_twitter = $_POST['brand-twitter'];
$brand_facebook = $_POST['brand-facebook'];
$brand_instagram = $_POST['brand-instagram'];
$brand_whatsapp = $_POST['brand-whatsapp'];
$brand_address = $_POST['brand-address'];
$brand_mobile_1 = $_POST['brand-mobile-1'];
$brand_mobile_2 = $_POST['brand-mobile-2'];
$brand_about = addslashes($_POST['brand-about']);
$brand_privacy = addslashes($_POST['brand-privacy']);
$brand_cookie = addslashes($_POST['brand-cookie']);
$brand_terms = addslashes($_POST['brand-terms']);

$logo = '';
$location = '';

if ($brand_logo['name'] == '') {

    $logo = '';
    $location = '';

} else {

    $location = $brand_logo['tmp_name'];
    $logo = addslashes(file_get_contents($location));
}

$get_data = "SELECT * FROM branding";
$reponse = $db->query($get_data);

if ($reponse) {

    if ($logo === "") {

        $update_data = "UPDATE branding SET brand_name = '$brand_name', brand_domain = '$brand_domain', brand_email = '$brand_email', 
        brand_twitter = '$brand_twitter', brand_facebook = '$brand_facebook', brand_instagram = '$brand_instagram', 
        brand_whatsapp = '$brand_whatsapp', brand_address = '$brand_address', brand_mobile_1 = '$brand_mobile_1', 
        brand_mobile_2 = '$brand_mobile_2', brand_about = '$brand_about', brand_privacy = '$brand_privacy', 
        brand_cookie = '$brand_cookie', brand_terms = '$brand_terms'";

        if ($db->query($update_data)) {

            echo "success";
        } else {

            echo "Unable To Update Data !";
        }

    } else {

        $update_data = "UPDATE branding SET brand_name = '$brand_name', brand_logo = '$logo', brand_domain = '$brand_domain', brand_email = '$brand_email', 
        brand_twitter = '$brand_twitter', brand_facebook = '$brand_facebook', brand_instagram = '$brand_instagram', 
        brand_whatsapp = '$brand_whatsapp', brand_address = '$brand_address', brand_mobile_1 = '$brand_mobile_1', 
        brand_mobile_2 = '$brand_mobile_2', brand_about = '$brand_about', brand_privacy = '$brand_privacy', 
        brand_cookie = '$brand_cookie', brand_terms = '$brand_terms'";

        if ($db->query($update_data)) {

            echo "success";
        } else {

            echo "Unable To Update Data !";
        }
    }

} else {

    $create_table = "CREATE TABLE branding(
        id INT(11) NOT NULL AUTO_INCREMENT,
        brand_name VARCHAR(255),
        brand_logo MEDIUMBLOB,
        brand_domain VARCHAR(255),
        brand_email VARCHAR(255),
        brand_twitter VARCHAR(255),
        brand_facebook VARCHAR(255),
        brand_instagram VARCHAR(255),
        brand_whatsapp VARCHAR(255),
        brand_address VARCHAR(255),
        brand_mobile_1 VARCHAR(20),
        brand_mobile_2 VARCHAR(20),
        brand_about MEDIUMTEXT,
        brand_privacy MEDIUMTEXT,
        brand_cookie MEDIUMTEXT,
        brand_terms MEDIUMTEXT,
        PRIMARY KEY (id)
    )";

    if ($db->query($create_table)) {

        $insert_data = "INSERT INTO branding (
            brand_name, brand_logo, brand_domain, brand_email, brand_twitter, brand_facebook, brand_instagram, brand_whatsapp,
            brand_address, brand_mobile_1, brand_mobile_2, brand_about, brand_privacy, brand_cookie, brand_terms
            )
            VALUES 
            (
                '$brand_name', '$logo', '$brand_domain', '$brand_email', '$brand_twitter', '$brand_facebook', '$brand_instagram',
                '$brand_whatsapp', '$brand_address', '$brand_mobile_1', '$brand_mobile_2', '$brand_about', '$brand_privacy',
                '$brand_cookie', '$brand_terms'
            )";

        if ($db->query($insert_data)) {

            echo 'success';

        } else {

            echo "Unable to insert data";
        }

    } else {

        echo "Unable to create table";
    }
}

?>