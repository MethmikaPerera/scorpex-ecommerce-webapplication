<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | Scorpex Clothing</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

    <link rel="stylesheet" href="Vendor/animate/animate.css">
    <link rel="stylesheet" href="Vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" href="Vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="Vendor/select2/select2.min.css">
    <link rel="stylesheet" href="Vendor/slick/slick.css">
    <link rel="stylesheet" href="Vendor/MagnificPopup/magnific-popup.css">
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
                Advanced Search
            </span>
        </div>
    </div>

    <div class="p-b-10 mt-5 mb-5 text-center">
        <h3 class="ltext-103 cl5 text-decoration-underline">
            Advanced Search
        </h3>
    </div>

    <div class="offset-lg-2 col-12 col-lg-8 mb-5 bg-body rounded">

        <div class="row">
            <div class="offset-lg-1 col-12 col-lg-10">
                <div class="row">
                    <div class="col-12 col-md-10 mt-2 mb-1">
                        <input type="text" class="form-control" placeholder="Type keyword to search..." id="txt" />
                    </div>
                    <div class="col-12 col-md-2 mt-2 mb-1 d-grid">
                        <button class="btn btn-secondary" onclick="advancedSearch(0);">Search</button>
                    </div>
                    <div class="col-12">
                        <hr class="border border-3 border-dark">
                    </div>
                </div>
            </div>

            <div class="offset-lg-1 col-12 col-lg-10">
                <div class="row">

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 col-md-6 mb-3">
                                <select class="form-select" id="cat">
                                    <option value="0">Select Category</option>
                                    <?php

                                    $cat_rs = Database::search("SELECT * FROM `category`");
                                    $cat_n = $cat_rs->num_rows;

                                    for ($x = 0; $x < $cat_n; $x++) {
                                        $cat_d = $cat_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $cat_d["id"] ?>">
                                            <?php echo $cat_d["name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <select class="form-select" id="mat">
                                    <option value="0">Select Material</option>
                                    <?php

                                    $mat_rs = Database::search("SELECT * FROM `material`");
                                    $mat_n = $mat_rs->num_rows;

                                    for ($x = 0; $x < $mat_n; $x++) {
                                        $mat_d = $mat_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $mat_d["id"] ?>">
                                            <?php echo $mat_d["name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Price From..." id="min" />
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Price To..." id="max" />
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3">
        <div class="row">
            <div class="offset-lg-1 col-12 col-lg-10 text-center">
                <div class="row" id="viewarea">

                </div>
            </div>
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
    <script src="assets/js/main.js"></script>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
</body>

</html>