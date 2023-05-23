<?php

// require navbar
require_once('../php/nav.php');
require_once("../../common_files/php/database.php");

$get_category = "SELECT * FROM category";
$response = $db->query($get_category);
$all_category = [];

if ($response) {

    while ($data = $response->fetch_assoc()) {

        array_push($all_category, $data['category_name']);
    }
}

$length = count($all_category);

echo '

<div class="container-fluid">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 px-4 p-2 mt-3 mb-3 bg-white shadow-lg rounded">

        <h5 class="mt-1 px-2 p-1">CREATE ATTENDANCE
            <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none attendance-loader"></i>
        </h5>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <select name="select-category" id="att-category" class="form-select mb-3 mt-3 shadow">
                    <option value="choose category">Choose Category</option>';
for (
    $i = 0;
    $i < $length;
    $i++
) {
    echo '<option value="' . $all_category[$i] . '">' .
        $all_category[$i] . '</option>';
}
echo '</select>
            </div>
            <div class="col-md-4">
                <select name="select-course" id="att-course" class="form-select mb-3 mt-3 shadow">
                    <option value="choose course">Choose Course</option>
                </select>
            </div>
            <div class="col-md-4">
                <select name="select-batch" id="att-batch" class="form-select mb-3 mt-3 shadow">
                    <option value="choose batch">Choose Batch</option>
                </select>
            </div>
        </div>

        <form class="attendance-form mt-3">

            <input type="date" class="form-control mb-4 mt-1 shadow date">

            <div class="table-responsive rounded shadow-lg mb-3">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Sr No</th>
                            <th class="text-nowrap">Enrollment</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Batch</th>
                            <th class="text-nowrap">Attendeance</th>
                        </tr>
                    </thead>

                    <tbody class="attendance-list">
                        
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary mb-3 mt-3 shadow float-end attendance-btn"
                disabled>Add Attendance
            </button>

        </form>
    </div>
    <div class="col-md-1"></div>
</div>
</div>

';

?>