<?php

require_once("../../common_files/php/database.php");

$id = $_POST['id'];
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

// update student information coding

$update_student = "UPDATE students SET category = '$category', course = '$course', batch = '$batch', enrollment = '$enrollment', 
    name = '$name', father_name = '$father', mother_name = '$mother', dob = '$dob', gender = '$gender', email = '$email',
    password = '$password', mobile = '$mobile', country = '$country', state = '$state', city = '$city', pincode = '$pincode',
    fee = '$fee', fee_time = '$fee_time', status = '$status', added_by = '$added_by' WHERE id = '$id'";

if ($db->query($update_student)) {

    echo "success";
} else {

    echo "Unable To Update Data";
}


?>