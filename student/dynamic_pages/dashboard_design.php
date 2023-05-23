<?php

session_start();
require_once('../php/nav.php');
require_once("../../common_files/php/database.php");

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

// GET TOTAL ATTENDANCE RELATED TO ENROLLMENT
$enrollment = $all_stu_info['enrollment'];
$all_att = [];
$get_att = "SELECT * FROM attendances WHERE enrollment = '$enrollment'";
$att_res = $db->query($get_att);

if ($att_res) {

    while ($data = $att_res->fetch_assoc()) {

        array_push($all_att, $data);
    }
}

$att_length = count($all_att);

// GET TOTAL PRESENT RELATED TO ENROLLMENT
$all_prs = [];
$get_prs = "SELECT * FROM attendances WHERE enrollment = '$enrollment' AND attendance = 'present'";
$prs_res = $db->query($get_prs);

if ($prs_res) {

    while ($prs_data = $prs_res->fetch_assoc()) {

        array_push($all_prs, $prs_data);
    }
}

$prs_length = count($all_prs);
$percentage = $prs_length * 100 / $att_length;

echo '

<div class="container-fluid">
    <div class="row">

        <div class="col-md-4 p-4">
            <div class="card shadow-lg">
                <div class="card-header shadow-lg" style="background-color: #0f2b44;">
                    <h3 class="text-center text-white fs-5">STUDENT DUES</h3>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="card-box shadow-lg d-flex justify-content-center align-items-center">
                        <h1 class="fs-3" style="color: #0f2b44;">'; ?>
<?php echo $all_stu_info['fee'] - $all_stu_info['paid_fee'];
echo '</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-4">
            <div class="card shadow-lg">
                <div class="card-header shadow-lg" style="background-color: #0f2b44;">
                    <h3 class="text-center text-white fs-5">STUDENT PAID</h3>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="card-box shadow-lg d-flex justify-content-center align-items-center">
                        <h1 class="fs-3" style="color: #0f2b44;">'; ?>
<?php echo $all_stu_info['paid_fee'];
echo '</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-4">
            <div class="card shadow-lg">
                <div class="card-header shadow-lg" style="background-color: #0f2b44;">
                    <h3 class="text-center text-white fs-5">STUDENT ATTENDANCE</h3>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="card-box shadow-lg d-flex justify-content-center align-items-center">
                        <h1 class="fs-3" style="color: #0f2b44;">' ?>
<?php echo $percentage . "%";
echo '</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-4">
            <div class="card shadow-lg">
                <div class="card-header shadow-lg" style="background-color: #0f2b44;">
                    <h3 class="text-center text-white fs-5">STUDENT DETAILS</h3>
                </div>
                <div class="card-body">
                    <b>NAME : <strong>' ?>
<?php echo $all_stu_info['name'];
echo '</strong></b><br><br>
                    <b>COURSE : <strong>' ?>
<?php echo $all_stu_info['course'];
echo '</strong></b><br><br>
                    <b>BATCH : <strong>' ?>
<?php echo $all_stu_info['batch'];
echo '</strong></b><br><br>
                    <b>ENROLLMENT : <strong>' ?>
<?php echo $all_stu_info['enrollment'];
echo '</strong></b>
                </div>
            </div>
        </div>
    </div>
</div>

';

?>