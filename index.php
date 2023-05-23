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
    <title>Home Page</title>
    <style>
        .carousel-caption {
            line-height: 80px;
        }
    </style>
</head>

<body>

    <?php require("assets/nav.php"); ?>

    <!-- CROUSAL CODING -->

    <div class="container-fluid" style="margin-top : 90px !important;">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="900">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">

                <?php
                $showcase = "SELECT * FROM header_showcase";
                $response = $db->query($showcase);

                if ($response) {

                    while ($data = $response->fetch_assoc()) {

                        $h_align = $data['h_align'];
                        $v_align = $data['v_align'];
                        $title_size = $data['title_size'];
                        $title_color = $data['title_color'];
                        $subtitle_size = $data['subtitle_size'];
                        $subtitle_color = $data['subtitle_color'];

                        $text_align = "";

                        if ($h_align == 'center') {

                            $text_align = "text-center";

                        } else if ($h_align == 'flex-start') {

                            $text_align = "text-start";

                        } else if ($h_align == 'flex-end') {

                            $text_align = "text-start";
                        }

                        echo '<div class="carousel-item carousel-item-control">';

                        $image = "data:image/png;base64," . base64_encode($data['title_image']);

                        echo '<img src="' . $image . '" class="w-100 h-100">';

                        echo '<div class="carousel-caption d-flex h-100 ' . $text_align . '" style="justify-content: ' . $h_align . '; align-items:' . $v_align . ';">';
                        echo '<div>';
                        echo '<h1 style="font-size:' . $title_size . '; color:' . $title_color . ';">' . $data['title_text'] . '</h1>';
                        echo '<h5 style="font-size:' . $subtitle_size . '; color:' . $subtitle_color . ';">' . $data['subtitle_text'] . '</h5>';
                        echo $data['buttons'];
                        echo '</div>';
                        echo '</div>';

                        echo '</div>';

                    }
                }
                ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- START COURSE SECTION CODING -->

    <div class="course-section">
        <div class="container">

            <h1 class="mt-5 fw-bold mb-4">Trending Courses</h1>

            <div class="row mb-5">

                <?php

                $get_course = "SELECT * FROM course";
                $course_res = $db->query($get_course);

                if ($course_res) {

                    while ($data = $course_res->fetch_assoc()) {

                        echo '
                        
                        <div class="col-3 p-1 mb-3 course-box">
                            <div class="card shadow">

                                <img class="card-img-top" src="./employee/' . $data['logo'] . '" height="300px">

                                <div class="card-body">
                                    <h4 class="card-title">' . $data['name'] . '</h4>
                                    <p class="card-text fw-bold">₹ ' . $data['fee'] . '</p>
                                </div>

                            </div>
                        </div>

                        ';
                    }
                }

                ?>

            </div>

        </div>
    </div>

    <!-- END COURSE SECTION CODING -->

    <?php require("assets/footer.php"); ?>

    <!-- JS FILE LINK -->
    <script src="assets/index.js"></script>

    <script>
        $(document).ready(function () {

            let carousel_item = document.querySelector(".carousel-item-control");

            $(carousel_item).addClass("active");
        });
    </script>

</body>

</html>