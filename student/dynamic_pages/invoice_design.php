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

            <h5 class="mt-1 px-2 p-1">ADD INVOICE
                <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none invoice-loader"></i>
            </h5>

            <hr>

            <form class="invoice-form">

                <label for="invoice-enrollment" class="fw-bold">Enrollment No</label>
                <span class="text-danger invoice-msg"></span>
                <input type="number" name="invoice-enrollment" id="invoice-enrollment"
                    class="form-control mb-3 mt-1 shadow" placeholder="Enter Enrollment Number">

                <div class="table-responsive rounded shadow-lg mb-3">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Enrollment</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Category</th>
                                <th class="text-nowrap">Course</th>
                                <th class="text-nowrap">Batch</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><input type="text" name="enrollment" class="form-control mb-3 mt-1 shadow inv-enroll"
                                        placeholder="Enrollment" readonly></td>
                                <td><input type="text" name="name" class="form-control mb-3 mt-1 shadow inv-name"
                                        placeholder="Name" readonly></td>
                                <td><input type="text" name="category" class="form-control mb-3 mt-1 shadow inv-category"
                                        placeholder="Category" readonly></td>
                                <td><input type="text" name="course" class="form-control mb-3 mt-1 shadow inv-course"
                                        placeholder="Course" readonly></td>
                                <td><input type="text" name="batch" class="form-control mb-3 mt-1 shadow inv-batch"
                                        placeholder="Batch" readonly></td>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <h6 class="fw-bold text-danger">Total Fee : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <span class="total-fee">0</span>
                </h6>
                <br>
                <h6 class="fw-bold text-danger">Paid Amount : &nbsp; &nbsp; &nbsp; &nbsp; <span class="total-fee">0</span>
                </h6>
                <br>

                <div class="table-responsive rounded shadow-lg mb-3">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Fee Time</th>
                                <th class="text-nowrap">Amount Pending</th>
                                <th class="text-nowrap">Amount Payable</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><input type="text" name="fee-time" class="form-control mb-3 mt-1 shadow inv-time"
                                        placeholder="Fee Time" readonly></td>
                                <td><input type="text" name="pending-amount" class="form-control mb-3 mt-1 shadow"
                                        placeholder="Amount Pending" readonly></td>
                                <td><input type="text" name="recent-paid" class="form-control mb-3 mt-1 shadow recent-paid inv-recent"
                                        placeholder="Enter Amount To Pay" required></td>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <button type="submit" class="btn btn-primary mb-3 mt-3 shadow float-end invoice-btn"
                    disabled>Add Invoice
                </button>

            </form>
        </div>
        <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 px-4 p-2 mt-5 mb-5 bg-white shadow-lg rounded">

            <h5 class="mt-1 px-2 p-1">INVOICE LIST
                <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none student-list-loader"></i>
            </h5>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <select name="select-category" id="stu-list-category"
                        class="form-select mb-3 mt-3 shadow">
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
                    <select name="select-course" id="stu-list-course" class="form-select mb-3 mt-3 shadow">
                        <option value="choose course">Choose Course</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="select-batch" id="stu-list-batch" class="form-select mb-3 mt-3 shadow">
                        <option value="choose batch">Choose Batch</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="search" name="search" class="form-control mb-3 mt-3 shadow"
                            placeholder="Search By Name And Enrollment">
                </div>
                
            </div>

            <div class="table-responsive  rounded shadow-lg mb-3 mt-3">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Sr No</th>
                            <th class="text-nowrap">Category</th>
                            <th class="text-nowrap">Course</th>
                            <th class="text-nowrap">Batch</th>
                            <th class="text-nowrap">Enrollment</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Fee Time</th>
                            <th class="text-nowrap">Paid Fee</th>
                            <th class="text-nowrap">Recently Pay</th>
                            <th class="text-nowrap">Due Fee</th>
                            <th class="text-nowrap">Paid Date</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>

                    <tbody class="invoice-list">
                        <tr>
                            <td class="text-nowrap">Sr No</td>
                            <td class="text-nowrap">Category</td>
                            <td class="text-nowrap">Course</td>
                            <td class="text-nowrap">Batch</td>
                            <td class="text-nowrap">Enrollment</td>
                            <td class="text-nowrap">Name</td>
                            <td class="text-nowrap">Fee Time</td>
                            <td class="text-nowrap">Paid Fee</td>
                            <td class="text-nowrap">Recently Pay</td>
                            <td class="text-nowrap">Due Fee</td>
                            <td class="text-nowrap">Paid Date</td>
                            <td class="text-nowrap">
                                <button class="btn btn-success"><i class="far fa-eye"></i></button>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
        <div class="col-md-1"></div>
    </div>
</div>

';

?>