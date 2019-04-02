<!DOCTYPE html>
<html>
<head>
    <title>Orbit Comparator</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kristian Auestad">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bs-darkly/bootstrap.min.css" title="Dark" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <script src="js/moment.min.js"></script>
    <script> // Dynamic clock
        function showTime() {
            document.getElementById("time").style.display = "block";  // Unhide script clock
            document.getElementById("time").innerHTML = moment.utc().format("YYYY-MM-DD : HH:mm:ss [UTC]");
            setTimeout(showTime, 1000);
        }
    </script>
</head>
<?php
require_once "db/db_selectLists.php";
require_once "db/db_connect.php";
?>
<body>
<div class="row">
    <!-- Header -->
    <div class="col text-center">
        <h1>Orbit Comparator</h1>
        <p id="time" class="hidden"><script>showTime()</script></p> <!-- Scripted running clock -->
        <noscript><p><?= date("Y-m-d : h:i:s T") ?></p></noscript> <!-- Unscripted update-on-refresh clock -->
    </div>
</div>
<form method="get" name="bodiesForm">
<div class="row">
    <!-- Main map -->
    <div class="col text-center" id="map-wrapper">
        <img src="svg/svg_generator.php" alt="Orbit map" />
    </div>
</div>
    <div class="row">
        <!-- Left data column -->
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
        <!-- Centre label column -->
        <div class="col text-center box">
            <h4 class="invisible">Labels</h4>
            <input type="submit" class="btn btn-info btn-block" value="Compare">
            <br />
            <ul class="list-unstyled display-list">
                <li>Name</li>
                <li>Radius</li>
                <li>Orbital period</li>
                <li>Semimajor axis</li>
                <li>Eccentricity</li>
            </ul>
        </div>
        <!-- Right data column -->
        <div class="col text-center box">
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
