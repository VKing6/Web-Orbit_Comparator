<?php
require("svg_common.php");

function transformEllipseKepCart($fx, $fy, $semimajor, $ecc, $arg_of_periapsis) {
    // Transform an ellipse from Keplerian to Cartesian form
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
function transformEllipticPosKepCart($fx, $fy, $semimajor, $ecc, $arg_of_periapsis, $true_anomaly) {
    // Transform an angular position on an ellipses orbit to Cartesian coordinates
    $cosAnomaly = cos(deg2rad(180-$true_anomaly));
    $sinAnomaly = sin(deg2rad($true_anomaly));
    $semilatus = $semimajor * (1 - pow($ecc, 2));
    $radius = $semilatus / (1 + $ecc * $cosAnomaly);
    $cx = $radius * -$cosAnomaly;
    $cy = $radius * -$sinAnomaly;
    $rot = -$arg_of_periapsis;
    $rotx = $fx;
    $roty = $fy;
    return array ($cx, $cy, $rot, $rotx, $roty);
}

function drawEllipseCart($cx, $cy, $rx, $ry, $rot, $rotx, $roty, $stroke, $stroke_width, $fill, $doRot=true) {
    if (!$doRot) {
        $rot = 0;
    }
    $svg_ellipse = <<< HEREDOC
<ellipse cx="$cx" cy="$cy" rx="$rx" ry="$ry" stroke="$stroke" stroke-width="$stroke_width" fill="$fill"
    transform="rotate($rot $rotx $roty)" />
HEREDOC;
    echo $svg_ellipse;
}
function drawEllipseKep($fx, $fy, $semimajor, $ecc, $arg_of_periapsis, $stroke, $stroke_width, $fill, $doRot=true) {
    $params = transformEllipseKepCart($fx, $fy, $semimajor, $ecc, $arg_of_periapsis);
    array_push($params, $stroke, $stroke_width, $fill, $doRot);
    drawEllipseCart(...$params);  // Expand $param array as arguments for drawEllipseCart
}
function drawOrbitLine($fx, $fy, $semimajor, $ecc, $arg_of_periapsis, $doRot=true) {
    drawEllipseKep($fx, $fy, $semimajor, $ecc, $arg_of_periapsis,
            "lightgray", 1, "transparent", $doRot);
}
function drawBody($fx, $fy, $semimajor, $ecc, $arg_of_periapsis, $true_anomaly,
                  $body_radius, $body_type, $doRot = true) {
    global $centre_x, $centre_y;
    $params = transformEllipticPosKepCart($fx, $fy, $semimajor, $ecc, $arg_of_periapsis, $true_anomaly);
    $body_x = $centre_x + $params[0];
    $body_y = $centre_y + $params[1];
    $params[0] = $body_x;
    $params[1] = $body_y;
    array_splice($params, 2, 0, array($body_radius, $body_type));
    array_push($params, $doRot);
    drawOrbitLine($fx, $fy, $semimajor, $ecc, $arg_of_periapsis, $doRot);
    drawBaseBody(...$params);
    return array($body_x, $body_y);
}
function drawChildBody($parent, $semimajor, $ecc, $arg_of_periapsis, $true_anomaly,
                       $body_radius, $body_type, $doRot = true) {
    $parent_x = $parent[0];
    $parent_y = $parent[1];
    $params = transformEllipticPosKepCart($parent_x, $parent_y, $semimajor, $ecc, $arg_of_periapsis, $true_anomaly);
    $body_x = $parent_x + $params[0];
    $body_y = $parent_y + $params[1];
    $params[0] = $body_x;
    $params[1] = $body_y;
    array_splice($params, 2, 0, array($body_radius, $body_type));
    array_push($params, $doRot);
    drawOrbitLine($parent_x, $parent_y, $semimajor, $ecc, $arg_of_periapsis, false);
    drawBaseBody(...$params);
    return array($body_x, $body_y);
}
function drawBodySystem($parent, $baseBody, ...$bodies) {
    if (count($baseBody) == 6) {
        $fx = $parent[0];
        $fy = $parent[1];
        $semimajor = $baseBody[0];
        $ecc = $baseBody[1];
        $arg_of_periapsis = $baseBody[2];
        $true_anomaly = $baseBody[3];
        $body_radius = $baseBody[4];
        $body_type = $baseBody[5];
        $rot = $arg_of_periapsis;
        $rotX = $fx;
        $rotY = $fy;

        echo <<< HEREDOC
<g transform="rotate($rot $rotX $rotY)">
HEREDOC;
        $parent = drawChildBody($parent, $semimajor, $ecc, $arg_of_periapsis, $true_anomaly, $body_radius, $body_type,false);
        if(count($bodies) > 0) {
            drawBodySystem($parent, $bodies[0], ...array_slice($bodies, 1));
        }
        echo "</g>";
    } else {
        global $centre_x, $centre_y;
        echo <<< HEREDOC
<text x="$centre_x" y="$centre_y" fill="red">Parameter error occurred</text>
HEREDOC;

    }
}