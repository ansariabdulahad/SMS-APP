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
 * start category coding
 */

// craete category function coding
function createCategoryFunc() {

    $(document).ready(function () {

        // add category btn coding
        $(".add-category-btn").click(function () {

            let input_fields = `
            
            <input type="text" name="category" class="form-control mb-3 mt-3 shadow category"
            placeholder="Category Name">
            <textarea name="detail" class="form-control mb-3 mt-3 shadow details" placeholder="Details"></textarea>

            `;

            $(".category-fields").append(input_fields);
        });

        // create category btn coding
        $(".create-category-btn").click(function (e) {
            e.preventDefault();

            let categoryEl = $(".category");
            let detailsEl = $(".details");
            let i, category = [], details = [];

            for (i = 0; i < categoryEl.length; i++) {

                category[i] = categoryEl[i].value;
                details[i] = detailsEl[i].value;
            }

            // send category data to server
            $.ajax({
                type: "POST",
                url: "php/create_category.php",
                data: {
                    category: JSON.stringify(category),
                    details: JSON.stringify(details)
                },
                beforeSend: function () {
                    // remove category loading indicator
                    $('.category_loader').removeClass("d-none");
                },
                success: function (response) {

                    if (response.trim() == "success") {

                        // remove category loading indicator
                        $('.category_loader').addClass("d-none");
                        $(".category").val("");
                        $(".details").val("");

                        swal("Good Job!", "Category has been created successfully !", "success");

                        getCategory(); // calling...
                    }
                    else {
                        // remove category loading indicator
                        $('.category_loader').addClass("d-none");
                        swal(response.trim(), response.trim(), "error");
                    }

                }
            });
        });

    });

    // get category function coding
    async function getCategory() {

        let response = await ajaxGetAllData("category", "category-list-loader");
        // get category data from db
        let all_category = JSON.parse(response.trim());
        $(".category-list").html(""); // empty category list
        $(".category-list-loader").addClass("d-none");

        all_category.forEach((data, index) => {

            let tr = `

                <tr index="${data.id}">
                    <td>${index + 1}</td>
                    <td>${data.category_name}</td>
                    <td>${data.details}</td>
                    <td>
                        <button class="btn btn-primary edit-btn"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-success d-none save-btn"><i class="fa fa-save"></i></button>
                        <button class="btn btn-danger del-btn"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>

            `;

            $(".category-list").append(tr);
        });

        updateCategoryFunc(); // calling...
        deleteCategoryFunc(); // calling...

    }

    getCategory(); // calling...

    // update category function coding
    function updateCategoryFunc() {

        let allEditBtn = $(".category-list .edit-btn");

        $(allEditBtn).each(function () {
            $(this).click(function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr("index");
                let td = parent.querySelectorAll("td");
                let saveBtn = parent.querySelector(".save-btn");

                td[1].contentEditable = true;
                td[1].focus();
                td[2].contentEditable = true;
                td[2].focus();

                $(this).addClass("d-none");
                $(saveBtn).removeClass("d-none");
                $(saveBtn).click(function () {

                    let category = $(td[1]).html();
                    let details = $(td[2]).html();

                    $.ajax({
                        type: "POST",
                        url: "php/edit_category.php",
                        data: {
                            id: id,
                            category: category,
                            details: details
                        },
                        beforeSend: function () {
                            $(".category-list-loader").removeClass("d-none");
                        },
                        success: function (response) {

                            if (response.trim() === "success") {

                                $(".category-list-loader").addClass("d-none");
                                swal("success", "category data updated successfully", "success");

                                td[1].contentEditable = false;
                                td[2].contentEditable = false;

                                $(saveBtn).addClass("d-none");
                                $(allEditBtn).removeClass("d-none");
                            }
                            else {

                                $(".category-list-loader").addClass("d-none");
                                swal(response.trim(), response.trim(), "warning");
                            }
                        }
                    });
                })
            })
        })
    }

    // delete category function coding
    function deleteCategoryFunc() {

        let allDelBtn = $(".category-list .del-btn");

        $(allDelBtn).each(function () {
            $(this).click(async function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr("index");

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then(async (willDelete) => {
                        if (willDelete) {

                            let response = await ajaxDeleteById("category", id, "category-list-loader");

                            if (response.trim() === "success") {

                                parent.remove();
                                getCategory(); // calling ...
                            }
                            else {

                                swal("ERROR !", response.trim(), "error");
                            }

                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });


            })
        })
    }

}

/**
 * end category coding
 */



/**
 * Start Course Coding
 */

function createCourseFunc() {

    // Add course coding
    $(".course-form").submit(function (e) {

        e.preventDefault();

        var courseActiveEl = document.querySelector("#course-active");
        var status = '';

        courseActiveEl.checked == true ? status = 'active' : status = 'pending';

        var formData = new FormData(this);
        formData.append('status', status);

        $.ajax({
            type: "POST",
            url: "php/create_course.php",
            data: formData,
            processData: false,
            contentType: false,
            caches: false,
            beforeSend: function () {
                $('.course-loader').removeClass('d-none');
            },
            success: function (response) {

                $('.course-loader').addClass('d-none');
                if (response.trim() === 'success') {

                    swal("ADDED !", "Course Added Successfully !", "success");
                    let emptyForm = document.querySelector(".course-form");
                    emptyForm.reset();
                }
                else {
                    swal(response.trim(), response.trim(), 'warning');
                }
            }
        });
    });

    // get all course in table
    function getAllCourse() {

        $(".course-category").on("change", function () {

            if (this.value != "choose category") {

                $.ajax({
                    type: "POST",
                    url: "php/course_list.php",
                    data: {
                        category: this.value
                    },
                    beforeSend: function () {
                        $(".course-list-loader").removeClass("d-none");
                    },
                    success: function (response) {

                        $(".course-list-loader").addClass("d-none");
                        if (response.trim() != "There Is No Data") {

                            let allData = JSON.parse(response.trim());

                            // time and date coding
                            let i, all_time = [], all_date = [];

                            for (i = 0; i < allData.length; i++) {

                                let date = new Date(allData[0].added_date);
                                let dd = date.getDate();
                                let mm = date.getMonth() + 1;
                                let yy = date.getFullYear();

                                dd = dd < 10 ? "0" + dd : dd;
                                mm = mm < 10 ? "0" + mm : mm;

                                let time = date.toLocaleTimeString();
                                let final_date = dd + "-" + mm + "-" + yy;

                                all_date.push(final_date);
                                all_time.push(time);
                            }

                            $('.course-list').html('');
                            allData.forEach((data, index) => {

                                let tr = `
                                
                                    <tr index=${data.id}>
                                        <td class="text-nowrap">${index + 1}</td>
                                        <td class="text-nowrap">${data.category}</td>
                                        <td class="text-nowrap">${data.code}</td>
                                        <td class="text-nowrap">${data.name}</td>
                                        <td class="text-nowrap">${data.duration}</td>
                                        <td class="text-nowrap">${data.course_time}</td>
                                        <td class="text-nowrap">${data.fee}</td>
                                        <td class="text-nowrap">${data.course_fee_time}</td>
                                        <td class="text-nowrap">${data.status}</td>
                                        <td class="text-nowrap">DATE : ${all_date[index]} TIME : ${all_time[index]}</td>
                                        <td class="text-nowrap">${data.added_by}</td>
                                        <td class="text-nowrap">${data.detail}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-primary edit-btn"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger del-btn"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                `;

                                $(".course-list").append(tr);
                            });

                            deleteCourseFunc(); // calling...
                            updateCourseFunc(); // calling...
                        }
                        else {

                            $('.course-list').html('');
                            swal(response.trim(), response.trim(), "warning");
                        }
                    }
                });
            }
            else {

                $('.course-list').html('');
                swal("Category Error !", "Please select a category", "warning");
            }
        })
    }

    getAllCourse(); // get live data while inserting new course

    // delete course function coding
    function deleteCourseFunc() {

        let allDelBtn = $('.course-list .del-btn');

        $(allDelBtn).each(function () {

            $(this).click(async function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr('index');

                try {

                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then(async (willDelete) => {
                            if (willDelete) {

                                let response = await ajaxDeleteById("course", id, "course-list-loader"); // calling ...

                                if (response.trim() == "success") {

                                    parent.remove();
                                }
                                else {

                                    swal("WARNING !", response.trim(), "warning");
                                }

                                swal("Poof! Your data has been deleted!", {
                                    icon: "success",
                                });
                            } else {
                                swal("Your data is safe!");
                            }
                        });

                } catch (error) {

                    console.log(error);

                }

            })
        })
    }

    // update course function coding
    function updateCourseFunc() {

        let allEditBtn = $(".course-list .edit-btn");

        allEditBtn.each(function () {

            $(this).click(function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr("index");
                let allTd = parent.querySelectorAll("TD");
                let allInput = $(".course-form input");
                let selectEl = $(".course-form select");
                let textareaEl = $(".course-form textarea");
                let allButton = $(".course-form button");
                let status = allTd[8].innerHTML;

                status == "active" ? allInput[6].checked = true : allInput[6].checked = false;

                selectEl[0].value = allTd[1].innerHTML;
                allInput[0].value = allTd[2].innerHTML;
                allInput[1].value = allTd[3].innerHTML;
                allInput[2].value = allTd[4].innerHTML;
                selectEl[1].value = allTd[5].innerHTML;
                allInput[3].value = allTd[6].innerHTML;
                selectEl[2].value = allTd[7].innerHTML;
                textareaEl[0].value = allTd[11].innerHTML;
                allInput[5].value = allTd[10].innerHTML;

                allButton[0].classList.add("d-none");
                allButton[1].classList.remove("d-none");

                allButton[1].addEventListener("click", () => {

                    var status = allInput[6].checked == true ? status = 'active' : status = 'pending';

                    var form = document.querySelector(".course-form");
                    var formData = new FormData(form);
                    formData.append('status', status);
                    formData.append('id', id);

                    $.ajax({
                        type: "POST",
                        url: "php/update_course.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        caches: false,
                        beforeSend: function () {
                            $(".course-loader").removeClass("d-none");
                        },
                        success: function (response) {

                            $(".course-loader").addClass("d-none");

                            if (response.trim() === "success") {

                                swal(response.trim(), "Successfully Updated !", "success");
                                form.reset('');
                                allButton[0].classList.remove("d-none");
                                allButton[1].classList.add("d-none");

                            }
                            else {

                                swal(response.trim(), response.trim(), "warning");
                            }
                        }
                    });
                })
            })
        })
    }
}

