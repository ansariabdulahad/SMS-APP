<?php

// Page Main Navbar
// And JQuery Coding 
echo '
    <nav class="navbar navbar-expand-sm bg-white shadow-lg">

        <button class="btn shadow toggler navbar-btn"><i class="fa-solid fa-align-left"></i></button>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link">Testing</a>
            </li>
        </ul>
    </nav>

    
    <script>

        $(document).ready(function () {

            $(".toggler").click(function () {

                let position = $(".side-nav").hasClass("side-nav-open");

                if (position) {

                    $(".side-nav").removeClass("side-nav-open");
                    $(".side-nav").addClass("side-nav-close");

                    $(".page").removeClass("page-open");
                    $(".page").addClass("page-close");

                }
                else {

                    $(".side-nav").addClass("side-nav-open");
                    $(".side-nav").removeClass("side-nav-close");

                    $(".page").addClass("page-open");
                    $(".page").removeClass("page-close");

                }

            })

        });

    </script>

';

?>