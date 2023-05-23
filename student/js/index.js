// SIDE NAV BTN TOGGLE CODING
($(document).ready(function () {

    // side nav homepage update btn coding
    $(".homepage-update-btn").click(function () {
        $(".homepage-menu").toggle("toggle");
    });

    // side nav institute update btn coding
    $(".institute-update-btn").click(function () {
        $(".institute-update-menu").toggle("toggle");
    });

}));

// dynamic request of pages
$(document).ready(function () {

    let active_link = $('.active').attr('access-link');

    // call back function of dynamic request
    dynamic_request(active_link);

    $('.collapse-item').each(function () {
        $(this).click(function () {

            let request_link = $(this).attr("access-link");

            // call back function of dynamic request
            dynamic_request(request_link);

        });
    });
});

// dynamic request function coding
function dynamic_request(request_link) {

    $.ajax({
        type: "POST",
        url: request_link,
        // xhr --> xml http response
        xhr: function () {

            let request = new XMLHttpRequest();
            request.onprogress = function (event) {
                let percentage = Math.floor((event.loaded * 100 / event.total));
                let progress = `
                    <div class="progress shadow-lg" role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: ${percentage}% ">
                        </div >
                    </div >
                    `;

                $(".page").html(progress);
            }

            return request;
        },
        beforeSend: function () {

            // progress bar 
            let progress = `
                    <div div class="progress" role = "progressbar" aria - label="Animated striped example" aria - valuenow="75"
                        aria - valuemin="0" aria - valuemax="100" >
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 70%">
                            <span class="fw-bolder text-black">75%</span>
                        </div>
                    </div >
                `;

            $(".page").html(progress);

        },
        success: function (response) {

            $('.page').html(response);

            if (request_link == 'dynamic_pages/category_design.php') {

                // call back function --> createCategoryFunc
                createCategoryFunc();
            }
            else if (request_link == 'dynamic_pages/course_design.php') {

                // call back function --> createCourseFunc
                createCourseFunc();
            }
            else if (request_link == 'dynamic_pages/batch_design.php') {

                // call back function --> createBatchFunc
                createBatchFunc();
            }
            else if (request_link == 'dynamic_pages/student_design.php') {

                // call back function --> createStudentFunc
                createStudentFunc();
            }
            else if (request_link == 'dynamic_pages/document_design.php') {

                // call back function --> createDocumentFunc
                createDocumentFunc();
            }
            else if (request_link == 'dynamic_pages/invoice_design.php') {

                // call back function --> createInvoiceFunc
                createInvoiceFunc();
            }
            else if (request_link == 'dynamic_pages/brand_design.php') {

                // call back function --> createInvoiceFunc
                createBrandFunc();
            }
            else if (request_link == 'dynamic_pages/attendance_design.php') {

                // call back function --> createAttendanceFunc
                createAttendanceFunc();
            }
            else if (request_link == 'dynamic_pages/access_design.php') {

                // call back function --> createAccessFunc
                createAccessFunc();
            }
            else if (request_link == 'dynamic_pages/showcase_design.php') {

                // call back function --> createShowcaseFunc
                createShowcaseFunc();
            }

        }
    });

}

// active side bar tab
$(document).ready(function () {

    $('.collapse-item').each(function () {

        $(this).click(function () {
            $('.collapse-item').each(function () {
                $(this).removeClass('active');
            });

            $(this).addClass('active');
        });
    });
});



/**
 *  Start Invoice Coding 
 */

