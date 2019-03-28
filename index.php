<!DOCTYPE html>
<html>
<head>
    <title>Orbit Comparator</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kristian Auestad">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bs-darkly/bootstrap.min.css" title="Dark" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/common.css" />
</head>
<?php
require_once "db/db_selectLists.php";
require_once "db/db_connect.php";
?>
<body>
<div class="row">
    <div class="col">
        <h1 class="text-center">Orbit Comparator</h1>
        <p class="text-center"><?=date("Y-m-d : h:i:s T")?></p>
    </div>
</div>
<form method="get" name="bodiesForm">
<div class="row">
    <div class="col text-center" id="map-wrapper">
        <img src="svg/svg_generator.php" alt="Orbit map" />
<!--        <iframe src="php/map.php" name="svgmap" scrolling="no"></iframe>-->
    </div>
</div>
    <div class="row">
        <!-- LEFT COL -->
        <div class="col text-center box">
            <h4>Body 1</h4>
            <select class="form-control" name="body1" id="lsel">
                <?php populateSelectList($database, "body1"); ?>
            </select>
            <br />
            <div class="">
                <?php displayData($database, "body1", "sol"); ?>
            </div>
        </div>
        <!-- CENTRE COL -->
        <div class="col text-center box">
            <h4 class="hidden">Labels</h4>
            <input type="submit" class="btn btn-info btn-block" value="Compare">
            <br />
            <ul class="list-unstyled display-list">
                <li>Name</li>
                <li>Radius</li>
                <li>Period</li>
                <li>Semimajor axis</li>
                <li>Eccentricity</li>
            </ul>
        </div>
        <!-- RIGHT COL -->
        <div class="col text-center" style="border: solid 1px;">
            <h4>Body 2</h4>
            <select class="form-control" name="body2" id="rsel">
                <?php populateSelectList($database, "body2"); ?>
            </select>
            <br />
            <?php displayData($database, "body2", "earth"); ?>
            
        </div>
    </div>
</form>
<footer class="text-dark text-sm-center">&copy;Kristian Auestad <?=date("Y")?></footer>
</body>
<?php require_once "db/db_close.php"; ?>
</html>
