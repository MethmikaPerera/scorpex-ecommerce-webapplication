<?php 

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $session_data = $_SESSION["u"];
    $userid = $session_data["id"];

    $cp = $_POST["cp"];
    $np = $_POST["np"];

    $user_rs = Database::search("SELECT * FROM `users` WHERE id = '".$userid."'");
    $user_data = $user_rs->fetch_assoc();

    $upwd = $user_data["password"];

    if ($upwd == $cp) {
        Database::iud("UPDATE `users` SET `password`='".$np."' WHERE id = '" . $userid . "'");
        echo "success";
    } else {
        echo "Invalid Current Password";
    }
    

} else {
    echo "Please Login or Signup";
}
