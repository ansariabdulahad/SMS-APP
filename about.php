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

    <div class="container bg-white p-4 shadow-lg border" style="margin-top : 90px;">
        <?php echo $brand_res['brand_about']; ?>
    </div>

    <?php require("assets/footer.php"); ?>

</body>

</html>