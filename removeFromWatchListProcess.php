<?php

require "connection.php";

if (isset($_GET["id"])) {

    $watch_id = $_GET["id"];

    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `id`='" . $watch_id . "'");
    $watchlist_num = $watchlist_rs->num_rows;

    if ($watchlist_num > 0) {

        Database::iud("DELETE FROM `watchlist` WHERE `id`='" . $watch_id . "'");
        echo ("deleted");
    } else {
        echo ("Something went wrong");
    }
}
