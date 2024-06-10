<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Confirm Order | Scorpex Clothing</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/fonts/linearicons-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" href="assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" href="assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendor/slick/slick.css">
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
                Buy Now
            </span>
        </div>
    </div>

    <!-- Shopping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        <div class="container" id="cartBody">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5 text-decoration-underline mb-3">
                    Order Details
                </h3>
            </div>

            <?php
            if (isset($_SESSION["u"])) {
                $session_data = $_SESSION["u"];
                $userid = $session_data["id"];

                $product_id = $_POST['product_id'];
                $product_title = $_POST['product_title'];
                $product_price = $_POST['product_price'];
                $product_sizeid = $_POST['size'];
                $product_qty = $_POST['product_qty'];

                $product_total = $product_price * $product_qty;

                $size_rs = Database::search("SELECT * FROM `size` WHERE id='" . $product_sizeid . "'");
                $size_d = $size_rs->fetch_assoc();
                $product_size = $size_d["size"];
            ?>
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1"></th>
                                        <th class="column-2">Product</th>
                                        <th class="column-3">Price</th>
                                        <th class="column-4">Qty</th>
                                        <th class="column-5">Total</th>
                                    </tr>

                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <?php
                                                $select_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_id . "'");
                                                $select_img_data = $select_img_rs->fetch_assoc();
                                                ?>
                                                <a href="<?php echo "viewProduct.php?id=" . ($cart_pid); ?>"><img src="assets/<?php echo $select_img_data["code"]; ?>" alt="IMG"></a>
                                            </div>
                                        </td>
                                        <td class="column-2">
                                            <div><?php echo $product_title ?></div>
                                            <div class="fw-bold fs-13">( Size : <?php echo $product_size ?> )</div>
                                        </td>
                                        <td class="column-3">Rs. <?php echo $product_price ?></td>
                                        <td class="column-4">
                                            <div class="text-center">
                                                <?php echo $product_qty ?>
                                            </div>
                                        </td>
                                        <td class="column-5">Rs. <?php echo $product_total ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <form action="buynow_checkout.php" method="POST">
                            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                                <h4 class="mtext-109 cl2 p-b-15">
                                    Shipping Address
                                </h4>

                                <div class="flex-w flex-t">
                                    <?php
                                    $address_rs = Database::search("SELECT * FROM `user_address` WHERE `user_id`='" . $userid . "'");
                                    $address_num = $address_rs->num_rows;

                                    if ($address_num > 0) {
                                    ?>
                                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                            <select class="form-select js-select2" id="shippingAddress">
                                                <option value="0" disabled>Select Shipping Address</option>
                                                <?php
                                                for ($i = 0; $i < $address_num; $i++) {
                                                    $address_data = $address_rs->fetch_assoc();

                                                    if ($i == 0) {
                                                ?>
                                                        <option selected value="<?php echo $address_data["id"] ?>"><?php echo $address_data["tag_name"] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $address_data["id"] ?>"><?php echo $address_data["tag_name"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                            <p class="stext-111 cl6 p-t-10" id="showAddress"></p>
                                            <a id="showAddressBtn" class="btn btn-primary btn-sm rounded-pill mt-2" onclick="showAddress();">
                                                View Address
                                            </a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                            <p class="stext-111 cl6 p-t-10">
                                                No Saved Address Found.
                                            </p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                                <h4 class="mtext-109 cl2 p-b-30">
                                    Cart Totals
                                </h4>

                                <div class="flex-w flex-t bor12 p-b-13">
                                    <div class="size-208">
                                        <span class="stext-110 cl2">
                                            Subtotal:
                                        </span>
                                    </div>

                                    <div class="size-209">
                                        <span class="mtext-110 cl2">
                                            Rs. <?php echo $product_total; ?>.00
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-w flex-t bor12 p-b-13 mt-3">
                                    <div class="size-208">
                                        <span class="stext-110 cl2">
                                            Shipping:
                                        </span>
                                    </div>

                                    <div class="size-209">
                                        <span class="mtext-110 cl2">
                                            Rs. 450.00
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-w flex-t p-t-27 p-b-33">
                                    <?php
                                    $order_total = $product_total + 450;
                                    ?>
                                    <div class="size-208">
                                        <span class="mtext-101 cl2">
                                            Total:
                                        </span>
                                    </div>

                                    <div class="size-209 p-t-1">
                                        <span class="mtext-110 cl2">
                                            Rs. <?php echo $order_total; ?>.00
                                        </span>
                                    </div>
                                </div>

                                <input type="hidden" name="total" value="<?php echo $order_total; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="product_title" value="<?php echo $product_title; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
                                <input type="hidden" name="product_qty" value="<?php echo $product_qty; ?>">
                                <input type="hidden" name="product_sizeid" value="<?php echo $product_sizeid; ?>">
                                <input type="hidden" name="selected_address" id="selected_address" value="">

                                <?php
                                $address_rs = Database::search("SELECT * FROM `user_address` WHERE `user_id`='" . $userid . "'");
                                $address_num = $address_rs->num_rows;

                                if ($address_num > 0) {
                                ?>
                                    <script>
                                        shipAddress =document.getElementById("shippingAddress");
                                        hiddenAddress =document.getElementById("selected_address");

                                        hiddenAddress.value =shipAddress.value;
                                    </script>
                                    <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">
                                        Proceed to Pay
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button class="flex-c-m stext-101 cl3 size-116 bg2 bor14 p-lr-15 trans-04" disabled>
                                        Select an Address to Continue
                                    </button>
                                <?php
                                }
                                ?>

                            </div>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const selectElement = document.querySelector('.js-select2');
                                const hiddenInput = document.getElementById('selected_address');

                                if (selectElement) {
                                    selectElement.addEventListener('change', function() {
                                        hiddenInput.value = this.value;
                                        console.log('Selected address:', this.value); // For debugging
                                        console.log('Hidden input value:', hiddenInput.value); // For debugging
                                    });
                                } else {
                                    console.error('Select element with class "js-select2" not found.');
                                }
                            });
                        </script>

                    </div>
                </div>
            <?php
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