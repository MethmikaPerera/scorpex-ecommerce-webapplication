<?php
require "../connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    Database::iud("UPDATE `users` SET `ban`='1' WHERE `id`='" . $id . "'");

    echo "success";
} else {
    echo "error";
}
