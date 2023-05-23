<?php

require("../../dompdf/autoload.inc.php");
require_once("../../common_files/php/database.php");

use Dompdf\Dompdf;

$x = new Dompdf();

$enrollment = $_GET['enrollment'];
$name = $_GET['name'];
$category = $_GET['category'];
$course = $_GET['course'];
$batch = $_GET['batch'];
$paid_fee = $_GET['paid-fee'];
$date = $_GET['date'];
$fee_time = $_GET['fee-time'];
$pending = $_GET['pending'];
$recent = $_GET['recent'];

echo $enrollment;

$design = '

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>

<body style="background-color: antiquewhite; padding: 5px;">
    <h1 style="text-align: center; color: white; background-color: rgb(27, 27, 85);">NEET LUCKNOW INSTITUTE</h1>
    <p style="text-align: center;">NEET LUCKNOW HAJRAT GANJ AMINABAAD</p>

    <div style="width: 500px;">
        <b>NAME : </b> 
        <span>' . $name . '</span><br><br>
        <b>ENROLLMENT : </b> 
        <span>' . $enrollment . '</span><br><br>
        <b>DATE : </b> 
        <span>' . $date . '</span><br><br>
        <b>FEE TIME : </b> 
        <span>' . $fee_time . '</span><br><br>
        <b>PAID FEE : </b> 
        <span>' . $paid_fee . '</span><br><br>
    </div>

    <table style="width: 100%; border: 2px solid rgb(27, 27, 85);">
        <thead style="text-align: center; font-weight: bold; background-color: black; color: antiquewhite;">
            <tr>
                <th style="padding: 5px;">SR.NO</th>
                <th style="padding: 5px;">CATEGORY</th>
                <th style="padding: 5px;">COURSE</th>
                <th style="padding: 5px;">BATCH</th>
                <th style="padding: 5px;">PENDING AMOUNT</th>
                <th style="padding: 5px;">RECENT PAID</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center; padding: 5px;">1</td>
                <td style="text-align: center; padding: 5px;">' . $category . '</td>
                <td style="text-align: center; padding: 5px;">' . $course . '</td>
                <td style="text-align: center; padding: 5px;">' . $batch . '</td>
                <td style="text-align: center; padding: 5px;">' . $pending . '</td>
                <td style="text-align: center; padding: 5px;">' . $recent . '</td>
            </tr>
        </tbody>
    </table>

    <h3>TERMS AND CONDITIONS :: </h3>

    <h2>HEADING ...?</h2>
    <P>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus, modi eveniet! Ipsum, voluptatibus quo velit
        fuga recusandae dicta commodi possimus, pariatur magni nisi ullam repellat maxime. Nostrum, nihil perspiciatis?
        Iste! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum, rerum, non incidunt nesciunt veritatis
        commodi delectus, officiis consequuntur vitae assumenda quos ad porro sequi architecto magni odit totam maxime.
        Quod.</P>

</body>

</html>

';

$x->loadHtml($design);
$x->setPaper("A4", "portrait");
$x->render();
$x->stream();


?>