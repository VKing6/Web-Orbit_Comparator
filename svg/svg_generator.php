<?php
header('Content-type: image/svg+xml');
require("svg_ellipses.php");
require_once("../db/db_connect.php");

$demo = false;
function drawDemo() {
    $sol = drawCentreBody(20, "sol");
    drawBodySystem(
        $sol,
        array(80, 0.3, 45, 45, 7, "terra"),
        array(20, 0.2, 0, 75, 3, "rock")
    );
    drawBodySystem(
        $sol,
        array(180, 0.3, 170, 0, 10, "snow"),
        array(60, 0.2, 50, 10, 5, "cloud")
    );
    $fnord = drawChildBody($sol, 120, 0, 280, -50, 10, "blue");
}
if (false) { //(count($_GET) == 2) {
    $get_b1 = "mercury";
    $get_b2 = "venus";
    $result = $database->query(
        "SELECT `parent_id`, `semimajor_axis`, `disp_size`, `disp_type`
          FROM `body_data` BD, `disp_types` DT
          WHERE id IN ('$get_b1', '$get_b2') AND BD.type_id = DT.type_id ORDER BY `semimajor_axis` DESC");
    if ($result) {
        $result->data_seek(0);
        $arr = $result->fetch_assoc();
        $b1_parent = htmlspecialchars($arr["parent_id"]);
        $b1_semimajor = htmlspecialchars($arr["semimajor_axis"]);
        $b1_size = htmlspecialchars($arr["disp_size"]);
        $b1_type = htmlspecialchars($arr["disp_type"]);

        $result->data_seek(1);
        $arr = $result->fetch_assoc();
        $b2_parent = htmlspecialchars($arr["parent_id"]);
        $b2_semimajor = htmlspecialchars($arr["semimajor_axis"]);
        $b2_size = htmlspecialchars($arr["disp_size"]);
        $b2_type = htmlspecialchars($arr["disp_type"]);

        // Normalise orbit radii to keep large orbits on the screen
        $semimajor_norm = min(($mapwidth/2-50) / $b1_semimajor, 1);

        $b1 = array($b1_semimajor*$semimajor_norm, 0, 0, 0, $b1_size, $b1_type);
        $b2 = array($b2_semimajor*$semimajor_norm, 0, 180, 0, $b2_size, $b2_type);
        $result->close();

        if ($b2_parent == $get_b1) {
            $cb_arr = array($b1_size, $b1_type);
            $b1 = NULL;
        } else if ($b1_parent == $get_b2) {
            $cb_arr = array($b2_size, $b2_type);
            $b2 = NULL;
        } else if ($b1_parent == $b2_parent) {
            $get_cb = $b1_parent;
            $result2 = $database->query("SELECT disp_size, disp_type FROM body_data BD, disp_types DT 
               WHERE id IN ('$get_cb') AND BD.type_id = DT.type_id");
            $result2->data_seek(0);
            $arr = $result2->fetch_assoc();
            $result2->close();
            $cb_size = htmlspecialchars($arr["disp_size"]);
            $cb_type = htmlspecialchars($arr["disp_type"]);
            $cb_arr = array($cb_size, $cb_type);
        } else {
            $demo = true;
        }
    } else {
        $demo = true;
    }
} else {
    $demo = true;
}

// Begin SVG
echo <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" version="1.2" width="$mapwidth" height="$mapheight">
SVG;
if ($demo) {
    drawDemo();
} else {
    $cb = drawCentreBody(...$cb_arr);
    if (!is_null($b1))
        drawChildBody($cb, ...$b1);
    if(!is_null($b2))
        drawChildBody($cb, ...$b2);
}

echo "</svg>";
require_once("../db/db_close.php");
