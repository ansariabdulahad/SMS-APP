// LOGIN BTN CODING

$(document).ready(function () {

    $(".login-btn").click(function () {

        let userEl = document.querySelectorAll(".user");
        let i, user = '';

        for (i = 0; i < userEl.length; i++) {

            if (userEl[i].checked === true) {

                user = userEl[i].value;
            }
        }

        $.ajax({
            type: "POST",
            url: "pages/login.php",
            data: {
                email: $("#username").val(),
                password: $("#password").val(),
                user: user
            },
            beforeSend: function () {
                $(".login-loader").removeClass("d-none");
                $(".login-btn").html("Wait...");
                $(".login-btn").attr("disabled", true);
            },
            success: function (response) {

                $(".login-loader").addClass("d-none");
                $(".login-btn").html("Login Now");
                $(".login-btn").attr("disabled", false);

                if (response.trim() === "admin login") {

                    window.location = "employee/index.php";
                }
                else if (response.trim() === "student login") {

                    window.location = "student/index.php";
                }
                else {

                    swal(response.trim(), response.trim(), "warning");
                }
            }
        });

    });
});