<!-- DATABASE CONNECTION -->
<?php

require("common_files/php/database.php");

$category = $_GET['cat_name'];

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

        <a href="#" class="text-uppercase">
            <?php echo $category; ?>
        </a>
        <br><br>

        <div class="row">

            <div class="col-md-3">
                <div class="border bg-white p-4">
                    <h5>Filter</h5>
                    <div class="btn-group-vertical">

                        <?php

                        $get_course = "SELECT * FROM course WHERE category = '$category'";
                        $course_res = $db->query($get_course);

                        if ($course_res) {

                            while ($data = $course_res->fetch_assoc()) {

                                echo "<button cat-name='" . $data['category'] . "' class='btn text-start px-1 text-capitalize filter-btn'><i class='fa fa-angle-double-right'></i>&nbsp;" . $data['name'] . "</button>";
                            }
                        }

                        ?>

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="bg-white d-flex flex-wrap justify-content-between border p-4 batch-result">

                </div>
            </div>

        </div>

    </div>

    <?php require("assets/footer.php"); ?>

    <script>
        $(document).ready(function () {
            $(".filter-btn").each(function () {
                $(this).click(function () {

                    let cat_name = $(this).attr('cat-name').trim();
                    let course_name = $(this).text().trim();

                    $.ajax({
                        type: "POST",
                        url: "pages/php/filter.php",
                        data: {
                            cat_name: cat_name,
                            course_name: course_name
                        },
                        beforeSend: function () {
                            $(".batch-result").html("<b>Loading...</b>");
                        },
                        success: function (response) {

                            $(".batch-result").html("");

                            if (response.trim() != "There is no batch !") {

                                let batch_list = JSON.parse(response.trim());

                                if (batch_list.length != 0) {

                                    batch_list.forEach((batch, index) => {

                                        let box = `
                                        
                                        <div class="w-50 shadow-lg p-3 border mb-4">
                                            <img src="employee/${batch.logo}" class="w-100">
                                            <br><br>
                                            <span class="mt-3 fw-bold text-uppercase">${batch.course}</span> <br><br>
                                            <span class="fw-bold text-uppercase">Batch Time : ${batch.batch_from} To ${batch.batch_to}</span> <br><br>
                                            <span class="fw-bold text-uppercase">Batch Date : ${batch.batch_from_date} To ${batch.batch_to_date}</span> <br><br>
                                            <a href="http://localhost/sms-APP/register.php" class="btn btn-primary">Register Now</a>
                                        </div>

                                        `;

                                        $(".batch-result").append(box);
                                    });

                                }
                                else {

                                    $(".batch-result").html("<h2><i class='fa fa-shopping-cart'></i> Yet no batch in this course !</h2>")

                                }
                            }
                            else {

                                $(".batch-result").html("<h2><i class='fa fa-shopping-cart'></i> Yet no batch in this course !</h2>")
                            }
                        }
                    });
                })
            })
        });
    </script>

</body>

</html>