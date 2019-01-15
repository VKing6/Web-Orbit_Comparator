<?php
    include("svg_common.php");

    // Begin SVG
    echo <<< HEREDOC
<svg xmlns="http://www.w3.org/2000/svg" version="1.2">
HEREDOC;

    drawBody(520, 200, 15, "planet");
    echo "</svg>";
?>