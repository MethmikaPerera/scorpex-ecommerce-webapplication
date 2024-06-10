<?php
session_start();

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE product.id='" . $pid . "' AND product.status_id='1'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

        $catid =  $product_data["category_id"];
        $category_rs = Database::search("SELECT * FROM `category` WHERE category.id='" . $catid . "'");
        $category_data = $category_rs->fetch_assoc();

        $matid =  $product_data["material_id"];
        $material_rs = Database::search("SELECT * FROM `material` WHERE material.id='" . $matid . "'");
        $material_data = $material_rs->fetch_assoc();
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | Scorpex Clothing</title>
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

                    <a href="products.php" class="stext-109 cl8 hov-cl1 trans-04">
                        Products
                        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                    </a>

                    <span class="stext-109 cl4">
                        <?php echo $category_data["name"]; ?>
                    </span>
                </div>
            </div>

            <!-- Product Detail -->
            <section class="sec-product-detail bg0 p-t-65 p-b-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-7 p-b-30">
                            <div class="p-l-25 p-r-30 p-lr-0-lg">
                                <div class="wrap-slick3 flex-sb flex-w">
                                    <div class="slick3 gallery-lb">
                                        <div class="item-slick3" data-thumb="assets/<?php echo $select_img_data["code"]; ?>">
                                            <div class="wrap-pic-w pos-relative">

                                                <?php

                                                $select_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $select_img_data = $select_img_rs->fetch_assoc();

                                                ?>

                                                <img src="assets/<?php echo $select_img_data["code"]; ?>" alt="<?php echo $product_data["title"]; ?>">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="assets/<?php echo $select_img_data["code"]; ?>">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-5 p-b-30">
                            <div class="p-r-50 p-t-5 p-lr-0-lg">
                                <h4 class="mtext-105 cl2 js-name-detail">
                                    <?php echo $product_data["title"]; ?>
                                </h4>


                                <p class="mtext-107 cl2 mt-3">
                                    <span class="stext-110 cl2">
                                        Description :
                                    </span> <?php echo $product_data["description"]; ?>
                                </p>

                                <hr class="m-tb-20">

                                <p class="mtext-107 cl2">
                                    <?php
                                    $matid =  $product_data["material_id"];
                                    $material_rs = Database::search("SELECT * FROM `material` WHERE material.id='" . $matid . "'");
                                    $material_data = $material_rs->fetch_assoc();
                                    ?>
                                    <span class="stext-110 cl2">
                                        Material :
                                    </span> <?php echo $material_data["name"]; ?>
                                </p>

                                <hr class="m-tb-20">

                                <p class="mtext-106 cl2">
                                    LKR <?php echo $product_data["price"]; ?>.00
                                </p>

                                <form action="BuyNowConfirm.php" method="POST" class="col-12">
                                    <!--  -->
                                    <div class="p-t-33">
                                        <div class="flex-w flex-r-m p-b-10">
                                            <div class="size-203 flex-c-m respon6 fw-bold">
                                                Size :
                                            </div>

                                            <div class="size-204 respon6-next">
                                                <div class="rs1-select2 bor8 bg0">
                                                    <select class="js-select2" name="size" id="psize">
                                                        <option value="0" disabled>Choose your size</option>
                                                        <?php

                                                        $size_rs = Database::search("SELECT * FROM `size`");
                                                        $n = $size_rs->num_rows;

                                                        for ($x = 0; $x < $n; $x++) {
                                                            $d = $size_rs->fetch_assoc();

                                                            $ps_rs = Database::search("SELECT * FROM `product_size` WHERE size_id='" . $d["id"] . "' AND product_id='" . $product_data["id"] . "'");
                                                            $ps_num = $ps_rs->num_rows;

                                                        ?>
                                                            <option value="<?php echo $d["id"] ?>">
                                                                <?php echo $d["size"]; ?> <span>(
                                                                    <?php
                                                                    if ($ps_num == 1) {
                                                                        $psd = $ps_rs->fetch_assoc();
                                                                        $psqty = $psd["qty"];
                                                                        echo $psqty . " In Stock";
                                                                    } else {
                                                                        echo "Out of Stock";
                                                                    }
                                                                    ?> )</span>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-w flex-r-m p-b-10">
                                            <div class="size-203 flex-c-m respon6 fw-bold">
                                                Qty :
                                            </div>
                                            <div class="size-204 flex-w flex-m respon6-next">
                                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="decQty();">
                                                        <i class="fs-16 fa-solid fa-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1" min="1" id="pqty" disabled>

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="incQty();">
                                                        <i class="fs-16 fa-solid fa-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--  -->
                                    <div class="flex-w flex-m p-l-100 respon7">
                                        <input type="hidden" value="<?php echo $product_data['id'] ?>" id="pid">

                                        <?php
                                        if (isset($_SESSION["u"])) {
                                        ?>
                                            <a class="flex-c-m stext-101 cl0 size-101 bg10 bor1 hov-btn1 m-r-5 p-lr-15 trans-04 col-8 text-decoration-none pointer" onclick="addToCart(<?php echo $product_data['id'] ?>);">
                                                Add to cart
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="flex-c-m stext-101 cl0 size-101 bg10 bor1 hov-btn1 m-r-5 p-lr-15 trans-04 col-8 text-decoration-none pointer d-none" onclick="addToCart(<?php echo $product_data['id'] ?>);">
                                                Add to cart
                                            </a>
                                        <?php
                                        }

                                        ?>

                                        <div class="flex-m bor20 p-l-10 m-l-5">
                                            <?php
                                            if (isset($_SESSION["u"])) {
                                                $session_data = $_SESSION["u"];

                                                $uw_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id`='" . $session_data["id"] . "' AND `product_id`='" . $product_data["id"] . "'");
                                                $uw_num = $uw_rs->num_rows;

                                                if ($uw_num > 0) {
                                                    $uw_data = $uw_rs->fetch_assoc();
                                            ?>
                                                    <a href="#" class="fs-25 cl13 hov-cl2 trans-04 lh-10 p-lr-5 p-tb-2" onclick="removeFromWatchlist(<?php echo $uw_data['id'] ?>);">
                                                        <i class="fa-solid fa-heart-circle-minus"></i>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="#" class="fs-25 cl13 hov-cl2 trans-04 lh-10 p-lr-5 p-tb-2" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);">
                                                        <i class="fa-solid fa-heart-circle-plus"></i>
                                                    </a>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <a href="#" class="fs-25 cl13 hov-cl2 trans-04 lh-10 p-lr-5 p-tb-2 d-none" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);">
                                                    <i class="fa-solid fa-heart-circle-exclamation"></i>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <input type="hidden" name="product_qty" id="buyqty" value="1">
                                        <input type="hidden" name="product_id" value="<?php echo $product_data['id']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $product_data['price']; ?>">
                                        <input type="hidden" name="product_title" value="<?php echo $product_data['title']; ?>">
                                        <input type="hidden" name="product_size" id="selected_size" value="">

                                        <?php
                                        if (isset($_SESSION["u"])) {
                                        ?>
                                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 mt-2 col-12">
                                                Buy Now
                                            </button>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="account-log.php" class="flex-c-m stext-101 cl0 size-101 bg3 bor1 hov-btn0 p-lr-15 trans-04 mt-2 col-12 text-decoration-none">
                                                Please Login
                                            </a>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                </form>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const selectElement = document.querySelector('.js-select2');
                                        const hiddenInput = document.getElementById('selected_size');

                                        if (selectElement) {
                                            selectElement.addEventListener('change', function() {
                                                hiddenInput.value = this.value;
                                                console.log('Selected size:', this.value); // For debugging
                                                console.log('Hidden input value:', hiddenInput.value); // For debugging
                                            });
                                        } else {
                                            console.error('Select element with class "js-select2" not found.');
                                        }
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg6 flex-c-m flex-w size-302 m-t-73">
                    <span class="stext-107 cl6 p-lr-25">
                        Added On: <?php echo $product_data["datetime_added"]; ?>
                    </span>

                    <span class="stext-107 cl6 p-lr-25">
                        Category: <?php echo $category_data["name"]; ?>
                    </span>
                </div>
            </section>

            <?php
            require "footer.php";
            ?>


            <!--===============================================================================================-->
            <script src="https://js.stripe.com/v3/"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const selectElement = document.querySelector('.js-select2');
                    const hiddenInput = document.getElementById('selected_size');

                    if (selectElement) {
                        selectElement.addEventListener('change', function() {
                            hiddenInput.value = this.value;
                        });
                    }

                    const form = document.querySelector('form[action="create-checkout-session.php"]');
                    form.addEventListener('submit', async (e) => {
                        e.preventDefault();

                        const response = await fetch('create-checkout-session.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams(new FormData(form)),
                        });

                        const {
                            clientSecret
                        } = await response.json();
                        const {
                            error,
                            paymentIntent
                        } = await stripe.confirmCardPayment(clientSecret, {
                            payment_method: {
                                card: cardElement,
                            },
                        });

                        if (error) {
                            console.error(error);
                        } else if (paymentIntent.status === 'succeeded') {
                            console.log('Payment succeeded');
                            // Redirect or show success message
                        }
                    });
                });
            </script>
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

<?php

    } else {
        echo ("Sory for the inconvinient");
    }
} else {
    echo ("Something went wrong");
}

?>