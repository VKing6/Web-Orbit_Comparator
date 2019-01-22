<?php
header('Content-type: image/svg+xml');
require("svg_ellipses.php");

// Begin SVG
echo <<< HEREDOC
<svg xmlns="http://www.w3.org/2000/svg" version="1.2" width="800" height="400">
HEREDOC;

    // Create objects
    $sol = drawCentreBody(30, "sol");
    drawBodySystem(
        $sol,
        array(90, 0.3, 30, 30, 10, "terra"),
        array(30, 0.2, 0, 100, 5, "rock")
    );

echo "</svg>";
?>
