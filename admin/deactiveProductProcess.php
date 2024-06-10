<?php
require "../connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    Database::iud("UPDATE `product` SET `status_id`='0' WHERE `id`='" . $id . "'");

    echo "success";
} else {
    echo "error";
}
