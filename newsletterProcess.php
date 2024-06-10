<?php

require "connection.php";

if(isset($_GET["e"])){

    $nemail = $_GET["e"];

    $rs = Database::search("SELECT* FROM `newsletter` WHERE `email`='".$nemail."'");
    $n = $rs->num_rows;

    if($n < 1){

        Database::iud("INSERT INTO `newsletter`(`email`) VALUES ('".$nemail."')");
        echo ("success");
    }
    
} else {
    echo ("Entered Email Already Exists.");
}

?>