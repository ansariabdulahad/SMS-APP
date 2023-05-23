<?php

// require navbar
require_once('../php/nav.php');
require_once("../../common_files/php/database.php");

echo '

<div class="container-fluid p-4">
    <div class="row">

        <div class="col-md-4 p-4 bg-white rounded shadow-lg showcase-box">

            <form class="showcase-form">
                <div class="form-group mb-3">

                    <label for="title-image" class="fw-bold mb-1">Title Image </label>
                    <small class="text-danger">200kb (1920*978)</small>
                    <input type="file" name="title-image" id="title-image" class="form-control shadow-lg"
                        required>

                </div>

                <div class="form-group mb-3">

                    <label for="title-text" class="fw-bold mb-1">Title Text</label><small
                        class="text-danger title-limit"> 0</small><small class="text-danger">/40</small>
                    <textarea name="title-text" id="title-text" rows="1" maxlength="40"
                        class="form-control shadow-lg" placeholder="Enter Title Here..."></textarea>

                </div>

                <div class="form-group mb-3">

                    <label for="subtitle-text" class="fw-bold mb-1">Sub-Title Text</label><small
                        class="text-danger subtitle-limit"> 0</small><small class="text-danger">/100</small>
                    <textarea name="subtitle-text" id="subtitle-text" rows="5" maxlength="100"
                        class="form-control shadow-lg" placeholder="Enter Sub-Title Here..."></textarea>

                </div>

                <div class="form-group mb-3">

                    <label for="create-button" class="fw-bold mb-1">Create Buttons</label>
                    <i class="fa fa-trash float-end shadow-lg text-danger btn d-none delete-btn"></i>

                    <div class="input-group mb-3">
                        <input type="url" name="btn-url" class="form-control shadow-lg btn-url"
                            placeholder="http://www.google.com">

                        <input type="text" name="btn-name" class="form-control shadow-lg btn-name"
                            placeholder="Button 1">
                    </div>

                </div>

                <div class="input-group mb-3">

                    <div class="input-group mb-3">
                        <span class="fw-bold input-group-text">BG COLOR</span>
                        <input type="color" name="btn-bgcolor"
                            class="form-control-color rounded shadow-lg w-50 btn-bgcolor">
                    </div>

                    <div class="input-group">
                        <span class="fw-bold input-group-text">TEXT COLOR</span>
                        <input type="color" name="btn-textcolor"
                            class="form-control-color rounded shadow-lg w-50 btn-textcolor">
                    </div>

                </div>

                <div class="input-group mb-3">

                    <span class="input-group-text fw-bold">SIZE</span>
                    <select name="font-size" class="form-select form-control shadow-lg font-size">
                        <option value="16px">SMALL</option>
                        <option value="20px">MEDIUM</option>
                        <option value="24px">LARGE</option>
                    </select>
                    <span class="input-group-text fw-bold btn btn-danger add-btn">ADD</span>

                </div>

                <div class="form-group mb-3">

                    <button class="btn btn-primary py-2 shadow-lg add-showcase-btn">Add Showcase</button>
                    <button type="button"
                        class="btn btn-primary py-2 shadow-lg float-end btn-success preview-btn">Real
                        Preview
                    </button>

                </div>

                <div class="form-group mb-3">

                    <label for="edit-title" class="fw-bold mb-1">Edit Title</label>
                    <i class="fa fa-trash text-danger shadow-lg btn float-end d-none delete-title"></i>
                    <select id="edit-title" class=" form-select form-control shadow-lg">
                        <option value="choose title">Choose Title</option>'; ?>

<!-- PHP CODING TO GET DATA FROM HEADER SHOWCASE -->
<?php

$get_data = "SELECT * FROM header_showcase";
$response = $db->query($get_data);
$count = 0;

if ($response) {
    while ($data = $response->fetch_assoc()) {
        $count++;
        echo "<option value='" . $data['id'] . "'>" . $count . "</option>";
    }
}

?>

<?php echo '</select>

                </div>

            </form>

        </div>

        <div class="col-md-1"></div>

        <div class="col-md-7 d-flex p-4 bg-white rounded shadow-lg position-relative showcase-preview">

            <div class="title-box">
                <h1 class="target showcase-title">TITLE</h1>
                <h4 class="target showcase-subtitle">SUB-TITLE</h4>

                <div class="title-buttons">

                </div>
            </div>

            <div class="rounded p-2 showcase-formatting d-flex justify-content-around align-items-center">

                <div class="btn-group">

                    <button class="btn btn-light fw-bold fs-6">Color</button>

                    <button class="btn btn-light">
                        <input type="color" name="color-selector"
                            class="form-control-color rounded shadow-lg color-selector">
                    </button>

                </div>

                <div class="btn-group">

                    <button class="btn btn-light fw-bold fs-6 text-nowrap">Font Size</button>

                    <button class="btn btn-light">
                        <input type="range" min="100" max="500" name="font-size"
                            class="form-range rounded shadow-lg font-size" placeholder="Set Font Size">
                    </button>

                </div>

                <button class="btn btn-light fw-bold fs-6 dropdown-toggle"
                    data-bs-toggle="dropdown">Align</button>

                <div class="dropdown-menu">
                    <span class="dropdown-item alignment" align-position="h"
                        align-value="flex-start">LEFT</span>
                    <span class="dropdown-item alignment" align-position="h"
                        align-value="center">CENTER</span>
                    <span class="dropdown-item alignment" align-position="h"
                        align-value="flex-end">RIGHT</span>
                    <span class="dropdown-item alignment" align-position="v"
                        align-value="flex-start">TOP</span>
                    <span class="dropdown-item alignment" align-position="v"
                        align-value="center">V-CENTER</span>
                    <span class="dropdown-item alignment" align-position="v"
                        align-value="flex-end">BOTTOM</span>
                </div>

            </div>

        </div>

    </div>
</div>


';

?>