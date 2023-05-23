<?php

require("../common_files/php/database.php");
session_start();

$username = $_SESSION['username'];

if (empty($username)) {

    header("Location:../");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Link -->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="../common_files/css/bootstrap.min.css">
    <link rel="stylesheet" href="../common_files/css/animate.min.css">

    <!-- JS Link -->
    <script src="../common_files/js/bootstrap.bundle.min.js"></script>
    <script src="../common_files/js/jquery-3.6.3.js"></script>
    <script src="../common_files/js/fontawesome.js"></script>
    <script src="../common_files/js/sweetalert.min.js"></script>
    <title>Employee Page</title>

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

            <!-- side nav first button Homepage update btn coding -->
            <button class="btn w-100 mt-2 nav-link homepage-update-btn">
                <i class="fas fa-home"></i>&nbsp;
                Homepage Design
                <i class="fa fa-angle-down mx-2 my-2 float-end"></i>
            </button>

            <!-- homepage menu -->
            <ul class="list-group-flush collapse homepage-menu">

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/showcase_design.php">Header Showcase</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item" access-link="dynamic_pages/#">Create
                    Showcase</li>

            </ul>

            <!-- side nav second button Institute update btn coding -->
            <button class="btn w-100 mt-2 nav-link institute-update-btn">
                <i class="fa-solid fa-chart-line"></i>&nbsp;
                Institute Update
                <i class="fa fa-angle-down mx-3 my-2"></i>
            </button>

            <!-- intitude menu -->
            <ul class="list-group-flush collapse institute-update-menu">

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/brand_design.php">Create Brand</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/category_design.php">Create Category</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/course_design.php">Create Course</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/batch_design.php">Create Batch</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/student_design.php">Student Registration</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/document_design.php">Upload Student Document</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/invoice_design.php">Create Invoice</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item"
                    access-link="dynamic_pages/attendance_design.php">Create Attendance</li>

                <li class="list-group-item py-2 border-start p-2 collapse-item active"
                    access-link="dynamic_pages/access_design.php">Give Access-Link</li>

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