<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    $session_data = $_SESSION["u"];

    if(isset($_GET["id"])){

        $uid = $session_data["id"];
        $pid = $_GET["id"];

        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$pid."' AND 
        `user_id`='".$uid."'");
        $watchlist_num = $watchlist_rs->num_rows;

        if($watchlist_num == 1){
            echo ("exist");
        }else{
            Database::iud("INSERT INTO `watchlist`(`product_id`,`user_id`) VALUES ('".$pid."','".$uid."')");
            echo ("added");
        }

    }else{
        echo ("Somethng went wrong. Please try again later.");
    }

}else{
    echo ("login");
}

?>