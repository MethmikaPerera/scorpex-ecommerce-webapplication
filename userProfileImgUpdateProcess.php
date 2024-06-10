<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $session_data = $_SESSION["u"];

    $userid = $session_data["id"];
    $fname = $session_data["fname"];
    $lname = $session_data["lname"];
    $email = $session_data["email"];

    $length = sizeof($_FILES);

    if ($length <= 1 && $length > 0) {

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {

                $image_file = $_FILES["image" . $x];
                $file_extention = $image_file["type"];

                if (in_array($file_extention, $allowed_image_extentions)) {

                    $new_img_extention;

                    if ($file_extention == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_extention == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_extention == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_extention == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "assets/img/profile-img/" . $fname . "_" . $lname . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($image_file["tmp_name"], $file_name);

                    $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $email . "'");

                    $image_num = $image_rs->num_rows;

                    if ($image_num == 1) {

                        Database::iud("UPDATE `profile_image` SET `path`='" . $file_name . "' WHERE `user_email` = '" . $email . "'");
                        echo "updated";
                    } else {

                        Database::iud("INSERT INTO `profile_image`(`path`,`user_email`) VALUES ('" . $file_name . "','" . $user_email . "')");
                        echo "success";
                    }
                } else {
                    echo "Not an allowed image type";
                }
            }
        }
    } else {
        echo "Something Went Wrong";
    }
}
