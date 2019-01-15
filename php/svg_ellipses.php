<?php
require("svg_common.php");

function kep2cartElliptic($fx, $fy, $semimajor, $ecc, $arg_of_periapsis) {
    if ($ecc >= 0 && $ecc < 1) {
        $rx = $semimajor;
        $ry = $semimajor * sqrt(1-pow($ecc,2));
        $rot = -$arg_of_periapsis;
        $rotx = $fx;
        $roty = $fy;
        $focal_length = $semimajor * $ecc;
        $cx = $fx + $focal_length;
        $cy = $fy;
        return array($cx, $cy, $rx, $ry, $rot, $rotx, $roty);
    }
}
function polar2cartElliptic() {

}
function drawEllipseCart($cx, $cy, $rx, $ry, $rot, $rotx, $roty, $stroke, $stroke_width, $fill) {
    $svg_ellipse = <<< HEREDOC
<ellipse cx="$cx" cy="$cy" rx="$rx" ry="$ry" stroke="$stroke" stroke-width="$stroke_width" fill="$fill"
    transform="rotate($rot $rotx $roty)" />
HEREDOC;
    echo $svg_ellipse;
}
function drawEllipseKep($fx, $fy, $semimajor, $ecc, $arg_of_periapsis, $stroke, $stroke_width, $fill) {
    $param = kep2cartElliptic($fx, $fy, $semimajor, $ecc, $arg_of_periapsis);
    array_push($param, $stroke, $stroke_width, $fill);
    drawEllipseCart(...$param);  // Expand $param array as arguments for drawEllipseCart
}
function drawOrbitLine($fx, $fy, $semimajor, $ecc, $arg_of_periapsis) {
    drawEllipseKep($fx, $fy, $semimajor, $ecc, $arg_of_periapsis, "lightgray", 1, "transparent");
}
