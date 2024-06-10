<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | Scorpex Clothing</title>
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
    <link rel="stylesheet" href="Vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="Vendor/slick/slick.css">
    <link rel="stylesheet" href="Vendor/MagnificPopup/magnific-popup.css">
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
                Watchlist
            </span>
        </div>
    </div>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140 mt-5">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5 text-decoration-underline mb-3">
                    Your Watchlist
                </h3>
            </div>

            <?php
            if (isset($_SESSION["u"])) {
                $session_data = $_SESSION["u"];

                $userid = $session_data["id"];
            ?>

                <?php
                $select_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id`='" . $userid . "'");
                $select_num = $select_rs->num_rows;

                if ($select_num < 1) {
                ?>
                    <div class="row col-12 d-flex justify-content-center align-items-center mt-5">
                        <span class="fw-bold text-black-50 text-center"><i class="fa-solid fa-heart-crack h1" style="font-size: 100px;"></i></span>
                        <h3 class="col-12 text-center mb-3">Watchlist is Empty</h3>
                        <a href="products.php" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-decoration-none col-md-4 col-sm-6 col-12 text-center">
                            Shop Now
                        </a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="row isotope-grid">

                        <?php
                        for ($x = 0; $x < $select_num; $x++) {
                            $select_data = $select_rs->fetch_assoc();

                            $watch_pid = $select_data["product_id"];
                        ?>

                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                                <?php

                                $watchp_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watch_pid . "'");
                                $watchp_data = $watchp_rs->fetch_assoc();

                                ?>
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">

                                        <?php

                                        $select_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $watch_pid . "'");
                                        $select_img_data = $select_img_rs->fetch_assoc();

                                        ?>

                                        <img src="assets/<?php echo $select_img_data["code"]; ?>" alt="IMG-PRODUCT">

                                        <a href="<?php echo "viewProduct.php?id=" . ($watchp_data["id"]); ?>" class="block2-btn flex-c-m stext-103 cl0 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04 btn-purple">View Product</a>

                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                <?php echo $watchp_data["title"]; ?>
                                            </a>

                                            <span class="stext-105 cl3">
                                                LKR <?php echo $watchp_data["price"]; ?>
                                            </span>
                                        </div>

                                        <div class="block2-txt-child2 flex-r p-t-3">
                                            <a href="#" onclick="removeFromWatchlist(<?php echo $select_data['id'] ?>);" class="dis-block pos-relative text-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <a href="account-log.php" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-decoration-none col-md-4 col-sm-6 col-12 text-center">
                        Register or Sign In
                    </a>
                </div>
            <?php
            }
            ?>
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