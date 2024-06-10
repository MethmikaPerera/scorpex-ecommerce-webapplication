<?php

session_start();
require "../connection.php";

$pid = $_POST["pid"];
$sid = $_POST["sid"];
$stockqty = $_POST["stockqty"];


if ($pid == 0) {
    echo ("Please select a Product");
} else if ($sid == 0) {
    echo ("Please select a Size");
} else if (empty($stockqty)) {
    echo ("Please enter Quantity");
} else {
    if ($sid == 1) {
        Database::iud("UPDATE `product_size` SET `qty`='" . $stockqty . "' WHERE `size_id`='" . $sid . "' AND product_id='" . $pid . "'");
        echo "success";
    } else if ($sid == 2) {
        Database::iud("UPDATE `product_size` SET `qty`='" . $stockqty . "' WHERE size_id='" . $sid . "' AND product_id='" . $pid . "'");
        echo "success";
    } else if ($sid == 3) {
        Database::iud("UPDATE `product_size` SET `qty`='" . $stockqty . "' WHERE size_id='" . $sid . "' AND product_id='" . $pid . "'");
        echo "success";
    } else if ($sid == 4) {
        Database::iud("UPDATE `product_size` SET `qty`='" . $stockqty . "' WHERE size_id='" . $sid . "' AND product_id='" . $pid . "'");
        echo "success";
    } else if ($sid == 5) {
        Database::iud("UPDATE `product_size` SET `qty`='" . $stockqty . "' WHERE size_id='" . $sid . "' AND product_id='" . $pid . "'");
        echo "success";
    } else if ($sid == 6) {
        Database::iud("UPDATE `product_size` SET `qty`='" . $stockqty . "' WHERE size_id='" . $sid . "' AND product_id='" . $pid . "'");
        echo "success";
    } else {
        echo ("Something Went Wrong");
    }
}
