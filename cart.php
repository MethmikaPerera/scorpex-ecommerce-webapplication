<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | Scorpex Clothing</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/fonts/linearicons-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" href="Vendor/animate/animate.css">
    <link rel="stylesheet" href="Vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" href="Vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="Vendor/select2/select2.min.css">
    <link rel="stylesheet" href="Vendor/slick/slick.css">
    <link rel="stylesheet" href="Vendor/sweetalert/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/css/util.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="animsition" onload="loadCart();">

    <?php
    require "header.php";
    ?>

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shopping Cart
            </span>
        </div>
    </div>

    <!-- Shopping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        <div class="container" id="cartBody">
            
        </div>
    </div>

    <?php
    require "footer.php";
    ?>

    <!--===============================================================================================-->
    <script src="Vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="Vendor/animsition/js/animsition.min.js"></script>
    <script src="Vendor/bootstrap/js/popper.js"></script>
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
    <script src="Vendor/sweetalert/sweetalert2.all.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/js/main.js"></script>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
</body>

</html>