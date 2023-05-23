<?php

// require navbar
require_once('../php/nav.php');

echo '

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 px-4 p-2 mt-3 mb-3 bg-white shadow-lg rounded">

            <h5 class="mt-1 px-2 p-1">ADD DOCUMENT
                <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none document-loader"></i>
            </h5>

            <hr>

            <form class="document-form">
                <div class="row">
                    <div class="col-md-8">


                        <label for="stu-enrollment" class="fw-bold mt-3">Student Enrollment</label>
                        <span class="text-danger enroll-doc-msg"></span>
                        <input type="number" id="stu-enrollment" name="enrollment"
                            class="form-control mb-3 mt-1 shadow" placeholder="Enrollment" required>

                        <label for="stu-photo" class="fw-bold mt-3">Upload Password Size Photo</label>
                        <input type="file" id="stu-photo" name="photo"
                            class="form-control mb-3 mt-1 shadow">


                    </div>
                    <div
                        class="col-md-4 d-flex justify-content-center align-items-center rounded bg-body-tertiary">
                        <img src="./photos/img-5.png" height="150" width="150" alt="avatar"
                            class="rounded shadow">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">


                        <label for="stu-signature" class="fw-bold mt-3">Upload Signature</label>
                        <input type="file" id="stu-signature" name="signature"
                            class="form-control mb-3 mt-1 shadow">

                        <label for="id-proof" class="fw-bold mt-3">Upload ID Proof In PDF Format</label>
                        <input type="file" id="id-proof" name="id-proof"
                            class="form-control mb-3 mt-1 shadow">


                    </div>
                    <div
                        class="col-md-4 d-flex justify-content-center align-items-center rounded bg-body-tertiary">
                        <img src="./signatures/Signature.png" height="150" width="150" alt="signature"
                            class="rounded shadow">
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-3 shadow-lg mb-3 document-btn" disabled>Upload Document</button>
            </form>

        </div>
        <div class="col-md-1"></div>
    </div>
</div>

';

?>