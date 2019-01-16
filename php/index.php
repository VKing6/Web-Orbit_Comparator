<!DOCTYPE html>
<html>
<head>
    <title>Orbit Comparator</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kristian Auestad">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bs-darkly/bootstrap.min.css" title="Dark" />
    <link rel="alternate stylesheet" type="text/css" media="screen" href="../css/bs-flatly/bootstrap.min.css" title="Light" />
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.css" />-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../css/common.css" />-->
    <!--<script src="../js/bootstrap.js"></script>-->
</head>
<?php
    //require("svg_circles.php");
    require("svg_ellipses.php");
?>

<body>
<div class="row">
    <div class="col">
        <h1 class="text-center">Orbit Comparator</h1>
    </div>
</div>
<div class="row">
    <div class="col text-center" style="border-style: solid; border-width: 2px 1px 1px 1px; background: #222;">
        <svg <?= "width=".$mapwidth." height=".$mapheight?>>
            <?php
            $sol = drawCentreBody(30, "sol");
            $earth = drawChildBody($sol, 200, 0.5, 0, 30, 10, "terra");
            $moon = drawChildBody($earth, 40, 0.7, 30, 345, 5, "rock");
            ?>
        </svg>
    </div>
</div>
<div class="row" style="height: 800px;">
    <div class="col text-center" style="border: solid 1px;">
        <h4>Body 1</h4>
        <select class="form-control" name="bodies" id="lsel">
            <!--To be filled from DB-->
            <option value="Earth">Earth</option>
            <option value="Mars">Mars</option>
            <option value="40236Moccha">40236 Moccha</option>
        </select>
        <p style="margin-top: 1em;">Test</p>
    </div>
    <div class="col text-center" style="border: solid 1px;">
        <h4>Labels</h4>
        <select name="hidden" id="hidden" class="form-control" style="visibility:hidden;"></select>
        <p style="margin-top: 1em;">Test</p>
    </div>
    <div class="col text-center" style="border: solid 1px;">
        <h4>Body 2</h4>
        <select class="form-control" name="bodies" id="rsel">
            <!--To be filled from DB-->
            <option value="Earth">Earth</option>
            <option value="Mars">Mars</option>
            <option value="40236Moccha">40236 Moccha</option>
        </select>
        <p style="margin-top: 1em;">Test</p>
    </div>
</div>
</body>
</html>