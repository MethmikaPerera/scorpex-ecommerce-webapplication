<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About | Scorpex Clothing</title>
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
                About
            </span>
        </div>
    </div>

    <section class="bg0 p-t-25 p-b-120">
        <div class="container">
            <div class="p-b-10 text-center mb-5">
                <h3 class="ltext-103 cl5 text-decoration-underline">
                    About
                </h3>
            </div>

            <div class="row p-b-148">
                <div class="col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                    <div>
                        <div class="hov-img0">
                            <img src="assets/img/about-01.jpg" alt="IMG">
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-lg-8 p-b-30">
                    <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                            Our Mission
                        </h3>

                        <p class="stext-113 cl6 p-b-26">
                            At Scorpex, our mission is to empower individuals to express their unique identity
                            through innovative and high quality fashion. We are committed to redefining the way
                            people experience clothing, transcending mere attire to become a form of
                            self-expression. We aim to foster creativity, inclusivity, and sustainability in the
                            fashion industry. Our mission is not only to create exceptional clothing but also to
                            promote a sense of belonging, where everyone feels confident and comfortable in
                            their skin. Through collaborations with like-minded brands and a relentless pursuit
                            of innovation, we strive to break the mold and set new standards in the world of
                            fashion. We are dedicated to minimizing our environmental footprint, promoting
                            ethical practices, and making a positive impact on the communities we serve. At
                            Scorpex, our mission is to inspire confidence, celebrate diversity, and revolutionize
                            the way you experience fashion. Together, we dress for change, ensuring that every
                            garment we create is a testament to our unwavering commitment to excellence, ethics,
                            and individuality.
                        </p>

                        <div class="bor16 p-l-29 p-b-9 m-t-22">
                            <p class="stext-114 cl6 p-r-40 p-b-11">
                                "Clothing is a form of self-expression; there are hints about who you are in what you wear."
                            </p>

                            <span class="stext-111 cl8">
                                - Marc Jacobs
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                            Our Story
                        </h3>

                        <p class="stext-113 cl6 p-b-26">
                            Introducing Scorpex, where fashion meets innovation, and style becomes a statement.
                            Our clothing company is a celebration of individuality, where each stitch and fabric
                            selection embodies a commitment to quality and authenticity. With an unwavering dedication
                            to craftsmanship, we create clothing that goes beyond the trends, focusing on timeless
                            elegance that stands the test of time.
                        </p>

                        <p class="stext-113 cl6 p-b-26">
                            What sets us apart is our commitment to collaboration with other leading clothing brands.
                            We believe that the fusion of creativity from various fashion houses yields the most
                            remarkable results. By partnering with like-minded designers and labels, we bring you
                            exclusive collections that push the boundaries of fashion.
                        </p>

                        <p class="stext-113 cl6 p-b-26">
                            From the boardroom to the runway, our diverse collection of attire caters to every
                            occasion and personality. Whether you're seeking classic sophistication, contemporary
                            flair, or casual comfort, we've got you covered. With Scorpex, you'll discover the perfect
                            blend of tradition and innovation, ensuring you look and feel your best. Elevate your
                            wardrobe and define your unique style with our clothing, designed to inspire and empower.
                            Discover the art of dressing with Scorpex, where fashion knows no boundaries.
                        </p>
                    </div>
                </div>

                <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                    <div>
                        <div class="hov-img0">
                            <img src="assets/img/about-02.jpg" alt="IMG">
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
    <script src="Vendor/slick/slick.min.js"></script>
    <script src="assets/js/slick-custom.js"></script>
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