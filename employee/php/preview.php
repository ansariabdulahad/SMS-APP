<?php

$file = $_FILES['photo'];
$location = $file['tmp_name'];
$image = "data:image/png;base64," . base64_encode(file_get_contents($location));

$data = json_decode($_POST['data']);
$text = $data[0];
$h_align = $data[1];
$v_align = $data[2];

$text_align = "";

if ($h_align == 'center') {

    $text_align = "text-center";

} else if ($h_align == 'flex-start') {

    $text_align = "text-start";

} else if ($h_align == 'flex-end') {

    $text_align = "text-start";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Link -->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="../common_files/css/bootstrap.min.css">
    <link rel="stylesheet" href="../common_files/css/animate.min.css">

    <!-- JS Link -->
    <script src="../common_files/js/bootstrap.bundle.min.js"></script>
    <script src="../common_files/js/jquery-3.6.3.js"></script>
    <script src="../common_files/js/fontawesome.js"></script>
    <script src="../common_files/js/sweetalert.min.js"></script>
    <title>Blank Page</title>

    <style>

    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">

                    <img src="<?php echo $image; ?>" class="w-100">

                    <div class="carousel-caption h-100 d-flex <?php echo $text_align; ?>"
                        style="justify-content: <?php echo $h_align; ?>; align-items: <?php echo $v_align; ?>;">
                        <div>
                            <?php echo $text; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>