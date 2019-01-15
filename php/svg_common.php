<?php
$mapwidth = 800;
$mapheight = 400;
$centre_x = $mapwidth/2;
$centre_y = $mapheight/2;

$body_type = array();
$body_type["sol"] = array("orange", "yellow");
$body_type["terra"] = array("deepskyblue", "mediumblue");
$body_type["gas"] = array("orangered", "darkorange");
$body_type["rock"] = array("lightgray", "gray");


function drawCircle($cx, $cy, $r, $stroke, $stroke_width, $fill) {
    $svg_circle = <<< HEREDOC
<circle cx="$cx" cy="$cy" r="$r" stroke="$stroke" stroke-width="$stroke_width" fill="$fill" />
HEREDOC;
    echo $svg_circle;
}
function drawBaseBody($cx, $cy, $r, $type) {
    global $body_type;
    $stroke_width = $r * 0.1;
    drawCircle($cx, $cy, $r, $body_type[$type][0], $stroke_width, $body_type[$type][1]);
    return array($cx, $cy);
}
function drawCentreBody($r, $type) {
    global $centre_x, $centre_y;
    drawBaseBody($centre_x, $centre_y, $r, $type);
    return array($centre_x, $centre_y);
}
