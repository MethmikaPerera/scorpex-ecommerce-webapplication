<?php

session_start();
require "../connection.php";

$title = $_POST["title"];
$description = $_POST["description"];
$category = $_POST["category"];
$material = $_POST["material"];
$price = $_POST["price"];

if ($category == "0") {
    echo ("Please select a Category");
} else if (empty($title)) {
    echo ("Please add the Title");
} else if (strlen($title) >= 100) {
    echo ("Title should have less than 100 characters");
} else if ($material == "0") {
    echo ("Please select a Material");
} else if (empty($price)) {
    echo ("Please add the Cost");
} else if (!is_numeric($price)) {
    echo ("Invalid value for field Cost Per Item");
} else if (empty($description)) {
    echo ("Please add the Description");
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product` (`price`,`description`,`title`,`datetime_added`,`category_id`,`material_id`,`status_id`) 
    VALUES ('" . $price . "','" . $description . "','" . $title . "','" . $date . "','" . $category . "','" . $material . "','" . $status . "')");

    $product_id = Database::$connection->insert_id;

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

                    $file_name = "../assets/img/product-img/" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($image_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_images`(`code`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "')");
                } else {
                    echo ("Not an allowed image type");
                }
            }
        }

        echo ("success");
    } else {
        echo ("Something Went Wrong");
    }
}
