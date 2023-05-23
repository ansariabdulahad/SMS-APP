<!-- DATABASE CONNECTION -->
<?php

require("common_files/php/database.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="./common_files/css/animate.min.css">
    <link rel="stylesheet" href="./common_files/css/bootstrap.min.css">
    <!-- JS LINK -->
    <script src="./common_files/js/bootstrap.bundle.min.js"></script>
    <script src="./common_files/js/fontawesome.js"></script>
    <script src="./common_files/js/jquery-3.6.3.js"></script>
    <script src="./common_files/js/sweetalert.min.js"></script>
    <title>Privacy Page</title>
</head>

<body>

    <?php require("assets/nav.php"); ?>

    <div class="container bg-white shadow-lg border p-4 rounded" style="margin-top: 100px;">

        <h5 class="mt-1 px-2 p-2">CREATE ACCOUNT
            <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none"></i>
        </h5>

        <hr>

        <div class="row">

            <div class="col-md-6">
                <form class="register-form">
                    <label for="name" class="mt-1 fw-bold">Name</label>
                    <input type="text" id="name" name="name" class="form-control mb-3 mt-1 shadow"
                        placeholder="Enter Name" required>

                    <label for="email" class="mt-1 fw-bold">Email</label>
                    <input type="email" id="email" name="email" class="form-control mb-3 mt-1 shadow"
                        placeholder="Enter Email" required>

                    <label for="mobile" class="mt-1 fw-bold">Mobile</label>
                    <input type="tel" id="mobile" name="mobile" class="form-control mb-3 mt-1 shadow"
                        placeholder="Enter Mobile" required>

                    <label for="description" class="mt-1 fw-bold">Description</label>
                    <textarea name="description" id="description" name="description"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Description" required></textarea>

                    <button class="btn btn-primary mb-3 mt-3 shadow register-btn">Register Now</button>
                </form>

                <form class="d-none verify-form">
                    <div class="form-group">
                        <div class="btn-group border shadow-lg">
                            <button class="btn btn-light" type="button">
                                <input type="text" placeholder="123" name="otp" class="form-control shadow-lg otp">
                            </button>
                            <button class="btn btn-warning shadow-lg verify-btn" type="button">Verify</button>
                            <button class="btn btn-danger shadow-lg resend-btn" type="button">Resend OTP</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-1"></div>

            <div class="col-md-5">

                <h4 class="mt-3">I am student of institute</h4>
                <p>I have already an account</p>
                <a href="login.php" class="btn btn-danger mb-3 mt-3 shadow">Login Now</a>

            </div>

        </div>

    </div>

    <?php require("assets/footer.php"); ?>

    <!-- JS FILE LINK -->
    <script src="assets/index.js"></script>

    <script>
        $(document).ready(function () {
            $(".register-form").submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "pages/php/register.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function () {

                        $(".register-btn").html("Sending OTP...");
                        $(".register-btn").attr("disabled", "disabled");
                    },
                    success: function (response) {

                        $(".register-btn").html("Register Now");
                        $(".register-btn").attr("disabled", false);

                        console.log(response.trim());
                        alert(response.trim())
                        // if (response.trim() === "success") {

                        //     $(".verify-form").removeClass("d-none");
                        //     $(".register-form").addClass("d-none");

                        //     // swal("REGISTERED !", "Registeration done successfully", "success");
                        // }
                        // else {

                        //     swal("FAILED !", response.trim(), "warning");
                        // }

                    }
                });
            })
        });
    </script>

</body>

</html>