/**
 * End Course Coding
 */



/**
 * Start Batch Coding
 */

function createBatchFunc() {

    // batch category on change function
    $("#select-batch-category").on("change", async function () {

        if (this.value != "choose category") {

            let response = await ajaxGetAllCourse("course", this.value, "batch-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_course = JSON.parse(response.trim());

                $("#batch-course").html('<option value="choose course">Choose Course</option>');

                all_course.forEach((course) => {

                    let option = `
                    
                    <option value="${course.name}">${course.name}</option>

                    `;

                    $("#batch-course").append(option);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#batch-course").html('<option value="choose course">Choose Course</option>');
            }

        }
        else {

            swal("Select Warning !", "Please select a category", "warning");
            $("#batch-course").html('<option value="choose course">Choose Course</option>');
        }
    });

    // batch form submission or add to db coding
    $(".batch-form").on("submit", function (e) {
        e.preventDefault();

        if ($("#batch-course").val() != "choose course") {

            let formData = new FormData(this);
            let activeEl = document.querySelector("#batch-active");
            let status = activeEl.checked == true ? 'active' : 'pending';

            formData.append("status", status);

            $.ajax({
                type: "POST",
                url: "php/create_batch.php",
                data: formData,
                processData: false,
                contentType: false,
                caches: false,
                beforeSend: function () {
                    $(".batch-loader").removeClass("d-none");
                },
                success: function (response) {

                    if (response.trim() == "success") {

                        swal("ADDED !", "Batch added successfully", "success");
                    }
                    else {

                        swal(response.trim(), response.trim(), "warning");
                    }
                }
            });

        }
        else {

            swal("SELECT ERROR !", "Please select a category", "warning");
        }
    });

    // get course coding
    $("#batch-list-category").on("change", async function () {

        if (this.value != "choose category") {

            let response = await ajaxGetAllCourse("course", this.value, "batch-list-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_course = JSON.parse(response.trim());

                $("#batch-list-course").html('<option value="choose course">Choose Course</option>');

                all_course.forEach((course) => {

                    let option = `
                    
                    <option value="${course.name}">${course.name}</option>

                    `;

                    $("#batch-list-course").append(option);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#batch-list-course").html('<option value="choose course">Choose Course</option>');
                $('.batch-list').html('');
            }

        }
        else {

            swal("Select Warning !", "Please select a category", "warning");
            $("#batch-list-course").html('<option value="choose course">Choose Course</option>');
            $('.batch-list').html('');
        }
    });

    // get all batches coding
    $("#batch-list-course").on("change", async function () {

        let response = await ajaxGetAllBatch("batch", $("#batch-list-category").val(), this.value, "batch-list-loader");

        if (response.trim() != "There Is No Data") {

            let allData = JSON.parse(response.trim());

            // time and date coding
            let i, all_time = [], all_date = [];

            for (i = 0; i < allData.length; i++) {

                let date = new Date(allData[0].added_date);
                let dd = date.getDate();
                let mm = date.getMonth() + 1;
                let yy = date.getFullYear();

                dd = dd < 10 ? "0" + dd : dd;
                mm = mm < 10 ? "0" + mm : mm;

                let time = date.toLocaleTimeString();
                let final_date = dd + "-" + mm + "-" + yy;

                all_date.push(final_date);
                all_time.push(time);
            }

            $('.batch-list').html('');
            allData.forEach((data, index) => {

                let tr = `
                                
                        <tr index=${data.id}>
                            <td class="text-nowrap">${index + 1}</td>
                            <td class="text-nowrap">${data.category}</td>
                            <td class="text-nowrap">${data.course}</td>
                            <td class="text-nowrap">${data.code}</td>
                            <td class="text-nowrap">${data.name}</td>
                            <td class="text-nowrap">${data.batch_from}</td>
                            <td class="text-nowrap">${data.batch_to}</td>
                            <td class="text-nowrap">${data.batch_from_date}</td>
                            <td class="text-nowrap">${data.batch_to_date}</td>
                            <td class="text-nowrap">${data.status}</td>
                            <td class="text-nowrap">DATE : ${all_date[index]} TIME : ${all_time[index]}</td>
                            <td class="text-nowrap">${data.added_by}</td>
                            <td class="text-nowrap">${data.detail}</td>
                            <td class="text-nowrap">
                                <button class="btn btn-primary edit-btn"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger del-btn"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                    `;

                $(".batch-list").append(tr);
            });

            deleteBatchFunc(); // calling...
            updateBatchFunc(); // calling...
        }
        else {

            $('.batch-list').html('');
            swal(response.trim(), response.trim(), "warning");
        }

    });

    // delete batch function coding
    function deleteBatchFunc() {

        let allDelBtn = $('.batch-list .del-btn');

        $(allDelBtn).each(function () {

            $(this).click(async function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr('index');

                try {

                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then(async (willDelete) => {
                            if (willDelete) {

                                let response = await ajaxDeleteById("batch", id, "batch-list-loader"); // calling ...

                                if (response.trim() == "success") {

                                    parent.remove();
                                }
                                else {

                                    swal("WARNING !", response.trim(), "warning");
                                }

                                swal("Poof! Your data has been deleted!", {
                                    icon: "success",
                                });
                            } else {
                                swal("Your data is safe!");
                            }
                        });

                } catch (error) {

                    console.log(error);

                }

            })
        })
    }

    // update batch function coding
    function updateBatchFunc() {

        let allEditBtn = $(".batch-list .edit-btn");

        allEditBtn.each(function () {

            $(this).click(function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr("index");
                let allTd = parent.querySelectorAll("TD");
                let allInput = $(".batch-form input");
                let selectEl = $(".batch-form select");
                let textareaEl = $(".batch-form textarea");
                let allButton = $(".batch-form button");
                let option = selectEl[1].querySelector("OPTION");

                let status = allTd[9].innerHTML;
                status == "active" ? allInput[8].checked = true : allInput[8].checked = false;

                selectEl[0].value = allTd[1].innerHTML;
                option.value = allTd[2].innerHTML;
                option.innerHTML = allTd[2].innerHTML;
                allInput[0].value = allTd[3].innerHTML;
                allInput[1].value = allTd[4].innerHTML;
                allInput[2].value = allTd[5].innerHTML;
                allInput[3].value = allTd[6].innerHTML;
                allInput[4].value = allTd[7].innerHTML;
                allInput[5].value = allTd[8].innerHTML;
                allInput[7].value = allTd[11].innerHTML;
                textareaEl[0].value = allTd[12].innerHTML;

                allButton[0].classList.add("d-none");
                allButton[1].classList.remove("d-none");

                allButton[1].addEventListener("click", () => {

                    if (selectEl[1].value != "choose course") {

                        var status = allInput[8].checked == true ? status = 'active' : status = 'pending';

                        var form = document.querySelector(".batch-form");
                        var formData = new FormData(form);
                        formData.append('status', status);
                        formData.append('id', id);

                        $.ajax({
                            type: "POST",
                            url: "php/update_batch.php",
                            data: formData,
                            processData: false,
                            contentType: false,
                            caches: false,
                            beforeSend: function () {
                                $(".batch-loader").removeClass("d-none");
                            },
                            success: function (response) {

                                $(".batch-loader").addClass("d-none");

                                if (response.trim() === "success") {

                                    swal(response.trim(), "Successfully Updated !", "success");
                                    form.reset('');
                                    option.innerHTML = '<option value="choose course">Choose Course</option>';
                                    allButton[0].classList.remove("d-none");
                                    allButton[1].classList.add("d-none");

                                }
                                else {

                                    swal(response.trim(), response.trim(), "warning");
                                }
                            }
                        });

                    }
                    else {

                        swal("SELECT WARNING !", "Please select a course first !", "warning");
                    }

                });
            })
        })
    }
}

/**
 * End Batch Coding
 */



/**
 *  Start Student Registration Coding 
 */

function createStudentFunc() {

    // get course coding
    $("#select-stu-category").on("change", async function () {

        if (this.value != "choose category") {

            let response = await ajaxGetAllCourse("course", this.value, "student-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_course = JSON.parse(response.trim());

                $("#stu-course").html('<option value="choose course">Choose Course</option>');

                all_course.forEach((course) => {

                    let option = `
                    
                    <option value="${course.name}">${course.name}</option>

                    `;

                    $("#stu-course").append(option);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#stu-course").html('<option value="choose course">Choose Course</option>');
            }
        }
    });

    // get all batches coding
    $("#stu-course").on("change", async function () {

        if (this.value != "choose course") {

            let response = await ajaxGetAllBatch("batch", $("#select-stu-category").val(), this.value, "student-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_course = JSON.parse(response.trim());

                $("#stu-batch").html('<option value="choose batch">Choose Batch</option>');

                all_course.forEach((batch) => {

                    let option = `
                    
                    <option value="${batch.name} (FROM : ${batch.batch_from} TO : ${batch.batch_to})">${batch.name} (FROM : ${batch.batch_from} TO : ${batch.batch_to})</option>

                    `;

                    $("#stu-batch").append(option);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#stu-batch").html('<option value="choose batch">Choose Batch</option>');
            }

        }
    });

    // get Fee from course coding
    $("#stu-course").on("change", async function () {

        if (this.value != "choose course") {

            let response = await ajaxGetAllCourseFee("course", $("#select-stu-category").val(), this.value, "student-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let data = JSON.parse(response.trim());

                $(".fee").val(data.fee);
                $(".fee-time").val(data.course_fee_time);
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#stu-batch").html('<option value="choose batch">Choose Batch</option>');
            }

        }
    });

    // adding students coding
    $(".student-form").on("submit", function (e) {
        e.preventDefault();

        if ($(".stu-batch").val() != "choose batch") {

            if ($(".month").val() != "choose month") {

                if ($(".gender").val() != "choose gender") {

                    let dd = $(".day").val();
                    let mm = $(".month").val();
                    let yy = $(".year").val();

                    let dob = dd + "-" + mm + "-" + yy;

                    let statusEl = document.querySelector("#stu-active");

                    let status = statusEl.checked == true ? "active" : "pending";

                    let formData = new FormData(this);
                    formData.append("status", status);
                    formData.append("dob", dob);

                    $.ajax({
                        type: "POST",
                        url: "php/create_student.php",
                        data: formData,
                        contentType: false,
                        processData: false,
                        caches: false,
                        beforeSend: function () {
                            $(".student-loader").removeClass("d-none");
                        },
                        success: function (response) {

                            $(".student-loader").addClass("d-none");

                            if (response.trim() === "success") {

                                swal("ADDED !", "Student Added successfully", "success");
                                document.querySelector(".student-form").reset();
                            }
                            else {

                                swal(response.trim(), response.trim(), "warning");
                            }
                        }
                    });

                }
                else {

                    swal("SELECT WARNING !", "Please select gender first", "warning");
                }

            }
            else {

                swal("SELECT WARNING !", "Please select month first", "warning");
            }

        }
        else {

            swal("SELECT WARNING !", "Please select batch first", "warning");
        }
    });

    // Start get student list

    // Choose category list coding
    $("#stu-list-category").on("change", async function () {

        if (this.value != "choose category") {

            let response = await ajaxGetAllCourse("course", this.value, "student-list-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_course = JSON.parse(response.trim());

                $("#stu-list-course").html('<option value="choose course">Choose Course</option>');

                all_course.forEach((course) => {

                    let option = `
                    
                    <option value="${course.name}">${course.name}</option>

                    `;

                    $("#stu-list-course").append(option);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#stu-list-batch").html('<option value="choose batch">Choose Batch</option>');
                $("#stu-list-course").html('<option value="choose course">Choose Course</option>');
                $(".student-list").html('');
            }
        }
    });

    // choose course list coding
    $("#stu-list-course").on("change", async function () {

        if (this.value != "choose course") {

            let response = await ajaxGetAllBatch("batch", $("#stu-list-category").val(), this.value, "student-list-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_course = JSON.parse(response.trim());

                $("#stu-list-batch").html('<option value="choose batch">Choose Batch</option>');

                all_course.forEach((batch) => {

                    let option = `
                    
                    <option value="${batch.name} (FROM : ${batch.batch_from} TO : ${batch.batch_to})">${batch.name} (FROM : ${batch.batch_from} TO : ${batch.batch_to})</option>

                    `;

                    $("#stu-list-batch").append(option);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#stu-list-batch").html('<option value="choose batch">Choose Batch</option>');
                $(".student-list").html('');
            }

        }
    });

    // choose batch list coding
    $("#stu-list-batch").on("change", async function () {

        if (this.value != "choose batch") {

            let response = await ajaxGetAllStudents("students", $("#stu-list-category").val(), this.value, "student-list-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_data = JSON.parse(response.trim());

                // time and date coding
                let i, all_time = [], all_date = [];

                for (i = 0; i < all_data.length; i++) {

                    let date = new Date(all_data[0].added_date);
                    let dd = date.getDate();
                    let mm = date.getMonth() + 1;
                    let yy = date.getFullYear();

                    dd = dd < 10 ? "0" + dd : dd;
                    mm = mm < 10 ? "0" + mm : mm;

                    let time = date.toLocaleTimeString();
                    let final_date = dd + "-" + mm + "-" + yy;

                    all_date.push(final_date);
                    all_time.push(time);
                }

                $(".student-list").html('');

                all_data.forEach((data, index) => {

                    let tr = `
                    
                        <tr index=${data.id}>
                            <td class="text-nowrap">${index + 1}</td>
                            <td class="text-nowrap">${data.category}</td>
                            <td class="text-nowrap">${data.course}</td>
                            <td class="text-nowrap">${data.batch}</td>
                            <td class="text-nowrap">${data.enrollment}</td>
                            <td class="text-nowrap">${data.name}</td>
                            <td class="text-nowrap">${data.father_name}</td>
                            <td class="text-nowrap">${data.mother_name}</td>
                            <td class="text-nowrap">${data.dob}</td>
                            <td class="text-nowrap">${data.gender}</td>
                            <td class="text-nowrap">${data.email}</td>
                            <td class="text-nowrap">${data.password}</td>
                            <td class="text-nowrap">${data.mobile}</td>
                            <td class="text-nowrap">${data.country}</td>
                            <td class="text-nowrap">${data.state}</td>
                            <td class="text-nowrap">${data.city}</td>
                            <td class="text-nowrap">${data.pincode}</td>
                            <td class="text-nowrap">${data.fee}</td>
                            <td class="text-nowrap">${data.fee_time}</td>
                            <td class="text-nowrap">${data.photo}</td>
                            <td class="text-nowrap">${data.signature}</td>
                            <td class="text-nowrap">${data.id_proof}</td>
                            <td class="text-nowrap">${data.status}</td>
                            <td class="text-nowrap">${data.added_by}</td>
                            <td class="text-nowrap">DATE : ${all_date[index]} TIME : ${all_time[index]}</td>
                            <td class="text-nowrap">
                                <button class="btn btn-primary edit-btn"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger del-btn"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                    `;

                    $(".student-list").append(tr);
                });

                deleteStudentFunc(); // calling...
                studentUpdateFunc(); // calling...
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $(".student-list").html('');
            }

        }
        else {

            $(".student-list").html('');
        }
    });

    // delete students function coding
    function deleteStudentFunc() {

        let allDelBtn = $('.student-list .del-btn');

        $(allDelBtn).each(function () {

            $(this).click(async function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr('index');

                try {

                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then(async (willDelete) => {
                            if (willDelete) {

                                let response = await ajaxDeleteById("students", id, "student-list-loader"); // calling ...

                                if (response.trim() == "success") {

                                    parent.remove();
                                }
                                else {

                                    swal("WARNING !", response.trim(), "warning");
                                }

                                swal("Poof! Your data has been deleted!", {
                                    icon: "success",
                                });
                            } else {
                                swal("Your data is safe!");
                            }
                        });

                } catch (error) {

                    console.log(error);

                }

            })
        })
    }

    // update student function coding
    function studentUpdateFunc() {

        let allEditBtn = $(".student-list .edit-btn");

        allEditBtn.each(function () {

            $(this).click(function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr("index");
                let allTd = parent.querySelectorAll("TD");
                let allInput = $(".student-form input");
                let allSelect = $(".student-form select");
                let option1 = allSelect[1].querySelector("OPTION");
                let option2 = allSelect[2].querySelector("OPTION");
                let allButton = $(".student-form button");

                allSelect[0].value = allTd[1].innerHTML;
                option1.value = allTd[2].innerHTML;
                option2.value = allTd[3].innerHTML;
                option1.innerHTML = allTd[2].innerHTML;
                option2.innerHTML = allTd[3].innerHTML;
                allInput[0].value = allTd[4].innerHTML;
                allInput[1].value = allTd[5].innerHTML;
                allInput[4].value = allTd[6].innerHTML;
                allInput[5].value = allTd[7].innerHTML;

                let dob = allTd[8].innerHTML.split('-');
                allInput[2].value = dob[0];
                allInput[3].value = dob[2];
                allSelect[3].value = dob[1];
                allSelect[4].value = allTd[9].innerHTML;
                allInput[6].value = allTd[10].innerHTML;
                allInput[7].value = allTd[11].innerHTML;
                allInput[8].value = allTd[12].innerHTML;
                allInput[9].value = allTd[13].innerHTML;
                allInput[10].value = allTd[14].innerHTML;
                allInput[11].value = allTd[15].innerHTML;
                allInput[12].value = allTd[16].innerHTML;
                allInput[13].value = allTd[17].innerHTML;
                allInput[14].value = allTd[18].innerHTML;

                let status = allTd[22].innerHTML;
                status == "active" ? allInput[15].checked = true : allInput[15].checked = false;

                allInput[16].value = allTd[23].innerHTML;

                allButton[0].classList.add("d-none");
                allButton[1].classList.remove("d-none");

                allButton[1].addEventListener("click", () => {

                    if (allSelect[2].value != "choose batch") {

                        let stuForm = document.querySelector(".student-form");
                        var status = allInput[15].checked == true ? status = 'active' : status = 'pending';
                        let dd = allInput[2].value;
                        let mm = allSelect[3].value;
                        let yy = allInput[3].value;
                        let dob = dd + "-" + mm + "-" + yy;


                        var formData = new FormData(stuForm);
                        formData.append('status', status);
                        formData.append('id', id);
                        formData.append("dob", dob);

                        $.ajax({
                            type: "POST",
                            url: "php/update_student.php",
                            data: formData,
                            processData: false,
                            contentType: false,
                            caches: false,
                            beforeSend: function () {
                                $(".student-loader").removeClass("d-none");
                            },
                            success: function (response) {

                                $(".student-loader").addClass("d-none");

                                if (response.trim() === "success") {

                                    swal(response.trim(), "Successfully Updated !", "success");
                                    stuForm.reset('');

                                    option1.innerHTML = '<option value="choose course">Choose Course</option>';
                                    option2.innerHTML = '<option value="choose batch">Choose Batch</option>';
                                    allButton[0].classList.remove("d-none");
                                    allButton[1].classList.add("d-none");

                                }
                                else {

                                    swal(response.trim(), response.trim(), "warning");
                                }
                            }
                        });

                    }
                    else {

                        swal("SELECT WARNING !", "Please select a batch first !", "warning");
                    }

                });
            })
        })
    }

    // check enrollment status coding
    $(".enrollment-el").on("input", async function () {

        try {

            let response = await ajaxGetColumnData("students", "enrollment", this.value, "student-loader");

            if (response.trim() == "not match") {

                $(".stu-add-btn").attr("disabled", false);
                $(".enroll-msg").html('');
            }
            else {

                $(".enroll-msg").html("This Enrollment " + response.trim());
                $(".stu-add-btn").attr("disabled", true);
            }

        } catch (error) {

            console.log(error);

        }
    });

    // check email status coding
    $(".email").on("input", async function () {

        try {

            let response = await ajaxGetColumnData("students", "email", this.value, "student-loader");

            if (response.trim() == "not match") {

                $(".stu-add-btn").attr("disabled", false);
                $(".email-msg").html('');
            }
            else {

                $(".email-msg").html("This Email " + response.trim());
                $(".stu-add-btn").attr("disabled", true);
            }

        } catch (error) {

            console.log(error);

        }
    })
}

/**
 *  End Student Registration Coding 
 */



/**
 * Start upload documentation coding 
 */

function createDocumentFunc() {

    // check enrollment status coding
    $("#stu-enrollment").on("input", async function () {

        try {

            let response = await ajaxGetColumnData("students", "enrollment", this.value, "document-loader");

            if (response.trim() != "not match") {

                $(".document-btn").attr("disabled", false);
                $(".enroll-doc-msg").html('');
            }
            else {

                $(".enroll-doc-msg").html("There Is No Enrollment");
                $(".document-btn").attr("disabled", true);
            }

        } catch (error) {

            console.log(error);

        }
    });

    // upload documentation coding
    $(".document-form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "php/upload_document.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            caches: false,
            beforeSend: function () {
                $(".document-loader").removeClass("d-none");
            },
            success: function (response) {

                $(".document-loader").addClass("d-none");

                if (response.trim() == "success") {

                    swal("UPLOADED !", "Document was successfully uploaded", "success");
                    document.querySelector(".document-form").reset();
                }
                else {

                    swal("WARNING !", response.trim(), "warning");
                }
            }
        });
    });
}

/**
 * End upload documentation coding 
 */



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
        const formData = new FormData(this);
        const date = new Date();
        let dd = date.getDate();
        let mm = date.getMonth() + 1;
        const yy = date.getFullYear();

        // use ternary operators to format date
        dd = dd < 10 ? "0" + dd : dd;
        mm = mm < 10 ? "0" + mm : mm;

        const final_date = dd + "-" + mm + "-" + yy;

        formData.append("paid_fee", total);
        formData.append("pending", pending);
        formData.append("date", final_date);

        $.ajax({
            type: "POST",
            url: "php/create_invoice.php",
            data: formData,
            contentType: false,
            processData: false,
            caches: false,
            beforeSend: function () {
                $(".invoice-loader").removeClass("d-none");
            },
            success: function (response) {

                $(".invoice-loader").addClass("d-none");

                if (response.trim() === "success") { // use strict comparison

                    swal("ADDED !", "Invoice added and downloaded successfully", "success");

                    // encode data to prevent errors in URL
                    const enrollment = encodeURIComponent(allInput[1].value);
                    const name = encodeURIComponent(allInput[2].value);
                    const category = encodeURIComponent(allInput[3].value);
                    const final_date = encodeURIComponent(allInput[7].value);
                    const course = encodeURIComponent(allInput[4].value);
                    const batch = encodeURIComponent(allInput[5].value);
                    const fee_time = encodeURIComponent(allInput[6].value);
                    const paid_fees = encodeURIComponent(total);
                    const pendings = encodeURIComponent(pending);
                    const recent = encodeURIComponent(allInput[8].value);

                    // use template literals for URL construction
                    window.location = `php/invoice.php?enrollment=${enrollment}&name=${name}&category=${category}&date=${final_date}&course=${course}&batch=${batch}&fee-time=${fee_time}&paid-fee=${paid_fees}&pending=${pendings}&recent=${recent}`;

                    invoice_form.reset(); // reset invoice form
                }
                else {

                    swal("FAILED !", response.trim(), "warning");
                }
            }
        });
    });


}

/**
 *  End Invoice Coding 
 */


/**
 * Start Branding Coding
 */


function createBrandFunc() {

    // GLOBAL VARIABLES
    let brandForm = document.querySelector(".brand-form");
    let allInput = brandForm.querySelectorAll("INPUT");
    let allTextarea = brandForm.querySelectorAll("TEXTAREA");
    let brandBtn = brandForm.querySelector("BUTTON");

    // BRAND FORM SUBMIT CODING
    $(document).ready(function () {
        $(".brand-form").on("submit", function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "php/create_brand.php",
                data: new FormData(this),
                contentType: false,
                processData: false,
                caches: false,
                beforeSend: function () {
                    $(".brand-loader").removeClass("d-none");
                },
                success: function (response) {

                    $(".brand-loader").addClass("d-none");

                    if (response.trim() === "success") {

                        swal("UPDATED !", "Data updated successfully", "success");

                        getBrandDataFunc(); // calling...
                    }
                    else {

                        swal("FAILED !", response.trim(), "warning");
                    }
                }
            });
        });
    });

    // GETBRANDDATA FUNCTION CODING
    function getBrandDataFunc() {

        $.ajax({
            type: "POST",
            url: "php/get_brand.php",
            caches: false,
            beforeSend: function () {
                $(".brand-loader").removeClass("d-none");
            },
            success: function (response) {

                $(".brand-loader").addClass("d-none");

                if (response.trim() != "There Is No Data !") {

                    let data = JSON.parse(response.trim());

                    allInput[0].value = data.brand_name;
                    allInput[2].value = data.brand_domain;
                    allInput[3].value = data.brand_email;
                    allInput[4].value = data.brand_twitter;
                    allInput[5].value = data.brand_facebook;
                    allInput[6].value = data.brand_instagram;
                    allInput[7].value = data.brand_whatsapp;
                    allTextarea[0].value = data.brand_address;
                    allInput[8].value = data.brand_mobile_1;
                    allInput[9].value = data.brand_mobile_2;
                    allTextarea[1].value = data.brand_about;
                    allTextarea[2].value = data.brand_privacy;
                    allTextarea[3].value = data.brand_cookie;
                    allTextarea[4].value = data.brand_terms;

                    // FOR LOOPS FOR DIABLE FIELDS
                    let i;

                    for (i = 0; i < allInput.length; i++) {
                        allInput[i].disabled = true;
                    }

                    for (i = 0; i < allTextarea.length; i++) {
                        allTextarea[i].disabled = true;
                    }

                    brandBtn.disabled = true;

                    // EDIT BTN CODING
                    $(".brand-edit-btn").removeClass("d-none");

                }
                else {

                    // EDIT BTN CODING
                    $(".brand-edit-btn").addClass("d-none");

                    // FOR LOOPS FOR DIABLE FIELDS
                    let i;

                    for (i = 0; i < allInput.length; i++) {
                        allInput[i].disabled = false;
                    }

                    for (i = 0; i < allTextarea.length; i++) {
                        allTextarea[i].disabled = false;
                    }

                    brandBtn.disabled = false;

                }

            }
        });
    }

    getBrandDataFunc(); // calling...

    // BRAND EDIT BTN CODING

    $(".brand-edit-btn").click(function () {

        // EDIT BTN CODING
        $(".brand-edit-btn").addClass("d-none");

        // FOR LOOPS FOR DIABLE FIELDS
        let i;

        for (i = 0; i < allInput.length; i++) {
            allInput[i].disabled = false;
        }

        for (i = 0; i < allTextarea.length; i++) {
            allTextarea[i].disabled = false;
        }

        brandBtn.disabled = false;
    })
}



