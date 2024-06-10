<?php

require "connection.php";

$cid = $_POST["cid"];
$qty = $_POST["qty"];

$c_rs = Database::search("SELECT * FROM `cart` WHERE `id`='" . $cid . "'");
$c_num = $c_rs->num_rows;

if ($c_num > 0) {
    $cdata = $c_rs->fetch_assoc();
    $pid = $cdata["product_id"];
    $sid = $cdata["size_id"];

    $ps_rs = Database::search("SELECT * FROM `product_size` WHERE `product_id`='" . $pid . "' AND `size_id`='" . $sid . "'");
    $psdata = $ps_rs->fetch_assoc();
    $psqty = $psdata["qty"];

    if ($psqty >= $qty) {
        if ($qty > 0) {
            Database::iud("UPDATE `cart` SET `qty` = '" . $qty . "' WHERE `id` = '" . $cid . "'");
            echo "success";
        }
    } else {
        echo "exceeded";
    }
} else {
    echo "No Cart Product Found";
}
