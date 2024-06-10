<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <title>Payment Success | Scorpex Clothing</title>

    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/fonts/linearicons-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" href="Vendor/animate/animate.css">
    <link rel="stylesheet" href="Vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" href="Vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="Vendor/select2/select2.min.css">
    <link rel="stylesheet" href="Vendor/slick/slick.css">

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/util.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="animsition">

    <?php
    require "header.php";
    ?>

    <div class="container mb-5 mt-5">
        <div class="d-flex justify-content-center row col-12">

            <div class="d-flex justify-content-center col-12">
                <img src="assets/img/payment-cancel.png" class="col-8 col-md-4" alt="">
            </div>

            <div class="d-flex justify-content-center col-12">
                <h2>Payment Cancelled</h2>
            </div>

            <a class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 mt-2 col-8 col-md-4 text-decoration-none" href="cart.php">
                Go to Cart
            </a>

        </div>
    </div>

    <?php
    require "footer.php";
    ?>


    <!--===============================================================================================-->
    <script src="Vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="Vendor/animsition/js/animsition.min.js"></script>
    <script src="Vendor/bootstrap/js/popper.js"></script>
    <script src="Vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="Vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="Vendor/slick/slick.min.js"></script>
    <script src="assets/js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script src="Vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/js/main.js"></script>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
</body>

</html>