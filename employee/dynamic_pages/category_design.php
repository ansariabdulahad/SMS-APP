<?php

// require navbar
require_once('../php/nav.php');


echo '

<!-- FIRST ROW FOR MAIN PAGE -->
<div class="row p-4">

    <!-- CREATE CATEGORY CODING -->
    <div class="col-md-4 p-2 mt-2 bg-white shadow-lg rounded category-box">

        <h5 class="mt-1 px-2 p-1">CREATE CATEGORY
            <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none category_loader"></i>
        </h5>
        <hr>

        <form class="category-form">
            <input type="text" name="category" class="form-control mb-3 mt-3 shadow category"
                placeholder="Category Name">
            <textarea name="detail" class="form-control mb-3 mt-3 shadow details" placeholder="Details"></textarea>

            <div class="category-fields"></div>

            <div align="end">
                <button type="button" class="btn btn-primary mb-3 mt-3 shadow add-category-btn"><i class="fa fa-plus"></i> &nbsp; Add
                    Fields</button>
                <button type="submit" class="btn btn-danger mb-3 mt-3 shadow create-category-btn">Create</button>
            </div>
        </form>

    </div>

    <div class="col-md-1"></div>

    <!-- CREATE CATEGORY LIST CODING -->
    <div class="col-md-7 p-2 mt-2 bg-white shadow-lg rounded category-box">

        <h5 class="mt-1 px-2 p-1">CATEGORY LIST
            <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none category-list-loader"></i>
        </h5>

        <hr>

        <div class="table-responsive rounded shadow-lg mb-3">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th class="text-nowrap">Sr No</th>
                        <th class="text-nowrap">Category Name</th>
                        <th class="text-nowrap">Category Details</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                </thead>

                <tbody class="category-list">
                    
                    
                </tbody>

            </table>
        </div>

    </div>

</div>


';

?>