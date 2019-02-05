<!DOCTYPE html>
<html>
<head>
    <title>Orbit Comparator</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kristian Auestad">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bs-darkly/bootstrap.min.css" title="Dark" />
    <link rel="alternate stylesheet" type="text/css" media="screen" href="css/bs-flatly/bootstrap.min.css" title="Light" />
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.css" />-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="../css/common.css" />-->
    <!--<script src="../js/bootstrap.js"></script>-->
</head>

<body>
<div class="row">
    <div class="col">
        <h1 class="text-center">Orbit Comparator</h1>
        <p class="text-center"><?=date("Y-m-d : h:i:s T")?></p>
    </div>
</div>
<div class="row">
    <div class="col text-center" style="border-style: solid; border-width: 2px 1px 1px 1px; background: #222;">
        <img src="svg/svg_generator.php" alt="Orbit map" />
    </div>
</div>
<?php
    $dbConnection = new mysqli("localhost", "root", "", "bodies");
    if ($dbConnection->connect_error) die("Connection Error");
    $query = "SELECT `name`, `disp_name` from `bodies`";
    $result = $dbConnection->query($query);
    if (!$result) die("Query Error");
?>
<div class="row" style="height: 800px;">
    <div class="col text-center" style="border: solid 1px;">
        <h4>Body 1</h4>
        <select class="form-control" name="bodies" id="lsel">
            <!--To be filled from DB-->
            <?php populateSelectList($result); ?>
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
