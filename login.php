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
    <title>Login Page</title>
</head>

<body>

    <?php require("assets/nav.php"); ?>

    <div class="container bg-white shadow-lg border p-4 rounded" style="margin-top: 100px;">

        <h5 class="mt-1 px-2 p-2">LOGIN WITH US
            <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none login-loader"></i>
        </h5>

        <hr>

        <div class="row">

            <div class="col-md-6">
                <label for="username" class="mt-1 fw-bold">Username</label>
                <input type="email" id="username" name="username" class="form-control mb-3 mt-1 shadow"
                    placeholder="Enter Username" required>

                <label for="password" class="mt-1 fw-bold">Password</label>
                <input type="password" id="password" name="password" class="form-control mb-3 mt-1 shadow"
                    placeholder="Enter Password" required>

                <input type="radio" name="user" value="admin" id="admin" class="user" required>
                <label for="admin" class="fw-bold">Admin</label> &nbsp; &nbsp;
                <input type="radio" name="user" value="student" id="student" class="user" required>
                <label for="student" class="fw-bold">Student</label>

                <br>

                <button class="btn btn-primary mb-3 mt-3 shadow login-btn">Login Now</button>
            </div>

            <div class="col-md-1"></div>

            <div class="col-md-5">

                <h4 class="mt-3">New Student</h4>
                <p>If u don't have any account please register first !</p>
                <a href="register.php" class="btn btn-danger mb-3 mt-3 shadow">Register Now</a>

            </div>

        </div>

    </div>

    <?php require("assets/footer.php"); ?>

    <!-- JS FILE LINK -->
    <script src="assets/index.js"></script>

</body>

</html>