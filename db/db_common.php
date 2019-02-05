<?php
function populateSelectList($result) {
    $rows = $result->num_rows;
    for ($i = 0; $i < $rows; $i++) {
        $result->data_seek($i);
        $id = htmlspecialchars($result->fetch_assoc()["name"]);
        $dispName = htmlspecialchars($result->fetch_assoc()["disp_name"]);
        echo <<< HEREDOC
<option value="$id">$dispName</option>
HEREDOC;
    }
}
