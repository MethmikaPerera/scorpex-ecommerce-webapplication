<?php
session_start();
require "connection.php";

if (isset($_SESSION['u'])) {
    $session_data = $_SESSION['u'];
    $userid = $session_data['id'];

    if (isset($_SESSION['order'])) {
        $session_order = $_SESSION['order'];
        
        $product_id = $session_order['product_id'];
        $product_title = $session_order['product_title'];
        $product_price = $session_order['product_price'];
        $product_qty = $session_order['product_qty'];
        $product_sizeid = $session_order['product_sizeid'];
        $order_total = $session_order['order_total'];
        $orderid = $session_order['orderid'];
        $address_id = $session_order['selected_addressid'];

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `orders`(`order_id`,`date`,`total`,`qty`,`size_id`,`product_id`,`user_id`,`order_status`,`address_id`) 
        VALUES ('" . $orderid . "','" . $date . "','" . $order_total . "','" . $product_qty . "','" . $product_sizeid . "','" . $product_id . "','" . $userid . "','1','".$address_id."')");

        $ps_rs = Database::search("SELECT * FROM `product_size` WHERE size_id='".$product_sizeid."' AND product_id='".$product_id."'");
        $ps_d = $ps_rs->fetch_assoc();

        $psqty = $ps_d['qty'];
        $new_qty = $psqty - $product_qty;

        Database::iud("UPDATE `product_size` SET `qty`='".$new_qty."' WHERE size_id='" . $product_sizeid . "' AND product_id='" . $product_id . "'");
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
                        <img src="assets/img/payment-success.png" class="col-8 col-md-4" alt="">
                    </div>

                    <div class="d-flex justify-content-center col-12">
                        <h2>Your Payment Successful</h2>
                    </div>

                    <a class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 mt-2 col-8 col-md-4 text-decoration-none" href="invoice.php?orderid=<?php echo $orderid?>">
                        Get Invoice
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
<?php
    }
} else {
    header("Location: index.php");
}
?>