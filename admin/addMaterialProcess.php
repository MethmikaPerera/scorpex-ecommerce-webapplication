<?php

session_start();
require "../connection.php";

$newmat = $_POST["newmat"];

if (!empty($newmat)) {
    Database::iud("INSERT INTO `material`(`name`) VALUES('".$newmat."')");
    echo "success";
} else {
    echo "empty";
}
