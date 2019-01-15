<?php
    $width = 800;
    $height = 400;
    $centre_x = $width/2;
    $centre_y = $height/2;
    $body_type = array();
    $body_type["sol"] = array("orange", 3, "yellow");
    $body_type["planet"] = array("deepskyblue", 2, "mediumblue");
    $body_type["rock"] = array("lightgray", 1, "gray");
    function drawCircle($cx, $cy, $r, $stroke, $stroke_width, $fill) {
        $svg_circle = <<< HEREDOC
<circle cx="$cx" cy="$cy" r="$r" stroke="$stroke" stroke-width="$stroke_width" fill="$fill" />
HEREDOC;
        echo $svg_circle;
    }
    function drawOrbit($cx, $cy, $r) {
        drawCircle($cx, $cy, $r, "lightgray", 1, "transparent");
    }
    function drawBody($cx, $cy, $r, $type) {
        global $body_type;
        if ($type != "square") {
            drawCircle($cx, $cy, $r, $body_type[$type][0], $body_type[$type][1], $body_type[$type][2]);
        } else {
            //drawSquare($cx, $cy, $s, $body_type[$type][0], $body_type[$type][1], $body_type[$type][2]);
        }
    }
?>