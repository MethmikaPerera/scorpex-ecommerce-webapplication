<?php
session_start();

require "connection.php";
?>

<script>
    window.onload
</script>

<div class="p-b-10">
    <h3 class="ltext-103 cl5 text-decoration-underline mb-3">
        Your Cart
    </h3>
</div>

<?php
if (isset($_SESSION["u"])) {
    $session_data = $_SESSION["u"];
    $userid = $session_data["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id`='" . $userid . "'");
    $cart_num = $cart_rs->num_rows;

    if ($cart_num < 1) {
?>
        <div class="row col-12 d-flex justify-content-center align-items-center mt-5">
            <span class="fw-bold text-black-50 text-center"><i class="fa-solid fa-cart-shopping h1" style="font-size: 100px;"></i></span>
            <h3 class="col-12 text-center mb-3 mt-3">Cart is Empty.</h3>
            <a href="products.php" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-decoration-none col-md-4 col-sm-6 col-12 text-center">
                Shop Now
            </a>
        </div>
    <?php
    } else {
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

                            <?php
                            $cart_subtotal = 0;
                            for ($x = 0; $x < $cart_num; $x++) {
                                $cart_data = $cart_rs->fetch_assoc();

                                $cart_id = $cart_data["id"];
                                $cart_pid = $cart_data["product_id"];
                                $cart_sid = $cart_data["size_id"];
                                $cart_qty = $cart_data["qty"];

                                $cartp_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_pid . "'");
                                $cartp_data = $cartp_rs->fetch_assoc();

                                $size_rs = Database::search("SELECT * FROM `size` WHERE `id`='" . $cart_sid . "'");
                                $size_data = $size_rs->fetch_assoc();

                                $product_price = $cartp_data["price"];
                                $product_total = $product_price * $cart_qty;
                                $cart_subtotal += $product_total;
                            ?>

                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <?php
                                            $select_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $cart_pid . "'");
                                            $select_img_data = $select_img_rs->fetch_assoc();
                                            ?>
                                            <a href="<?php echo "viewProduct.php?id=" . ($cart_pid); ?>"><img src="assets/<?php echo $select_img_data["code"]; ?>" alt="IMG"></a>
                                        </div>
                                    </td>
                                    <td class="column-2">
                                        <div><?php echo $cartp_data["title"] ?></div>
                                        <div class="fw-bold fs-13">( Size : <?php echo $size_data["size"] ?> )</div>
                                        <div>
                                            <a href="#" class="btn btn-sm btn-danger rounded-pill mt-2" id="delete-btn" onclick="removeFromCart(<?php echo $cart_id ?>);">
                                                Remove Item
                                            </a>
                                        </div>
                                    </td>
                                    <td class="column-3">Rs. <?php echo $product_price ?></td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="decCartQty(<?php echo $cart_id ?>);">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" id="qty<?php echo $cart_id ?>" type="number" name="num-product1" value="<?php echo $cart_qty ?>" disabled>

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="incCartQty(<?php echo $cart_id ?>);">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5">Rs. <?php echo $product_total ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <form action="checkout.php" method="POST">
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
                                    <select class="form-select js-select2 cart-address" id="shippingAddress">
                                        <option value="0" disabled>Select Shipping Address</option>
                                        <?php
                                        for ($i = 0; $i < $address_num; $i++) {
                                            $address_data = $address_rs->fetch_assoc();
                                        ?>
                                                <option value="<?php echo $address_data["id"] ?>"><?php echo $address_data["tag_name"] ?></option>
                                        <?php
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
                                    Rs. <?php echo $cart_subtotal; ?>.00
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
                            $cart_total = $cart_subtotal + 450;
                            ?>
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Total:
                                </span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2">
                                    Rs. <?php echo $cart_total; ?>.00
                                </span>
                            </div>
                        </div>

                        <input type="hidden" name="total" value="<?php echo $cart_total; ?>">
                        <input type="hidden" name="items" value="<?php echo $cart_num; ?>">
                        <input type="hidden" name="selected_address" id="selected_address" value="">

                        <script>
                            shipAddress = document.getElementById("shippingAddress");
                            hiddenAddress = document.getElementById("selected_address");

                            hiddenAddress.value = shipAddress.value;
                        </script>

                        <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">
                            Proceed to Checkout
                        </button>

                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectElement = document.querySelector('.cart-address');
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