/**
 * End Branding Coding
 */




/**
 * Start Attendance Coding
 */

function createAttendanceFunc() {

    // get course coding
    $("#att-category").on("change", async function () {

        if (this.value != "choose category") {

            let response = await ajaxGetAllCourse("course", this.value, "attendance-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_course = JSON.parse(response.trim());

                $("#att-course").html('<option value="choose course">Choose Course</option>');

                all_course.forEach((course) => {

                    let option = `
                    
                    <option value="${course.name}">${course.name}</option>

                    `;

                    $("#att-course").append(option);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#att-course").html('<option value="choose course">Choose Course</option>');
                $(".attendance-list").html('');
                $("#att-batch").html('<option value="choose batch">Choose Batch</option>');
                $(".attendance-btn").attr("disabled", true);
            }
        }
    });

    // get all batches coding
    $("#att-course").on("change", async function () {

        if (this.value != "choose course") {

            let response = await ajaxGetAllBatch("batch", $("#att-category").val(), this.value, "attendance-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_course = JSON.parse(response.trim());

                $("#att-batch").html('<option value="choose batch">Choose Batch</option>');

                all_course.forEach((batch) => {

                    let option = `
                    
                    <option value="${batch.name} (FROM : ${batch.batch_from} TO : ${batch.batch_to})">${batch.name} (FROM : ${batch.batch_from} TO : ${batch.batch_to})</option>

                    `;

                    $("#att-batch").append(option);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $("#att-batch").html('<option value="choose batch">Choose Batch</option>');
                $(".attendance-list").html('');
                $(".attendance-btn").attr("disabled", true);
            }

        }
    });

    // DATE FORMATING CODING

    let date = new Date();
    let dd = date.getDate();
    let mm = date.getMonth() + 1;
    let yy = date.getFullYear();

    dd = dd < 10 ? "0" + dd : dd;
    mm = mm < 10 ? "0" + mm : mm;

    let maxDate = yy + "-" + mm + "-" + dd;

    $(".date").attr("max", maxDate);

    // choose batch list coding
    $("#att-batch").on("change", async function () {

        if (this.value != "choose batch") {

            let response = await ajaxGetAllStudents("students", $("#att-category").val(), this.value, "attendance-loader"); // calling...

            if (response.trim() != "There Is No Data") {

                let all_data = JSON.parse(response.trim());

                $(".attendance-btn").attr("disabled", false);
                $(".attendance-list").html('');

                all_data.forEach((data, index) => {

                    let tr = `
                    
                        <tr index=${data.id}>
                            <td class="text-nowrap">${index + 1}</td>
                            <td class="text-nowrap enrollment">${data.enrollment}</td>
                            <td class="text-nowrap name">${data.name}</td>
                            <td class="text-nowrap batch">${data.batch}</td>
                            <td class="d-flex justify-content-around attendance">
                                <div>
                                    <input type="radio" name="attendence-${index + 1}" id="absent-${index + 1}" value="absent" checked>
                                    <label for="absent-${index + 1}">Absent</label>
                                </div>
                                <div>
                                    <input type="radio" name="attendence-${index + 1}" id="present-${index + 1}" value="present">
                                    <label for="present-${index + 1}">Present</label>
                                </div>
                            </td>
                        </tr>

                    `;

                    $(".attendance-list").append(tr);
                });
            }
            else {

                swal(response.trim(), response.trim(), "warning");
                $(".attendance-list").html('');
                $(".attendance-btn").attr("disabled", true);
            }

        }
        else {

            $(".attendance-list").html('');
            $(".attendance-btn").attr("disabled", true);
        }
    });

    // ATTENDANCE BTN SUBMIT CODING
    $(".attendance-btn").click(function (e) {
        e.preventDefault();

        let enrollment = [];
        let name = [];
        let batch = [];
        let attendance = [];

        if ($(".date").val() !== "") {

            let allEnrollEl = document.querySelectorAll(".enrollment");
            let allNameEl = document.querySelectorAll(".name");
            let allBatchEl = document.querySelectorAll(".batch");
            let attFormList = document.querySelector(".attendance-list");
            let allInput = attFormList.querySelectorAll("INPUT");

            let i;

            for (i = 0; i < allEnrollEl.length; i++) {

                enrollment[i] = allEnrollEl[i].innerHTML;
                name[i] = allNameEl[i].innerHTML;
                batch[i] = allBatchEl[i].innerHTML;
            }

            // FOR LOOP FOR ATTENDANCE CHECKING

            for (i = 0; i < allInput.length; i++) {

                if (allInput[i].checked === true) {

                    attendance[i] = allInput[i].value;
                }
            }

            // REMOVE ALL EMTY SPACE FROM THE ATTENDANCE ARRAY
            attendance = $.grep(attendance, n => n === 0 || n);

            // AJAX REQUESTING
            $.ajax({
                type: "POST",
                url: "php/create_attendance.php",
                data: {
                    name: JSON.stringify(name),
                    enrollment: JSON.stringify(enrollment),
                    batch: JSON.stringify(batch),
                    attendance: JSON.stringify(attendance),
                },
                caches: false,
                beforeSend: function () {
                    $(".attendance-loader").removeClass("d-none");
                },
                success: function (response) {

                    $(".attendance-loader").addClass("d-none");

                    if (response.trim() === "success") {

                        swal("ADDED !", "Attendance added successfully", "success");
                    }
                    else {

                        swal("FAILED !", response.trim(), "warning");
                    }
                }
            });

        }
        else {

            swal("SELECT WARNING !", "Please select a date !", "warning");
        }

    });
}

/**
 * End Attendance Coding
 */





/**
 * Start create access Coding
 */

function createAccessFunc() {

    // check email coding
    $(".email-el").on("input", async function () {

        try {

            let response = await ajaxGetColumnData("access", "email", this.value, "access-loader");

            if (response.trim() == "not match") {

                $(".access-btn").attr("disabled", false);
                $(".access-msg").html('');
            }
            else {

                $(".access-msg").html("This User " + response.trim());
                $(".access-btn").attr("disabled", true);
            }

        } catch (error) {

            console.log(error);

        }
    });

    // ACCESS FORM SUBMITION CODING
    $(".access-form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "php/create_access.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            caches: false,
            beforeSend: function () {
                $(".access-loader").removeClass("d-none");
            },
            success: function (response) {

                $(".access-loader").addClass("d-none");

                if (response.trim() === "success") {

                    swal("ADDED !", "Access has been added successfully", "success");

                    document.querySelector(".access-form").reset();
                    $(".access-btn").attr("disabled", true);

                    getAccessDataFunc(); // calling...

                }
                else {

                    swal("FAILED !", response.trim(), "warning");
                }
            }
        });
    });

    // GET ACCESS DATA FROM DATABASE
    async function getAccessDataFunc() {

        try {

            let response = await ajaxGetAllData("access", "access-loader");

            if (response.trim() !== "There are no categories") {

                let all_access = JSON.parse(response.trim());

                $(".access-list").html("");
                $(".access-loader").addClass("d-none");

                all_access.forEach((data, index) => {

                    let tr = `

                        <tr index="${data.id}">
                            <td>${index + 1}</td>
                            <td>${data.email}</td>
                            <td>${data.password}</td>
                            <td>
                                <button class="btn btn-danger del-btn"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                    `;

                    $(".access-list").append(tr);
                });

                deleteAccessFunc(); // calling...

            }
            else {

                swal("FAILED !", "There is no access data", "warning");
            }

        } catch (error) {

            console.log(error);
        }
    }

    getAccessDataFunc(); // calling...

    // delete access function coding
    function deleteAccessFunc() {

        let allDelBtn = $(".access-list .del-btn");

        $(allDelBtn).each(function () {
            $(this).click(async function () {

                let parent = this.parentElement.parentElement;
                let id = $(parent).attr("index");

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then(async (willDelete) => {
                        if (willDelete) {

                            let response = await ajaxDeleteById("access", id, "access-loader");

                            if (response.trim() === "success") {

                                parent.remove();
                                getAccessDataFunc(); // calling ...
                            }
                            else {

                                swal("ERROR !", response.trim(), "error");
                            }

                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });


            })
        })
    }
}

/**
 * End create access Coding
 */




/**
 * Start Header showcase Coding
 */


function createShowcaseFunc() {

    // TARGET CLASS CODING
    $(document).ready(function () {

        $(".target").each(function () {
            $(this).click(function (e) {

                let element = e.target;
                let in_number = $(element).index();

                sessionStorage.setItem("color_in_number", in_number); // set temporary color index number

                // EMPTY CSS PROPERTY
                let i;
                for (i = 0; i < $(".target").length; i++) {

                    $(".target").css({
                        border: "",
                        boxShadow: "",
                        padding: "",
                        width: ""
                    });
                }

                // ADD CSS TO THE CLICK EVENT
                $(this).css({
                    border: "5px solid red",
                    boxShadow: "0px 0px 3px grey",
                    padding: "2px",
                    width: "fit-content"
                });

                // REMOVE CSS ON DBLCLICK
                $(this).on("dblclick", function () {
                    for (i = 0; i < $(".target").length; i++) {

                        $(".target").css({
                            border: "",
                            boxShadow: "",
                            padding: "",
                            width: ""
                        });
                    }
                })

                // CHANGE COLOR CODING
                $(".color-selector").on("input", function () {

                    let color = this.value;
                    let in_number = Number(sessionStorage.getItem("color_in_number"));
                    let element = document.getElementsByClassName("target")[in_number];

                    element.style.color = color;
                });


                // FONT SIZE CODING
                $(".font-size").on("input", function () {

                    let size = this.value;
                    let in_number = Number(sessionStorage.getItem("color_in_number"));
                    let element = document.getElementsByClassName("target")[in_number];

                    element.style.fontSize = size + "%";
                });

            });
        });

    });

    // TITLE IMAGE CODING
    $(document).ready(function () {
        $("#title-image").on("change", function () {

            let file = this.files[0];

            if (file.size > 200000) {

                let url = URL.createObjectURL(file);
                let image = new Image();
                image.src = url;

                // IMAGE ONLOAD CODING
                image.onload = function () {
                    let o_width = image.width;
                    let o_height = image.height;

                    if (o_width !== 1920 && o_height !== 978) {

                        image.style.width = "100%";
                        image.style.position = "absolute";
                        image.style.top = "0px";
                        image.style.left = "0px";
                        $(".showcase-preview").append(image);
                    }
                    else {

                        alert("FAILED !");
                    }
                }
            }
            else {

                swal("FAILED !", "Please Upload less than 200kb image !", "warning");
            }
        })
    });

    // TITLE TEXT LIMIT CODING
    $(document).ready(function () {
        $("#title-text").on("input", function () {

            let length = this.value.length;

            $(".showcase-title").html(this.value);
            $(".title-limit").html(" " + length);
        })
    });

    // SUBTITLE TEXT LIMIT CODING
    $(document).ready(function () {
        $("#subtitle-text").on("input", function () {

            let length = this.value.length;

            $(".showcase-subtitle").html(this.value);
            $(".subtitle-limit").html(" " + length);
        })
    });

    // ADD SHOWCASE FORM DATA TO DB
    $(".showcase-form").submit(function (e) {
        e.preventDefault();

        let title = document.querySelector(".showcase-title");
        let subtitle = document.querySelector(".showcase-subtitle");
        // let file = document.querySelector("#title-image").files[0];

        // GETTING TITLE COLOR AND FONTSIZE
        let title_size = "";
        let title_color = "";

        // CHECK FOR FONTSIZE
        if (title.style.fontSize == '') {

            title_size = "300%";
        }
        else {

            title_size = title.style.fontSize;
        }

        // CHECK FOR COLOR
        if (title.style.color == '') {

            title_color = "black";
        }
        else {

            title_color = title.style.color;
        }

        // GETTING SUBTITLE COLOR AND FONTSIZE
        let subtitle_size = "";
        let subtitle_color = "";

        // CHECK FOR FONTSIZE
        if (subtitle.style.fontSize == '') {

            subtitle_size = "300%";
        }
        else {

            subtitle_size = subtitle.style.fontSize;
        }

        // CHECK FOR COLOR
        if (subtitle.style.color == '') {

            subtitle_color = "black";
        }
        else {

            subtitle_color = subtitle.style.color;
        }

        // GETTING ALIGNMENT VALUE
        let flex_box = document.querySelector(".showcase-preview");
        let h_align = '';
        let v_align = '';

        // CHECK FOR JUSTIFYCONTENT
        if (flex_box.style.justifyContent == '') {

            h_align = 'flex-start';
        }
        else {

            h_align = flex_box.style.justifyContent;
        }

        // CHECK FOR ALIGNITEMS
        if (flex_box.style.alignItems == '') {

            v_align = 'flex-start';
        }
        else {

            v_align = flex_box.style.alignItems;
        }

        // css object
        let css_data = {
            title_size: title_size,
            title_color: title_color,
            subtitle_size: subtitle_size,
            subtitle_color: subtitle_color,
            h_align: h_align,
            v_align: v_align,
            title_text: title.innerHTML,
            subtitle_text: subtitle.innerHTML,
            buttons: $(".title-buttons").html().trim(),
            option: $("#edit-title").val().trim(),
        }

        let formData = new FormData(this);
        formData.append("css_data", JSON.stringify(css_data));
        // formData.append("file_data", file);

        $.ajax({
            type: "POST",
            url: "php/create_showcase.php",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {

            },
            success: function (response) {

                if (response.trim() === "success") {

                    swal("ADDED !", "Showcase has been added successfully", "success");
                }
                else if (response.trim() === "edit success") {

                    swal("UPDATED !", "Edit has been updated successfully", "success");
                }
                else {

                    swal("FAILED !", response.trim(), "warning");
                }
            }
        });
    });

    // ADD BUTTONS CODING
    $(document).ready(function () {
        $(".add-btn").click(function (e) {
            e.preventDefault();

            let button = document.createElement("BUTTON");
            button.className = "btn mx-2 title-btn";
            let a = document.createElement("A");
            a.href = $(".btn-url").val();
            a.innerHTML = $(".btn-name").val();
            a.style.color = $(".btn-textcolor").val();
            a.style.fontSize = $(".font-size").val();
            a.style.textDecoration = "none";
            button.style.backgroundColor = $(".btn-bgcolor").val();

            button.append(a);

            let title_button = document.querySelector(".title-buttons");
            let title_child = title_button.getElementsByTagName("BUTTON");
            let button_length = title_child.length;

            if (button_length == 0 || button_length == 1) {

                $(".title-buttons").append(button);

            }
            else {

                swal("FAILED !", "Only two buttons are allowed", "warning");
            }
        });
    });

    // ALIGNMENT CONTROL CODING
    $(document).ready(function () {
        $(".alignment").each(function () {
            $(this).click(function () {

                let align_position = $(this).attr("align-position");
                let align_value = $(this).attr("align-value");

                if (align_position == "h") {

                    $(".showcase-preview").css({
                        justifyContent: align_value
                    });
                }
                else if (align_position == "v") {

                    $(".showcase-preview").css({
                        alignItems: align_value
                    });
                }

            });
        });
    });

    // REAL PREVIEW CODING
    $(document).ready(function () {
        $(".preview-btn").click(function () {

            let file = document.querySelector("#title-image").files[0];

            // GETTING ALIGNMENT VALUE
            let flex_box = document.querySelector(".showcase-preview");
            let h_align = '';
            let v_align = '';

            // CHECK FOR JUSTIFYCONTENT
            if (flex_box.style.justifyContent == '') {

                h_align = 'flex-start';
            }
            else {

                h_align = flex_box.style.justifyContent;
            }

            // CHECK FOR ALIGNITEMS
            if (flex_box.style.alignItems == '') {

                v_align = 'flex-start';
            }
            else {

                v_align = flex_box.style.alignItems;
            }

            let array = [$(".title-box").html().trim(), h_align, v_align];

            let formData = new FormData();

            formData.append("photo", file);
            formData.append("data", JSON.stringify(array));

            $.ajax({
                type: "POST",
                url: "php/preview.php",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {

                },
                success: function (response) {

                    let page = window.open("about:blank");

                    page.document.open();
                    page.document.write(response);
                    page.document.close();
                }
            });

        });
    });

    // edit-title CODING
    $(document).ready(function () {

        let showcase_preview = $(".showcase-preview").html();

        $("#edit-title").on("change", function () {
            if ($(this).val() !== "choose title") {

                $.ajax({
                    type: "POST",
                    url: "php/get_showcase.php",
                    data: {
                        id: $(this).val()
                    },
                    beforeSend: function () {

                    },
                    success: function (response) {

                        $("#title-image").removeAttr("required");
                        $(".add-showcase-btn").html("Save Edit");
                        $(".add-showcase-btn").removeClass("btn-primary");
                        $(".add-showcase-btn").addClass("btn-warning");
                        $(".delete-title").removeClass("d-none");

                        let all_data = JSON.parse(response.trim());
                        let image = document.createElement("img");

                        image.src = all_data[0];
                        image.style.width = "100%";
                        image.style.position = "absolute";
                        image.style.top = "0";
                        image.style.left = "0";

                        $(".showcase-preview").append(image);

                        $(".showcase-title").html(all_data[1]);
                        $(".showcase-title").css({
                            color: all_data[2],
                            fontSize: all_data[3]
                        });

                        $(".showcase-subtitle").html(all_data[4]);
                        $(".showcase-subtitle").css({
                            color: all_data[5],
                            fontSize: all_data[6]
                        });

                        $(".title-buttons").html(all_data[9]);

                        $("#title-text").val(all_data[1]);
                        $("#subtitle-text").val(all_data[4]);

                        $(".delete-title").click(function () {
                            $.ajax({
                                type: "POST",
                                url: "php/delete_showcase.php",
                                data: {
                                    id: $("#edit-title").val(),
                                },
                                beforeSend: function () {

                                },
                                success: function (response) {

                                    if (response.trim() === "success") {

                                        swal({
                                            title: "Are you sure?",
                                            text: "Once deleted, you will not be able to recover this imaginary file!",
                                            icon: "warning",
                                            buttons: true,
                                            dangerMode: true,
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {

                                                    let selected_value = $("#edit-title").val();

                                                    $(".add-showcase-btn").html("Add Showcase");
                                                    $(".add-showcase-btn").removeClass("btn-warning");
                                                    $(".add-showcase-btn").addClass("btn-primary");
                                                    $(".delete-title").addClass("d-none");

                                                    $(".showcase-form").trigger('reset');
                                                    $(".showcase-preview").html(showcase_preview);

                                                    let op = $("#edit-title option");
                                                    op[0].selected = "selected";
                                                    let i;

                                                    for (i = 0; i < op.length; i++) {

                                                        if (op[i].value == selected_value) {
                                                            op[i].remove();
                                                        }
                                                    }

                                                    swal("Poof! Your imaginary file has been deleted!", {
                                                        icon: "success",
                                                    });
                                                } else {
                                                    swal("Your imaginary file is safe!");
                                                }
                                            });

                                    }
                                    else {

                                        swal("FAILED !", response.trim(), "warning");
                                    }
                                }
                            });
                        });

                        // EDIT BTN CODING
                        $(".title-btn").each(function () {
                            $(this).click(function (e) {
                                e.preventDefault();

                                $(".delete-btn").removeClass("d-none");

                                sessionStorage.setItem("btn_key", $(this).index());

                                let url = $(this).children().attr("href");
                                let name = $(this).children().html();

                                $(".btn-url").val(url);
                                $(".btn-name").val(name);

                                let color = $(this).css("backgroundColor").replace("rgb(", "").replace(")", "");
                                let rgb = color.split(",");
                                let i, color_code = "";

                                for (i = 0; i < rgb.length; i++) {
                                    let hex_code = Number(rgb[i]).toString(16);
                                    color_code += hex_code.length == 1 ? "0" + hex_code : hex_code;
                                }

                                $(".btn-bgcolor").val("#" + color_code);

                                let text_color = $(this).children().css("color").replace("rgb(", "").replace(")", "");
                                let text_rgb = text_color.split(",");
                                let text_color_code = "";

                                for (i = 0; i < text_rgb.length; i++) {
                                    let text_hex_code = Number(text_rgb[i]).toString(16);
                                    text_color_code += text_hex_code.length == 1 ? "0" + text_hex_code : text_hex_code;
                                }

                                $(".btn-textcolor").val("#" + text_color_code);

                                let font_size = $(this).children().css("font-size");
                                $(".font-size").val(font_size);
                            })
                        });

                        $(".btn-name").on("input", function () {

                            let i_no = sessionStorage.getItem("btn_key");
                            let selected_btn = document.getElementsByClassName("title-btn")[i_no];
                            selected_btn.getElementsByTagName("A")[0].innerHTML = this.value;
                        });

                        $(".btn-bgcolor").on("input", function () {

                            let i_no = sessionStorage.getItem("btn_key");
                            let selected_btn = document.getElementsByClassName("title-btn")[i_no];
                            selected_btn.style.backgroundColor = this.value;
                        });

                        $(".btn-textcolor").on("input", function () {

                            let i_no = sessionStorage.getItem("btn_key");
                            let selected_btn = document.getElementsByClassName("title-btn")[i_no];
                            selected_btn.getElementsByTagName("A")[0].style.color = this.value;
                        });

                        $(".font-size").on("change", function () {

                            let i_no = sessionStorage.getItem("btn_key");
                            let selected_btn = document.getElementsByClassName("title-btn")[i_no];
                            selected_btn.getElementsByTagName("A")[0].style.fontSize = this.value;
                        });

                        $(".delete-btn").on("click", function () {

                            let i_no = sessionStorage.getItem("btn_key");
                            let selected_btn = document.getElementsByClassName("title-btn")[i_no];

                            selected_btn.remove();
                            $(".delete-btn").addClass("d-none");
                            $(".btn-url, .btn-name").val("");
                            $(".btn-bgcolor, .btn-textcolor").val("#000000");

                            let op = $(".font-size option");
                            op[0].selected = "selected";
                        });
                    }
                });

            }
            else {

                $("#title-image").attr("required", true);
                $(".add-showcase-btn").html("Add Showcase");
                $(".add-showcase-btn").removeClass("btn-warning");
                $(".add-showcase-btn").addClass("btn-primary");
                $(".delete-title").addClass("d-none");

                $(".showcase-form").trigger('reset');
                $(".showcase-preview").html(showcase_preview);
            }
        })
    });

}


/**
 * End Header showcase Coding
 */




// common ajax functionality for all

// ajaxGetAllData function coding
function ajaxGetAllData(table, loader) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: "php/get_data_by_table.php",
            data: {
                table: table,
            },
            beforeSend: function () {
                $("." + loader).removeClass("d-none");
            },
            success: function (response) {

                $("." + loader).addClass("d-none");
                resolve(response);
            }
        });
    })
}

// ajaxDeleteById function coding 
function ajaxDeleteById(table, id, loader) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: "php/delete_by_id.php",
            data: {
                id: id,
                table: table,
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

// ajaxGetAllCourse function coding 
function ajaxGetAllCourse(table, category, loader) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: "php/get_all_course.php",
            data: {
                table: table,
                category: category,
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

// ajaxGetAllBatch function coding 
function ajaxGetAllBatch(table, category, course, loader) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: "php/get_all_batch.php",
            data: {
                table: table,
                category: category,
                course: course,
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

// ajaxGetAllCourseFee function coding 
function ajaxGetAllCourseFee(table, category, course, loader) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: "php/get_all_course_fee.php",
            data: {
                table: table,
                category: category,
                course: course,
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

// ajaxGetAllStudents function coding 
function ajaxGetAllStudents(table, category, batch, loader) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: "php/get_all_students.php",
            data: {
                table: table,
                category: category,
                batch: batch,
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

// ajaxGetColumnData function coding 
function ajaxGetColumnData(table, column, data, loader) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "POST",
            url: "php/get_column_data.php",
            data: {
                table: table,
                column: column,
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