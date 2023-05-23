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

            <h5 class="mt-1 px-2 p-1">STUDENT REGISTRATION FORM
                <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none student-loader"></i>
            </h5>

            <hr>

            <form class="student-form">

                <div class="row">
                    <div class="col-md-4">
                        <select name="stu-category" id="select-stu-category"
                            class="form-select mb-3 mt-3 shadow stu-category">
                            <option value="choose category">Choose Category</option>';

for ($i = 0; $i < $length; $i++) {
    echo '<option value="' . $all_category[$i]
        . '">' . $all_category[$i] . '</option>';
}
echo '</select>
                    </div>
                    <div class="col-md-4">
                        <select name="stu-course" id="stu-course" class="form-select mb-3 mt-3 shadow stu-course">
                            <option value="choose course">Choose Course</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="stu-batch" id="stu-batch" class="form-select mb-3 mt-3 shadow stu-batch">
                            <option value="choose batch">Choose Batch</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="enrollment" class="form-control mb-3 mt-3 shadow enrollment-el"
                            placeholder="Enrollment" required>
                        <span class="text-danger enroll-msg"></span>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control mb-3 mt-3 shadow"
                            placeholder="Name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="number" name="day" class="form-control mb-3 mt-3 shadow day" placeholder="DD">
                            </div>
                            <div class="col-md-4">
                                <select name="month" class="form-select mb-3 mt-3 shadow month">
                                    <option value="choose month">Choose Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">Decemeber</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="year" class="form-control mb-3 mt-3 shadow year" placeholder="YY">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <select name="gender" class="form-control mb-3 mt-3 shadow gender">
                            <option value="choose gender">Choose Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="father" class="form-control mb-3 mt-3 shadow"
                            placeholder="Father Name">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="mother" class="form-control mb-3 mt-3 shadow"
                            placeholder="Mother Name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control mb-3 mt-1 shadow email" placeholder="Email" required>
                        <span class="text-danger email-msg"></span>
                    </div>
                    <div class="col-md-4">
                        <input type="password" name="password" class="form-control mb-3 mt-1 shadow" placeholder="Password">
                    </div>
                    <div class="col-md-4">
                        <input type="mobile" name="mobile" class="form-control mb-3 mt-1 shadow" placeholder="Mobile">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="country" class="form-control mb-3 mt-3 shadow"
                            placeholder="Country">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="state" class="form-control mb-3 mt-3 shadow"
                            placeholder="State">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="city" class="form-control mb-3 mt-3 shadow"
                            placeholder="City">
                    </div>
                    <div class="col-md-6">
                        <input type="pincode" name="pincode" class="form-control mb-3 mt-3 shadow"
                            placeholder="Pincode">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="fee" class="form-control mb-3 mt-3 shadow text-danger fw-bold fee"
                            placeholder="Fee" readonly>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="fee-time" class="form-control mb-3 mt-3 shadow text-danger fw-bold fee-time"
                            placeholder="Fee Time" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="checkbox" id="stu-active" name="stu-active"
                            class=" mb-3 mt-4 shadow">
                        <label for="stu-active" class="fw-bold">Is Active</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="added-by" class="form-control mb-3 mt-3 shadow"
                            placeholder="Added By">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mb-3 mt-3 shadow float-end stu-add-btn" disabled>Add Student
                        </button>
                        <button type="button" class="btn btn-danger mb-3 mt-3 shadow float-end d-none">Update Student
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

            <h5 class="mt-1 px-2 p-1">STUDENT LIST
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

            <div class="table-responsive rounded shadow-lg mb-3">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Sr No</th>
                            <th class="text-nowrap">Category</th>
                            <th class="text-nowrap">Course</th>
                            <th class="text-nowrap">Batch</th>
                            <th class="text-nowrap">Enrollment</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Father Name</th>
                            <th class="text-nowrap">Mother Name</th>
                            <th class="text-nowrap">DOB</th>
                            <th class="text-nowrap">Gender</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Password</th>
                            <th class="text-nowrap">Mobile</th>
                            <th class="text-nowrap">Country</th>
                            <th class="text-nowrap">State</th>
                            <th class="text-nowrap">City</th>
                            <th class="text-nowrap">Pincode</th>
                            <th class="text-nowrap">Fee</th>
                            <th class="text-nowrap">Fee Time</th>
                            <th class="text-nowrap">Student Photo</th>
                            <th class="text-nowrap">Student Signature</th>
                            <th class="text-nowrap">Id Proof</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Added By</th>
                            <th class="text-nowrap">Added Date</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>

                    <tbody class="student-list">
                        
                    </tbody>

                </table>
            </div>

        </div>
        <div class="col-md-1"></div>
    </div>
</div>

';

?>