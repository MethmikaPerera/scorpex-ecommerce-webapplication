<?php

session_start();
require "../connection.php";

$newcat = $_POST["newcat"];

if (!empty($newcat)) {
    Database::iud("INSERT INTO `category`(`name`) VALUES('".$newcat."')");
    echo "success";
} else {
    echo "empty";
}