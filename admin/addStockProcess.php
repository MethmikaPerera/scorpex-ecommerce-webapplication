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
        Database::iud("INSERT INTO `product_size` (`size_id`,`product_id`,`qty`) VALUES ('" . $sid . "','" . $pid . "','".$stockqty."')");
        echo "success";
    } else if ($sid == 2) {
        Database::iud("INSERT INTO `product_size` (`size_id`,`product_id`,`qty`) VALUES ('" . $sid . "','" . $pid . "','" . $stockqty . "')");
        echo "success";
    } else if ($sid == 3) {
        Database::iud("INSERT INTO `product_size` (`size_id`,`product_id`,`qty`) VALUES ('" . $sid . "','" . $pid . "','" . $stockqty . "')");
        echo "success";
    } else if ($sid == 4) {
        Database::iud("INSERT INTO `product_size` (`size_id`,`product_id`,`qty`) VALUES ('" . $sid . "','" . $pid . "','" . $stockqty . "')");
        echo "success";
    } else if ($sid == 5) {
        Database::iud("INSERT INTO `product_size` (`size_id`,`product_id`,`qty`) VALUES ('" . $sid . "','" . $pid . "','" . $stockqty . "')");
        echo "success";
    } else if ($sid == 6) {
        Database::iud("INSERT INTO `product_size` (`size_id`,`product_id`,`qty`) VALUES ('" . $sid . "','" . $pid . "','" . $stockqty . "')");
        echo "success";
    } else {
        echo ("Something Went Wrong");
    }
}
