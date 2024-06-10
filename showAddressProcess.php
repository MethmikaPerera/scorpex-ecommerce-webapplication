<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $session_data = $_SESSION["u"];

    if (isset($_GET["id"])) {

        $uid = $session_data["id"];
        $address_id = $_GET["id"];

        $address_rs = Database::search("SELECT * FROM `user_address` WHERE `id`='" . $address_id . "' AND 
        `user_id`='" . $uid . "'");
        $address_num = $address_rs->num_rows;

        if ($address_num == 1) {
            $address_data = $address_rs->fetch_assoc();

            $district_rs = Database::search("SELECT * FROM `district` WHERE `id`='" . $address_data["district_id"] . "'");
            $district_data = $district_rs->fetch_assoc();

            $no = $address_data["no"];
            $line1 = $address_data["line1"];
            $line2 = $address_data["line2"];
            $city = $address_data["city"];
            $district = $district_data["name"];
            $postal = $address_data["postal_code"];

            echo ($no . ", " . $line1 . ", " . $line2 . ", " . $city . ", " . $district . ". " . $postal);
        } else {
            echo ("no");
        }
    } else {
        echo ("error");
    }
} else {
    echo ("login");
}