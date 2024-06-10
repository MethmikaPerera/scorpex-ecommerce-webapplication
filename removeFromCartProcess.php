<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $cid = $_GET["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='" . $cid . "'");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 1) {
            Database::iud("DELETE FROM `cart` WHERE `id`='" . $cid . "'");
            echo ("deleted");
        } else {
            echo ("Please Try Again Later.");
        }
    }
} else {
    echo ("login");
}
