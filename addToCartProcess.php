<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $session_data = $_SESSION["u"];
    $uid = $session_data["id"];

    $pid = $_POST["pid"];
    $psize = $_POST["psize"];
    $pqty = $_POST["pqty"];

    if (!empty($pid)) {

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' AND `user_id`='" . $uid ."' AND `size_id`='" . $psize . "'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();

        $psize_rs = Database::search("SELECT * FROM `product_size` WHERE `product_id`='" . $pid . "' AND `size_id`='".$psize."'");
        $psize_data = $psize_rs->fetch_assoc();
        $product_qty = $psize_data["qty"];

        if ($cart_num == 1) {
            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = (int)$current_qty + (int)$pqty;

            if ($product_qty >= $new_qty) {

                Database::iud("UPDATE `cart` SET `qty`='" . $new_qty . "' WHERE `product_id`='" . $pid . "' AND `user_id`='" . $uid . "'");
                echo ("updated");
            } else {
                echo ("qtyerror");
            }
        } else {
            if ($product_qty >= $pqty) {

                Database::iud("INSERT INTO `cart`(`product_id`,`user_id`,`size_id`,`qty`) VALUES ('" . $pid . "','" . $uid . "','" . $psize . "','" . $pqty . "')");
                echo ("added");
            } else {
                echo ("qtyerror");
            }
        }
    } else {
        echo $pid;
    }
} else {
    echo ("login");
}
