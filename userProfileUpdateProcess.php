<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $session_data = $_SESSION["u"];

    $userid = $session_data["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobile = $_POST["mobile"];

    $user_rs = Database::search("SELECT * FROM `users` WHERE `id` = '" . $userid . "'");
    $user_num = $user_rs->num_rows;

    if($user_num == 1){

        Database::iud("UPDATE `users` SET `fname`='".$fname."',`lname`='".$lname."',`mobile`='".$mobile."' WHERE `id` = '" . $userid . "'");

        echo ("success");

    }else{

        echo ("You are not a valid user");

    }

}


