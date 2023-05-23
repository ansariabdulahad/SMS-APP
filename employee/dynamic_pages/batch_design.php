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
        <div class="col-md-10 px-4 p-2 mt-3 bg-white shadow-lg rounded">

            <h5 class="mt-1 px-2 p-1">CREATE BATCH
                <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none batch-loader"></i>
            </h5>

            <hr>

            <form class="batch-form">

                <div class="row">
                    <div class="col-md-6">
                        <select name="batch-category" id="select-batch-category"
                            class="form-select mb-3 mt-3 shadow batch-category">
                            <option value="choose category">Choose Category</option>';

for ($i = 0; $i < $length; $i++) {
    echo '<option value="' . $all_category[$i]
        . '">' . $all_category[$i] . '</option>';
}
echo '</select>
                </div>
                    <div class="col-md-6">
                        <select name="batch-course" id="batch-course" class="form-select mb-3 mt-3 shadow batch-course">
                            <option value="choose course">Choose Course</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="batch-code" class="form-control mb-3 mt-3 shadow"
                            placeholder="Batch Code">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="batch-name" class="form-control mb-3 mt-3 shadow"
                            placeholder="Batch Name">
                    </div>
                </div>

                <textarea name="batch-detail" class="form-control mb-3 mt-3 shadow"
                    placeholder="Batch Details"></textarea>

                <div class="row">
                    <div class="col-md-6">
                        <label for="batch-from" class="mt-1 fw-bold">Batch From Time</label>
                        <input type="time" id="batch-from" name="batch-from" class="form-control mb-3 mt-1 shadow">
                    </div>
                    <div class="col-md-6">
                        <label for="batch-to" class="mt-1 fw-bold">Batch To Time</label>
                        <input type="time" id="batch-to" name="batch-to" class="form-control mb-3 mt-1 shadow">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="batch-from-date" class="mt-1 fw-bold">Batch From Date</label>
                        <input type="date" id="batch-from-date" name="batch-from-date" class="form-control mb-3 mt-1 shadow">
                    </div>
                    <div class="col-md-6">
                        <label for="batch-to-date" class="mt-1 fw-bold">Batch To Date</label>
                        <input type="date" id="batch-to-date" name="batch-to-date" class="form-control mb-3 mt-1 shadow">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="batch-logo" class="mt-1 fw-bold">Batch Logo</label>
                        <input type="file" id="batch-logo" name="batch-logo" class="form-control mb-3 mt-1 shadow">
                    </div>
                    <div class="col-md-6 mt-3">
                        <input type="text" name="batch-added-by" class="form-control mb-3 mt-3 shadow"
                            placeholder="Batch Added By">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="checkbox" id="batch-active" name="batch-active"
                            class=" mb-3 mt-4 shadow">
                        <label for="batch-active">Is Active</label>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary mb-3 mt-3 shadow float-end"><i
                                class="fa fa-plus"></i> &nbsp; Add Batch
                        </button>
                        <button type="button" class="btn btn-danger mb-3 mt-3 shadow float-end d-none">Update Batch
                        </button>
                    </div>
                </div>

            </form>
            </div>
            <div class="col-md-1"></div>
            </div>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 px-4 p-2 mt-5 mb-5 bg-white shadow-lg rounded">

                <h5 class="mt-1 px-2 p-1">BATCH LIST
                    <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none batch-list-loader"></i>
                </h5>

                <hr>

            <div class="row">
                <div class="col-md-6">
                    <select name="batch-category" id="batch-list-category" class="form-select mb-3 mt-3 shadow">
                        <option value="choose category">Choose Category</option>';
for (
    $i = 0;
    $i <
    $length;
    $i++
) {
    echo '<option value="' . $all_category[$i] . '">' .
        $all_category[$i] . '</option>';
}
echo '</select>
            </div>
                <div class="col-md-6">
                    <select name="batch-course" id="batch-list-course" class="form-select mb-3 mt-3 shadow">
                        <option value="choose course">Choose Course</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive rounded shadow-lg mb-3">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Sr No</th>
                            <th class="text-nowrap">Category</th>
                            <th class="text-nowrap">Course</th>
                            <th class="text-nowrap">Batch Code</th>
                            <th class="text-nowrap">Batch Name</th>
                            <th class="text-nowrap">Starting Time</th>
                            <th class="text-nowrap">Ending Time</th>
                            <th class="text-nowrap">Start Date</th>
                            <th class="text-nowrap">End Date</th>
                            <th class="text-nowrap">Is Active</th>
                            <th class="text-nowrap">Added Date</th>
                            <th class="text-nowrap">Added By</th>
                            <th class="text-nowrap">Batch Details</th>
                            <th class="text-nowrap">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="batch-list">
                        
                    </tbody>

                </table>
                </div>

                </div>
                <div class="col-md-1"></div>
                </div>
            </div>

';

?>