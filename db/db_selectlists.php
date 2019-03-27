<?php
function populateSelectList($database, $sel) {
    $result = $database->query("SELECT `id`, `name` FROM `body_data`");
    $rows = $result->num_rows;
    if (count($_GET) <= 0) {
        echo "<option value=\"\" selected disabled hidden>Select a body</option>";
        $body = "";
    } else {
        $body = htmlspecialchars($_GET[$sel]);
    }
    for ($i = 0; $i < $rows; $i++) {
        $result->data_seek($i);
        $arr = $result->fetch_assoc();
        $id = htmlspecialchars($arr["id"]);
        $dispName = htmlspecialchars($arr["name"]);
        if ($body == $id)
            echo "<option value=\"$id\" selected>$dispName</option>";
        else
            echo "<option value=\"$id\">$dispName</option>";
    }
    $result->close();
}


function displayData($database, $sel) {
    if (count($_GET) <= 0) return;
    $body = htmlspecialchars($_GET[$sel]);
    if ($body) {
        $result = $database->query("SELECT `name`, `radius`, `orbital_period`, `semimajor_axis`, `eccentricity`
                FROM `body_data` WHERE `id` = \"$body\"");
        if ($result) {
            $arr = $result->fetch_assoc();
            echo "<ul class='list-unstyled display-list'>";
            echo "<li>" . htmlspecialchars($arr["name"]) . "</li>";
            echo "<li>" . htmlspecialchars($arr["radius"]) . " km</li>";
            echo "<li>" . htmlspecialchars($arr["orbital_period"]) . " years</li>";
            echo "<li>" . htmlspecialchars($arr["semimajor_axis"]) . " Mkm</li>";
            echo "<li>" . htmlspecialchars($arr["eccentricity"]) . "</li>";
            echo "</ul>";
            $result->close();
        }
    }
}

