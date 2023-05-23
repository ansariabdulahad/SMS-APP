<?php
require('textlocal.class.php');

$textlocal = new Textlocal(false, false, 'API KEY');

$numbers = array("91" . $mobile);
$sender = '600010';
$message = 'This is a message';

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    print_r($result);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>