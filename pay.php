<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

$brand_name = $_SESSION['brand-name'];
$mobile = $_SESSION['mobile'];
$address = $_SESSION['address'];
$email = $_SESSION['username'];
$enrollment = $_GET['enrollment'];
$name = $_GET['name'];
$category = $_GET['category'];
$course = $_GET['course'];
$batch = $_GET['batch'];
$recent = $_GET['recent'];
$total = $_GET['total'];
$pending = $_GET['pending'];
$date = $_GET['date'];
$fee_time = $_GET['fee_time'];

$_SESSION['enrollment'] = $enrollment;
$_SESSION['name'] = $name;
$_SESSION['recent'] = $recent;
$_SESSION['pending'] = $pending;
$_SESSION['category'] = $category;
$_SESSION['course'] = $course;
$_SESSION['batch'] = $batch;
$_SESSION['date'] = $date;
$_SESSION['total'] = $total;
$_SESSION['fee_time'] = $fee_time;

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt' => 'rcptid_11',
    'amount' => $recent * 100,
    // 2000 rupees in paise
    'currency' => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)) {
    $checkout = $_GET['checkout'];
}

$data = [
    "key" => $keyId,
    "amount" => $amount,
    "name" => $brand_name,
    "description" => $brand_name,
    "image" => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill" => [
        "name" => $name,
        "email" => $email,
        "contact" => $mobile,
    ],
    "notes" => [
        "address" => $address,
        "merchant_order_id" => "12312321",
    ],
    "theme" => [
        "color" => "#F37254"
    ],
    "order_id" => $razorpayOrderId,
];

if ($displayCurrency !== 'INR') {
    $data['display_currency'] = $displayCurrency;
    $data['display_amount'] = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");