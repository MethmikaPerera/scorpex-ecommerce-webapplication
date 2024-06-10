<?php
session_start();
require "connection.php";

$session_data = $_SESSION["u"];
$userid = $session_data["id"];

$tagname = $_POST["tagname"];
$no = $_POST["no"];
$line1 = $_POST["line1"];
$line2 = $_POST["line2"];
$city = $_POST["city"];
$district = $_POST["district"];
$postal = $_POST["postal"];

$addresstag_rs = Database::search("SELECT * FROM `user_address` WHERE `user_id`='" . $userid . "' AND `tag_name`='".$tagname."'");
$addresstag_num = $addresstag_rs->num_rows;

if (empty($tagname)) {
    echo "Insert A Tag Name for Address.";
} elseif ($addresstag_num == 1) {
    echo "Insert a different Tag Name you didn't used.";
} elseif (empty($no)) {
    echo "Inser your Address No";
} elseif (empty($line1)) {
    echo "Inser your Address Line 1";
} elseif (empty($line2)) {
    echo "Insert your Address Line 2";
} elseif (empty($city)) {
    echo "Insert Your City";
} elseif ($district == 0) {
    echo "Select Your District";
} elseif (empty($postal)) {
    echo "Insert Your Postal Code";
} elseif ($postal < 0) {
    echo "Insert Correct Postal Code";
} else {
    $address_rs = Database::search("SELECT * FROM `user_address` WHERE `user_id`='" . $userid . "'");
    $address_num = $address_rs->num_rows;

    if ($address_num < 3) {
        Database::iud("INSERT INTO `user_address`(`no`,`line1`,`line2`,`city`,`district_id`,`postal_code`,`user_id`,`tag_name`) VALUES ('".$no."','".$line1."','".$line2."','".$city."','".$district."','".$postal."','".$userid."','".$tagname."')");
        echo "success";
    } else {
        echo "exceeded";
    }
    
}
