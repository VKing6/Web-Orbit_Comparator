<?php
// Connect to body database
$database = new mysqli("localhost",
    "root", "", "orbital_bodies");
if ($database->connect_error) die("Connection Error");

function populateSelectList($database) {
    $result = $database->query("SELECT `name`, `disp_name` from `bodies`");
    $rows = $result->num_rows;
    for ($i = 0; $i < $rows; $i++) {
        $result->data_seek($i);
        $arr = $result->fetch_assoc();
        $id = htmlspecialchars($arr["name"]);
        $dispName = htmlspecialchars($arr["disp_name"]);
        echo <<< HEREDOC
<option value="$id">$dispName</option>
HEREDOC;
    }
    $result->close();
}

function displayData($database, $id) {
    if ($result = $database->query("SELECT * from `bodies` where `name` = \"$id\"")) {
        $arr = $result->fetch_assoc();
        echo "<ul class='list-unstyled'>";
        echo "<li>" . htmlspecialchars($arr["disp_name"]) . "</li>";
        echo "<li>" . htmlspecialchars($arr["radius"]) . "</li>";
        echo "<li>" . htmlspecialchars($arr["period"]) . "</li>";
        echo "<li>" . htmlspecialchars($arr["semimajor"]) . "</li>";
        echo "<li>" . htmlspecialchars($arr["ecc"]) . "</li>";
        echo "</ul>";
    }
}

