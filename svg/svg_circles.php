<?php
require("svg_common.php");

function angle2cart($orb_angle, $orb_r) {
    $bod_x = cos(deg2rad(-$orb_angle)) * $orb_r;
    $bod_y = sin(deg2rad(-$orb_angle)) * $orb_r;
    return array($bod_x, $bod_y);
}
function drawOrbitLine($cx, $cy, $r) {
    drawCircle($cx, $cy, $r, "lightgray", 1, "transparent");
}
function drawBody($orb_r, $orb_angle, $bod_r, $bod_type) {
    global $centre_x, $centre_y;
    $carts = angle2cart($orb_angle, $orb_r);
    $bod_x = $centre_x + $carts[0];
    $bod_y = $centre_y + $carts[1];
    drawOrbitLine($centre_x, $centre_y, $orb_r);
    drawBaseBody($bod_x, $bod_y, $bod_r, $bod_type);
    return array($bod_x, $bod_y);
}
function drawChildBody($body, $orb_r, $orb_angle, $bod_r, $bod_type) {
    $orb_x = $body[0];
    $orb_y = $body[1];
    $carts = angle2cart($orb_angle, $orb_r);
    $bod_x = $orb_x + $carts[0];
    $bod_y = $orb_y + $carts[1];
    drawOrbitLine($orb_x, $orb_y, $orb_r);
    drawBaseBody($bod_x, $bod_y, $bod_r, $bod_type);
    return array($bod_x, $bod_y);
}