function createInvoiceFunc() {

    // common variables
    let invoice_form = document.querySelector(".invoice-form");
    let allInput = invoice_form.querySelectorAll("INPUT");
    let allSpan = invoice_form.querySelectorAll(".total-fee");

    // check enrollment status coding
    $("#invoice-enrollment").on("input", async function () {

        try {

            let response = await ajaxGetEnrollmentData("students", this.value, "invoice-loader");

            if (response.trim() != "not match") {

                $(".invoice-btn").attr("disabled", false);
                $(".invoice-msg").html('');

                let data = JSON.parse(response.trim());

                allInput[1].value = data.enrollment;
                allInput[2].value = data.name;
                allInput[3].value = data.category;
                allInput[4].value = data.course;
                allInput[5].value = data.batch;

                allSpan[0].innerHTML = data.fee;
                allSpan[1].innerHTML = data.paid_fee;

                allInput[6].value = data.fee_time;

                let pending_fee = data.fee - data.paid_fee;

                allInput[7].value = pending_fee;

            }
            else {

                $(".invoice-msg").html("There Is No Enrollment");
                $(".invoice-btn").attr("disabled", true);
            }

        } catch (error) {

            console.log(error);

        }
    });

    let total = 0;
    let pending = 0;
    let p = Number(allInput[7].value);

    // recent_paid input field coding
    $(".recent-paid").on("input", function () {

        let paid = +allSpan[1].innerHTML;
        let recent = Number(this.value);

        total = paid + recent;
        pending = recent - p;
        allInput[7].value = pending;
    });

    // invoice form submission coding
    $(invoice_form).submit(function (e) {
        e.preventDefault();

        // declare variables using let or const
        const date = new Date();
        let dd = date.getDate();
        let mm = date.getMonth() + 1;
        const yy = date.getFullYear();

        // use ternary operators to format date
        dd = dd < 10 ? "0" + dd : dd;
        mm = mm < 10 ? "0" + mm : mm;

        const final_date = dd + "-" + mm + "-" + yy;


        let enrollment = $(".inv-enroll").val();
        let name = $(".inv-name").val();
        let category = $(".inv-category").val();
        let course = $(".inv-course").val();
        let batch = $(".inv-batch").val();
        let fee_time = $(".inv-time").val();
        let recent = $(".inv-recent").val();

        window.location = "../pay/pay.php?enrollment=" + enrollment + "&name=" + name + "&category=" + category +
            "&course=" + course + "&batch=" + batch + "&fee_time=" + fee_time + "&recent=" + recent + "&total=" + total +
            "&pending=" + pending + "&date=" + final_date;

        // $.ajax({
        //     type: "POST",
        //     url: "php/create_invoice.php",
        //     data: formData,
        //     contentType: false,
        //     processData: false,
        //     caches: false,
        //     beforeSend: function () {
        //         $(".invoice-loader").removeClass("d-none");
        //     },
        //     success: function (response) {

        //         $(".invoice-loader").addClass("d-none");

        //         if (response.trim() === "success") { // use strict comparison

        //             swal("ADDED !", "Invoice added and downloaded successfully", "success");

        //             // encode data to prevent errors in URL
        //             const enrollment = encodeURIComponent(allInput[1].value);
        //             const name = encodeURIComponent(allInput[2].value);
        //             const category = encodeURIComponent(allInput[3].value);
        //             const final_date = encodeURIComponent(allInput[7].value);
        //             const course = encodeURIComponent(allInput[4].value);
        //             const batch = encodeURIComponent(allInput[5].value);
        //             const fee_time = encodeURIComponent(allInput[6].value);
        //             const paid_fees = encodeURIComponent(total);
        //             const pendings = encodeURIComponent(pending);
        //             const recent = encodeURIComponent(allInput[8].value);

        //             // use template literals for URL construction
        //             window.location = `php/invoice.php?enrollment=${enrollment}&name=${name}&category=${category}&date=${final_date}&course=${course}&batch=${batch}&fee-time=${fee_time}&paid-fee=${paid_fees}&pending=${pendings}&recent=${recent}`;

        //             invoice_form.reset(); // reset invoice form
        //         }
        //         else {

        //             swal("FAILED !", response.trim(), "warning");
        //         }
        //     }
        // });
    });


}

/**
 *  End Invoice Coding 
 */




// start ajax coding

// ajaxGetEnrollmentData function coding 
function ajaxGetEnrollmentData(table, data, loader) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: "php/get_enrollment_data.php",
            data: {
                table: table,
                user_data: data,
            },
            beforeSend: function () {
                $("." + loader).removeClass("d-none");
            },
            success: function (response) {

                resolve(response);
                $("." + loader).addClass("d-none");
            }
        });
    })
}