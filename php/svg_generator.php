<?php
    require("svg_circles.php");
    global $width, $height;

    // Begin SVG
    echo <<< HEREDOC
<svg xmlns="http://www.w3.org/2000/svg" version="1.2" width="$width" height="$height">
HEREDOC;

    drawCentreBody(15, "planet");
    echo "</svg>";
?>