<!-- FOOTER CODING -->

<div class="container" style="margin-top: 238px;">
    <div class="row">

        <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center">

            <div class="input-group w-100 mt-3">
                <input type="email" class="form-control shadow" placeholder="@gamil.com">
                <span class="input-group-text btn border shadow fw-bold text-danger">SUBSCRIBE</span>
            </div>

        </div>

        <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center">
            <div class="btn-group mt-3">

                <button class="btn btn-dark mx-1 rounded shadow">FOLLOW US</button>
                <button class="btn border mx-1 rounded shadow">
                    <a href="<?php echo $brand_res['brand_twitter'] ?>">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </button>
                <button class="btn border mx-1 rounded shadow">
                    <a href="<?php echo $brand_res['brand_facebook'] ?>">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                </button>
                <button class="btn border mx-1 rounded shadow">
                    <a href="<?php echo $brand_res['brand_instagram'] ?>">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </button>
                <button class="btn border mx-1 rounded shadow">
                    <a href="<?php echo $brand_res['brand_whatsapp'] ?>">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </button>

            </div>
        </div>

    </div>
</div>

<div class="container-fluid bg-dark p-4">

    <div class="row">

        <div class="col-md-3 text-center">

            <h4 class="text-white text-decoration-underline">CATEGORY</h4>

            <!-- GET CATEGORY FROM DB -->
            <?php

            $get_menu = "SELECT * FROM category";
            $cat_response = $db->query($get_menu);

            if ($cat_response) {

                while ($data = $cat_response->fetch_assoc()) {

                    echo '
                                
                            <a class="nav-link text-primary mb-2 fw-bold" href="#">' . $data['category_name'] . '</a>

                        ';
                }
            }

            ?>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-3 text-center">

            <h4 class="text-white text-decoration-underline">POLICIES</h4>

            <a class="nav-link text-primary mb-2 fw-bold" href="privacy.php">Privacy Policy</a>
            <a class="nav-link text-primary mb-2 fw-bold" href="cookie.php">Cookie Policy</a>
            <a class="nav-link text-primary mb-2 fw-bold" href="terms.php">Terms & Conditions</a>
            <a class="nav-link text-primary mb-2 fw-bold" href="about.php">About Us</a>

        </div>

        <div class="col-md-1"></div>

        <div class="col-md-4">

            <h4 class="text-white text-decoration-underline">CONTACTS</h4>

            <p class="text-white py-2"><b>Venue</b> :
                <?php echo $brand_res['brand_address'] ?>
            </p>
            <p class="text-white py-2"><b>Call</b> :
                <?php echo $brand_res['brand_mobile_1'] . ' / ' . $brand_res['brand_mobile_2'] ?>
            </p>
            <p class="text-white py-2"><b>Email</b> :
                <?php echo $brand_res['brand_email'] ?>
            </p>
            <p class="text-white py-2"><b>Website</b> : <a href="<?php echo $brand_res['brand_domain'] ?>"><?php echo $brand_res['brand_domain'] ?></a></p>

        </div>

    </div>

</div>