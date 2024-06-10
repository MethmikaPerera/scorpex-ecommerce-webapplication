<?php
session_start();
require "connection.php";

$session_data = $_SESSION["u"];
$userid = $session_data["id"];

$adid = $_POST["adid"];

$address_rs = Database::search("SELECT * FROM `user_address` WHERE `id`='" . $adid . "'");
$address_num = $address_rs->num_rows;

if ($address_num == 1) {
    Database::iud("DELETE FROM `user_address` WHERE `id`='" . $adid . "' AND `user_id`='".$userid."'");
    echo "removed";
} else {
    echo "unavailable";
}
