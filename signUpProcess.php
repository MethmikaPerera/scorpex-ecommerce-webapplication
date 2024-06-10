<?php

require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

if(empty($fname)){
    echo ("Please enter your First Name.");
}else if(strlen($fname) > 45){
    echo ("First Name must have less than 45 characters.");
}else if(empty($lname)){
    echo ("Please enter your Last Name.");
}else if(strlen($lname) > 45){
    echo ("Last Name must have less than 45 characters.");
}else if(empty($email)){
    echo ("Please enter your Email Address.");
}else if(strlen($email) > 100){
    echo ("Email must have less than 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email Address");
}else if(empty($password)){
    echo ("Please enter your Password.");
}else if(strlen($password)<5 || strlen($password)>20){
    echo ("Password length must be between 5 - 20 characters.");
}else if(empty($mobile)){
    echo ("Please enter your Mobie Number.");
}else if(strlen($mobile) != 10){
    echo ("Mobile number must contain 10 characters.");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo ("Invalid Mobile Number.");
}else if ($gender == 0) {
    echo ("Select a Gender");
}else{

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' OR 
    `mobile`='".$mobile."'"); 
    $n = $rs->num_rows;

    if($n > 0){
        echo ("User with the same Mobile Number or Email already exists.");
    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO 
        `users`(`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`ban`,`gender_id`) 
        VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$mobile."',
        '".$date."','0','".$gender."')");

        if ($gender == 1) {
            # Male
            $dpfile = "../assets/img/profile-img/default/male.png";

            Database::iud("INSERT INTO `profile_image`(`path`,`user_email`) VALUES ('" . $dpfile . "','" . $email . "')");

        } else if ($gender == 2) {
            # Female
            $dpfile = "../assets/img/profile-img/default/female.png";

            Database::iud("INSERT INTO `profile_image`(`path`,`user_email`) VALUES ('" . $dpfile . "','" . $email . "')");

        }
        

        echo ("success");

    }


}

?>