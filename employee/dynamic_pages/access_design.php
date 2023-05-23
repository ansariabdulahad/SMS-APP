<?php

// require navbar
require_once('../php/nav.php');

echo '

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 px-4 p-2 mt-3 mb-3 bg-white shadow-lg rounded">

            <h5 class="mt-1 px-2 p-1">GIVE ACCESS TO ADMINS
                <i class="fa-solid fa-circle-notch fa-spin float-end mt-1 d-none access-loader"></i>
            </h5>

            <hr>

            <form class="access-form mt-3">

                <input type="email" name="username" class="form-control mb-1 mt-1 shadow email-el" placeholder="Username" required>
                <span class="mb-1 text-danger access-msg"></span>
                <input type="password" name="password" class="form-control mb-3 mt-3 shadow" placeholder="Password" required>

                <button type="submit" class="btn btn-primary mb-3 mt-2 shadow float-end access-btn" disabled>Give Access</button>

            </form>

            <div class="table-responsive rounded shadow-lg mb-3 w-100">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Sr No</th>
                            <th class="text-nowrap">Username</th>
                            <th class="text-nowrap">Password</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>

                    <tbody class="access-list">
                    
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>

';

?>