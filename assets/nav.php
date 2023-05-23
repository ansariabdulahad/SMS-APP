<!-- PHP CODING -->

<?php

session_start();

$brand_res = "";
$get_brand = "SELECT * FROM branding";
$response = $db->query($get_brand);

if ($response) {

    $brand_res = $response->fetch_assoc();
}

?>

<!-- NAV BAR CODING -->

<div class="container-fluid bg-light shadow-sm">
    <nav class="navbar navbar-expand-sm fixed-top shadow-lg navbar-light bg-light">
        <div class="container">

            <a href="#" class="navbar-brand text-uppercase border rounded p-2 shadow-sm">

                <!-- GET LOGO FROM DB -->
                <?php

                $logo_string = base64_encode($brand_res['brand_logo']);
                $src = "data:image/png;base64," . $logo_string;

                echo "<img src='" . $src . "' width='40' class='rounded shadow-lg'>";
                echo "&nbsp";
                echo "<bold>" . $brand_res['brand_name'] . "</bold>";

                $_SESSION['brand-name'] = $brand_res['brand_name'];

                ?>
            </a>

            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="myNavbar">
                <ul class="navbar-nav w-100 justify-content-end">

                    <li class="nav-item border rounded mx-1">
                        <a href="#" class="nav-link fw-bold">Home</a>
                    </li>
                    <li class="nav-item border rounded mx-1">
                        <a href="#" class="nav-link fw-bold">About</a>
                    </li>

                    <!-- GET CATEGORY MENU FROM DB -->
                    <?php

                    $get_menu = "SELECT * FROM category";
                    $cat_response = $db->query($get_menu);

                    if ($cat_response) {

                        while ($data = $cat_response->fetch_assoc()) {

                            echo '
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="http://localhost/sms-APP/course.php?cat_name=' . $data['category_name'] . '">' . $data['category_name'] . '</a>
                                </li>

                                ';
                        }
                    }

                    ?>

                    <div class="dropdown btn-group shadow-sm ml-auto">

                        <button class="btn shadow-lg">
                            <i class="fa fa-user" data-bs-toggle="dropdown"></i>

                            <div class="dropdown-menu">
                                <a href="register.php" class="dropdown-item">
                                    <i class="fa fa-user"></i>
                                    Register
                                </a>
                                <a href="login.php" class="dropdown-item">
                                    <i class="fa fa-sign-in"></i>
                                    Login
                                </a>
                            </div>
                        </button>

                    </div>

                </ul>
            </div>

        </div>
    </nav>
</div>