<?php

session_start();
require_once("../common_files/php/database.php");

$username = $_SESSION['username'];

// CHECK USERNAME
if (empty($username)) {

    header("Location:../");
    exit;
}

// GET DATA RELATED TO USERNAME
$get_student = "SELECT * FROM students WHERE email = '$username'";
$stu_res = $db->query($get_student);

if ($stu_res->num_rows !== 0) {

    $all_stu_info = $stu_res->fetch_assoc();
}

$_SESSION['mobile'] = $all_stu_info['mobile'];
$_SESSION['address'] = $all_stu_info['city'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Link -->
    <link rel="stylesheet" href="../employee/css/index.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="../common_files/css/bootstrap.min.css">
    <link rel="stylesheet" href="../common_files/css/animate.min.css">

    <!-- JS Link -->
    <script src="../common_files/js/bootstrap.bundle.min.js"></script>
    <script src="../common_files/js/jquery-3.6.3.js"></script>
    <script src="../common_files/js/fontawesome.js"></script>
    <script src="../common_files/js/sweetalert.min.js"></script>
    <title>Student Page</title>

    <style>
        input:disabled,
        textarea:disabled {
            background-color: rgb(161, 158, 158) !important;
        }
    </style>
</head>

<body>

    <!-- Start main container coding -->
    <div class="container-fluid p-0 overflow-hidden">

        <!-- Side Navbar Coding -->
        <div class="side-nav side-nav-open">

            <!-- SIDE NAV PROFILE SECTION CODING -->
            <div class="shadow-lg border stu-profile"
                style="background-image:url(../employee/<?php echo $all_stu_info['photo']; ?>)">

            </div>

            <!-- side nav first button Institute update btn coding -->
            <button class="btn w-100 mt-2 nav-link institute-update-btn">
                <i class="fa-solid fa-chart-line"></i>&nbsp;
                <?php echo $all_stu_info['name']; ?>
                <i class="fa fa-angle-down mx-1 my-2"></i>
            </button>

            <!-- intitude menu -->
            <ul class="show list-group-flush collapse institute-update-menu">

                <li class="list-group-item py-2 border-start p-2 collapse-item active"
                    access-link="dynamic_pages/dashboard_design.php">Dashboard</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/invoice_design.php">Payment Mode</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/brand_design.php">Invoice List</li>

            </ul>

        </div>

        <!-- Main Page Content Coding -->
        <div class="page page-open">

        </div>

    </div>

    <!-- JS FILE LINK -->
    <script src="./js/index.js"></script>

</body>

</html>