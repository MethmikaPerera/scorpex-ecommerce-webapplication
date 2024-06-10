<?php
session_start();

require "connection.php";

if (isset($_SESSION['u'])) {
    $session_data = $_SESSION['u'];
    $userid = $session_data['id'];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Order History | Scorpex Clothing</title>
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
                    Order History
                </span>
            </div>
        </div>

        <section class="bg0 p-t-25 p-b-120">
            <div class="container">
                <div class="p-b-10 text-center mb-5">
                    <h3 class="ltext-103 cl5 text-decoration-underline">
                        Order History
                    </h3>
                </div>

                <?php
                $orderid_rs = Database::search("SELECT `order_id` FROM `orders` WHERE `user_id`='" . $userid . "' GROUP BY `order_id`");
                $orderid_num = $orderid_rs->num_rows;

                if ($orderid_num > 0) {
                    for ($i = 0; $i < $orderid_num; $i++) {
                        $orderid_data = $orderid_rs->fetch_assoc();
                        $orderid = $orderid_data['order_id'];

                        $order_rs = Database::search("SELECT * FROM `orders` WHERE `order_id`='" . $orderid . "' AND `user_id`='" . $userid . "'");
                        $order_data = $order_rs->fetch_assoc();
                ?>
                        <div class="flex-w flex-tr bg6 rounded-5 row p-3 m-2 mb-3">

                            <div class="col-12 col-sm-8">
                                <h5 class="mtext-111 cl5">
                                    Order Id : <span class="mtext-105"><?php echo $order_data['order_id'] ?></span>
                                </h5>
                                <h5 class="stext-110 cl5">
                                    Puchased On : <span class="stext-104"><?php echo $order_data['date'] ?></span>
                                </h5>
                            </div>
                            <div class="col-12 col-sm-4 text-end mt-3">
                                <a class="btn bg1 cl0 rounded-pill hov-btn1" href="invoice.php?orderid=<?php echo $orderid ?>">Print Invoice</a>
                            </div>
                            <div class="table-responsive mt-2">
                                <table class="table table-hover table-order-history">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-6">Title</th>
                                            <th scope="col" class="col-2">Price</th>
                                            <th scope="col" class="col-2">Qty</th>
                                            <th scope="col" class="col-2">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php
                                        $order_rs2 = Database::search("SELECT * FROM `orders` INNER JOIN `product` ON `orders`.`product_id` = `product`.`id` WHERE `orders`.`order_id` = '" . $order_data['order_id'] . "'");
                                        while ($item_d = $order_rs2->fetch_assoc()) {
                                            $size_rs = Database::search("SELECT * FROM `size` WHERE id='" . $item_d["size_id"] . "'");
                                            $sized = $size_rs->fetch_assoc();

                                            $item_total = $item_d["price"] * $item_d["qty"];
                                        ?>
                                            <tr>
                                                <td><?php echo $item_d["title"] ?> ( Size : <?php echo $sized["size"] ?> )</td>
                                                <td>Rs. <?php echo $item_d["price"] ?></td>
                                                <td><?php echo $item_d["qty"] ?></td>
                                                <td>Rs. <?php echo $item_total ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="col-12 col-sm-8 col-md-6 row ">
                                    <div class="col-6">
                                        <h5 class="mtext-106 cl5 m-r-25 text-end">
                                            Shipping :
                                        </h5>
                                    </div>
                                    <div class="col-5">
                                        <span class="mtext-107">Rs. 450</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="col-12 col-sm-8 col-md-6 row ">
                                    <div class="col-6">
                                        <h5 class="mtext-106 cl5 m-r-25 text-end">
                                            Total :
                                        </h5>
                                    </div>
                                    <div class="col-5">
                                        <span class="mtext-107">Rs. <?php echo $order_data['total'] ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="row col-12 d-flex justify-content-center align-items-center mt-5">
                        <span class="fw-bold text-black-50 text-center"><i class="fa-solid fa-clock-rotate-left h1" style="font-size: 100px;"></i></span>
                        <h3 class="col-12 text-center mb-3">No Order History</h3>
                        <a href="products.php" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-decoration-none col-md-4 col-sm-6 col-12 text-center">
                            Shop Now
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

<?php
} else {
    header("Location : account-log.php");
}
?>