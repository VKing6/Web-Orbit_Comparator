<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Orbit Comparator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kristian Auestad">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bs-darkly/bootstrap.min.css" title="Dark" />
    <link rel="alternate stylesheet" type="text/css" media="screen" href="../css/bs-flatly/bootstrap.min.css" title="Light" />
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.css" />-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../css/common.css" />-->
    <!--<script src="../js/bootstrap.js"></script>-->
</head>
<?php
    include("svg_common.php");
    $svgw = 800;
    $svgh = 400;
?>

<body>
<div class="row">
    <div class="col">
        <h1 class="text-center">Orbit Comparator</h1>
    </div>
</div>
<div class="row">
    <div class="col text-center" style="border-style: solid; border: 2px 1px 1px 1px; background: #222;">
        <!--This whole thing will be generated using php code-->
        <!--<svg width="800" height="400">-->
        <svg <?php echo "width=".$svgw." height=".$svgh?>>
            <!--Border-->
            <rect width="800" height="400" stroke="gold" stroke-width="2" />
            <?php
                drawBody($centre_x, $centre_y, 30, "sol");
                drawOrbit($centre_x, $centre_y, 120);
                //drawOrbit($centre_x, $centre_y, 100);
                drawBody(520, 200, 15, "planet");
                drawOrbit(520, 200, 30);
                drawBody(550, 200, 5, "rock");
            ?>
            <!-- Body-body line -->
            <!--<line x1="280" y1="200" x2="400" y2="300" stroke="rgb(255,0,0)" stroke-width="2"/>
            <text x="340" y="250" fill="red">d: X km</text>-->
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