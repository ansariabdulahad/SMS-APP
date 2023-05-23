<?php

// require navbar
require_once('../php/nav.php');

echo '

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 px-4 p-2 mt-3 mb-3 bg-white shadow-lg rounded">

            <h5 class="mt-1 px-2 p-2">CREATE BRAND
                <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none brand-loader"></i>
                <i class="fa fa-edit float-end mt-1 brand-edit-btn" style="cursor: pointer;">&nbsp; EDIT BRAND</i>
            </h5>

            <hr>

            <form class="brand-form">

                <div class="form-group">
                    <label for="brand-name" class="fw-bold">Brand Name</label>
                    <input type="text" name="brand-name" id="brand-name"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Name">
                </div>

                <div class="form-group">
                    <label for="brand-logo" class="fw-bold">Choose Brand Logo</label>
                    <input type="file" name="brand-logo" id="brand-logo"
                        class="form-control mb-3 mt-1 shadow">
                </div>

                <div class="form-group">
                    <label for="brand-domain" class="fw-bold">Brand Domain</label>
                    <input type="text" name="brand-domain" id="brand-domain"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Domain">
                </div>

                <div class="form-group">
                    <label for="brand-email" class="fw-bold">Brand Email</label>
                    <input type="text" name="brand-email" id="brand-email"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Email">
                </div>

                <div class="form-group">
                    <label class="fw-bold">Social Handles</label>

                    <input type="url" name="brand-twitter" id="brand-twitter"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Twitter URL">

                    <input type="url" name="brand-facebook" id="brand-facebook"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Facebook URL">

                    <input type="url" name="brand-instagram" id="brand-instagram"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Instagram URL">

                    <input type="url" name="brand-whatsapp" id="brand-whatsapp"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Whatsapp URL">
                </div>

                <div class="form-group">
                    <label for="brand-address" class="fw-bold">Brand Address</label>
                    <textarea name="brand-address" id="brand-address" class="form-control mb-3 mt-1 shadow"
                        placeholder="Enter Brand Address"></textarea>
                </div>

                <div class="form-group">
                    <label for="brand-mobile" class="fw-bold">Brand Mobile Number</label>

                    <input type="tel" name="brand-mobile-1" id="brand-mobile-1"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Mobile Number 1">

                    <input type="tel" name="brand-mobile-2" id="brand-mobile-2"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Mobile Number 2">
                </div>

                <div class="form-group">
                    <label for="brand-about" class="fw-bold">About Us</label>
                    <textarea name="brand-about" id="brand-about" rows="10"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand About"></textarea>
                </div>

                <div class="form-group">
                    <label for="brand-privacy" class="fw-bold">Privacy Policy</label>
                    <textarea name="brand-privacy" id="brand-privacy" rows="10"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Privacy"></textarea>
                </div>

                <div class="form-group">
                    <label for="brand-cookie" class="fw-bold">Cookie Policy</label>
                    <textarea name="brand-cookie" id="brand-cookie" rows="10"
                        class="form-control mb-3 mt-1 shadow" placeholder="Enter Brand Cookie"></textarea>
                </div>

                <div class="form-group">
                    <label for="brand-terms" class="fw-bold">Terms & Conditions</label>
                    <textarea name="brand-terms" id="brand-terms" rows="10"
                        class="form-control mb-3 mt-1 shadow"
                        placeholder="Enter Brand Terms & Conditions"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary mb-3 mt-3 w-100 shadow float-end brand-btn">Add Brand
                    </button>
                </div>

            </form>

        </div>
        <div class="col-md-1"></div>
    </div>
</div>

';

?>