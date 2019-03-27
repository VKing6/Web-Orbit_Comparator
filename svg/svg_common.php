<?php
$mapwidth = 800;
$mapheight = 800;
$centre_x = $mapwidth/2;
$centre_y = $mapheight/2;

$body_type = array();
$body_type["sol"] = array("orange", "yellow");
$body_type["terra"] = array("deepskyblue", "mediumblue");
$body_type["gas"] = array("darkorange", "sandybrown");
$body_type["rock"] = array("lightgray", "gray");
$body_type["red"] = array("brown", "firebrick");
$body_type["cloud"] = array("bisque", "tan");
$body_type["blue"] = array("royalblue", "darkslateblue");

function drawCircle($cx, $cy, $r, $stroke, $stroke_width, $fill, $rot, $rotx, $roty) {
    $svg_circle = <<< HEREDOC
<circle cx="$cx" cy="$cy" r="$r" stroke="$stroke" stroke-width="$stroke_width" fill="$fill"
transform="rotate($rot $rotx $roty)" />
HEREDOC;
    echo $svg_circle;
}
function drawBaseBody($cx, $cy, $r, $type, $rot = 0, $rotx = 0, $roty = 0) {
    global $body_type;
    $stroke_width = $r * 0.1;
    drawCircle($cx, $cy, $r, $body_type[$type][0], $stroke_width, $body_type[$type][1], $rot, $rotx, $roty);
    return array($cx, $cy);
}
function drawCentreBody($r, $type) {
    global $centre_x, $centre_y;
    drawBaseBody($centre_x, $centre_y, $r, $type, 0, 0, 0);
    return array($centre_x, $centre_y);
}
