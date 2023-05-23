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

                        <h5 class="mt-1 px-2 p-1">CREATE COURSE
                            <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none course-loader"></i>
                        </h5>

                        <hr>

                        <form class="course-form">

                            <select name="course-category" id="select-category" class="form-select mb-3 mt-3 shadow">
                                <option value="choose category">Choose Category</option>';

for ($i = 0; $i < $length; $i++) {

    echo '<option value="' . $all_category[$i] . '">' . $all_category[$i] . '</option>';
}

echo '</select>

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="course-code" class="form-control mb-3 mt-3 shadow"
                                        placeholder="Course Code">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="course-name" class="form-control mb-3 mt-3 shadow"
                                        placeholder="Course Name">
                                </div>
                            </div>

                            <textarea name="course-detail" class="form-control mb-3 mt-3 shadow"
                                placeholder="Course Details"></textarea>

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="course-duration" class="form-control mb-3 mt-3 shadow"
                                        placeholder="Course Duration">
                                </div>
                                <div class="col-md-6">
                                    <select name="course-time" class="form-select mb-3 mt-3 shadow">
                                        <option value="days">Days</option>
                                        <option value="month">Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="course-fee" class="form-control mb-3 mt-3 shadow"
                                        placeholder="Course Fee">
                                </div>
                                <div class="col-md-6">
                                    <select name="course-fee-time" class="form-select mb-3 mt-3 shadow">
                                        <option value="monthly">Monthly</option>
                                        <option value="one-time">One-Time</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" name="course-logo" class="form-control mb-3 mt-3 shadow">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="course-added-by" class="form-control mb-3 mt-3 shadow"
                                        placeholder="Course Added By">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="checkbox" id="course-active" name="course-active"
                                        class=" mb-3 mt-3 shadow">
                                    <label for="course-active">Is Active</label>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary mb-3 mt-3 shadow float-end"><i
                                            class="fa fa-plus"></i> &nbsp; Add Course
                                    </button>
                                    <button type="button" class="btn btn-danger mb-3 mt-3 shadow float-end d-none">Update Course
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

                        <h5 class="mt-1 px-2 p-1">COURSE LIST
                            <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none course-list-loader"></i>
                        </h5>

                        <hr>

                        <select name="select-category" class="form-select mb-3 mt-3 shadow course-category">
                            <option value="choose category">Choose Category</option>';

for ($i = 0; $i < $length; $i++) {

    echo '<option value="' . $all_category[$i] . '">' . $all_category[$i] . '</option>';
}

echo '</select>

                        <div class="table-responsive rounded shadow-lg mb-3">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Sr No</th>
                                        <th class="text-nowrap">Category</th>
                                        <th class="text-nowrap">Course Code</th>
                                        <th class="text-nowrap">Course Name</th>
                                        <th class="text-nowrap">Duration</th>
                                        <th class="text-nowrap">Total Time</th>
                                        <th class="text-nowrap">Fee</th>
                                        <th class="text-nowrap">Fee Period</th>
                                        <th class="text-nowrap">Is Active</th>
                                        <th class="text-nowrap">Added Date</th>
                                        <th class="text-nowrap">Added By</th>
                                        <th class="text-nowrap">Course Details</th>
                                        <th class="text-nowrap">Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="course-list">
                                    
                                </tbody>

                            </table>
                        </div>

                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

';

?>