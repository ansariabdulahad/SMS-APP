<?php

require_once("../../common_files/php/database.php");

$enrollment = $_POST['enrollment'];
$photo = $_FILES['photo'];
$signature = $_FILES['signature'];
$id_proof = $_FILES['id-proof'];

$photo_location = $photo['tmp_name'];
$signature_location = $signature['tmp_name'];
$proof_location = $id_proof['tmp_name'];

// Prepare URL to upload in database

$photo_url = "photos/stu_" . $enrollment . ".png";
$signature_url = "signatures/stu_" . $enrollment . ".png";
$proof_url = "documents/stu_" . $enrollment . ".pdf";

$update_students = "UPDATE students SET photo = '$photo_url', signature = '$signature_url',
id_proof = '$proof_url' WHERE enrollment = '$enrollment'";

if ($db->query($update_students)) {

    echo "success";

    move_uploaded_file($photo_location, "../" . $photo_url);
    move_uploaded_file($signature_location, "../" . $signature_url);
    move_uploaded_file($proof_location, "../" . $proof_url);

} else {

    echo "Unable To Upload Data";
}

?>