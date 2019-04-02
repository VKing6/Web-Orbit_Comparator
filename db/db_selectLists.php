<?php
function populateSelectList($database, $sel) {
    // Retrieve database entries and generate dropdown lists
    $result = $database->query("SELECT `id`, `parent_id`, `name` FROM `body_data` ORDER BY `order`");
    $rows = $result->num_rows;
    if (count($_GET) < 2) {
        echo "<option value=\"\" selected disabled hidden>Select a body</option>";
        $body = "";
    } else {
        $body = htmlspecialchars($_GET[$sel]);
    }
    for ($i = 0; $i < $rows; $i++) {
        $result->data_seek($i);
        $arr = $result->fetch_assoc();
        $id = htmlspecialchars($arr["id"]);
        $parent_id = htmlspecialchars($arr["parent_id"]);
        $dispName = htmlspecialchars($arr["name"]);
        if ($id != "sol") { // Indent planets and moons
            $dispName = "- ".$dispName;
            if ($parent_id != "sol") {
                $dispName = "-".$dispName;
            }
        }
        if ($body == $id)
            echo "<option value=\"$id\" selected>$dispName</option>";
        else
            echo "<option value=\"$id\">$dispName</option>";
    }
    $result->close();
}

function displayData($database, $sel) {
    // Display data for selected stellar bodies
    if (count($_GET) == 2) {
        $body = htmlspecialchars($_GET[$sel]);
        $result = $database->query("SELECT `name`, `radius`, `orbital_period`, `semimajor_axis`, `eccentricity`
                FROM `body_data` WHERE `id` = \"$body\"");
        if ($result) {
            $arr = $result->fetch_assoc();
            echo "<ul class='list-unstyled display-list'>";
            echo "<li>" . htmlspecialchars($arr["name"]) . "</li>";
            echo "<li>" . htmlspecialchars($arr["radius"]) . " km</li>";
            $period = htmlspecialchars($arr["orbital_period"]);
            if ($period > 1)
                echo "<li>" . round($period, 1) . " years</li>";
            else
                echo "<li>" . round($period*365, 2) . " days</li>";
            echo "<li>" . round(htmlspecialchars($arr["semimajor_axis"]), 2) . " Gm</li>";
            echo "<li>" . htmlspecialchars($arr["eccentricity"]) . "</li>";
            echo "</ul>";
            $result->close();
        }
    }
}

