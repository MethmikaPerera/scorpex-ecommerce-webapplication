<?php

require "connection.php";

$cmail = $_POST["cmail"];
$cname = $_POST["cname"];
$cmsg = $_POST["cmsg"];

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (!empty($cmail)) {

    if (!empty($cmsg)) {

        if (filter_var($cmail, FILTER_VALIDATE_EMAIL)) {

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'methmika.javainstitute@gmail.com';
            $mail->Password = 'yarretnrbedeumwp';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($cmail, 'Contact');
            $mail->addReplyTo($cmail, 'Contact');
            $mail->addAddress("mamethmikap@gmail.com");
            $mail->isHTML(true);
            $mail->Subject = 'Contact Message From ' . $cname . ' at SCORPEX';
            $bodyContent = $cmsg;
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo ("Mail Sending Failed.");
            } else {
                echo ("success");
            }
        } else {
            echo ("Invalid Email Address.");
        }
    } else {
        echo ("Please enter a Message to send.");
    }
} else {
    echo ("Please enter your Email Address.");
}
