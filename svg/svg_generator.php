<?php
header('Content-type: image/svg+xml');
require("svg_ellipses.php");

// Begin SVG
echo <<< HEREDOC
<svg xmlns="http://www.w3.org/2000/svg" version="1.2" width="$mapwidth" height="$mapheight">
HEREDOC;

    // Create objects
    $sol = drawCentreBody(20, "sol");
    drawBodySystem(
        $sol,
        array(40, 0.3, 45, 45, 8, "terra"),
        array(10, 0.2, 0, 35, 3, "rock")
    );
    drawBodySystem(
        $sol,
        array(90, 0.3, 150, 0, 10, "gas"),
        array(30, 0.2, 50, 10, 5, "rock")
    );

echo "</svg>";
?>
