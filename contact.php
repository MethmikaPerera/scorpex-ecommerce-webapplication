<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact | Scorpex Clothing</title>
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
    <link rel="stylesheet" href="Vendor/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="Vendor/sweetalert/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/css/util.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="animsition">

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
                Contact
            </span>
        </div>
    </div>

    <section class="bg0 p-t-25 p-b-120">
        <div class="container">
            <div class="p-b-10 text-center mb-5">
                <h3 class="ltext-103 cl5 text-decoration-underline">
                    Contact Us
                </h3>
            </div>

            <div class="flex-w flex-tr bg-secondary-subtle">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <div>
                        <h4 class="mtext-105 cl2 txt-center p-b-30 fw-bold">
                            Send Us A Message
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="client-mail" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="Your Email Address">
                            <span class="pointer-none how-pos4"><i class="fa-regular fa-envelope"></i></span>
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="client-name" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="Your Name">
                            <span class="pointer-none how-pos4"><i class="fa-regular fa-envelope"></i></span>
                        </div>

                        <div class="bor8 m-b-30">
                            <textarea id="client-msg" class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Your Message" style="resize: none;"></textarea>
                        </div>

                        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" onclick="sendMail();">
                            Submit
                        </button>
                    </div>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <i class="fa-solid fa-location-dot"></i>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2 fw-bold">
                                Address
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                188/1, Borella Road, Depanama, Pannipitiya, Colombo, Sri Lanka
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <i class="fa-solid fa-phone"></i>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2 fw-bold">
                                Lets Talk
                            </span>

                            <p class="p-t-18">
                                <a href="tel:+94711921340" class="text-decoration-none stext-115 cl1 size-213">+94 71 192 1340</a>
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <i class="fa-solid fa-envelope"></i>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2 fw-bold">
                                Email Us
                            </span>

                            <p class="p-t-18">
                                <a href="mailto:contact@scorpex.com" class="text-decoration-none stext-115 cl1 size-213">contact@scorpex.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
                            <i class="fa-solid fa-heart"></i>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2 fw-bold">
                                Follow Us On
                            </span>

                            <p class="p-t-18">
                                <a href="#" class="text-decoration-none cl1 fs-25 p-2"><i class="fa-brands fa-square-facebook"></i></a>
                                <a href="#" class="text-decoration-none cl1 fs-25 p-2"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#" class="text-decoration-none cl1 fs-25 p-2"><i class="fa-brands fa-youtube"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    <script src="Vendor/daterangepicker/moment.min.js"></script>
    <script src="Vendor/daterangepicker/daterangepicker.js"></script>
    <script src="Vendor/slick/slick.min.js"></script>
    <script src="assets/js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script src="Vendor/parallax100/parallax100.js"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="Vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="Vendor/isotope/isotope.pkgd.min.js"></script>
    <!--===============================================================================================-->
    <script src="Vendor/sweetalert/sweetalert2.all.min.js"></script>
    <!--===============================================================================================-->
    <script src="Vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="assets/js/main.js"></script>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
</body>

</html>