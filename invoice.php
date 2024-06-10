<?php
session_start();
require "connection.php";

if (isset($_SESSION['u'])) {
  $session_data = $_SESSION['u'];
  $userid = $session_data['id'];
  $user_fname = $session_data['fname'];
  $user_lname = $session_data['lname'];
  $user_mobile = $session_data['mobile'];

  if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];

    $order_rs = Database::search("SELECT * FROM `orders` WHERE order_id='" . $orderid . "' AND user_id='" . $userid . "'");
    $order_num = $order_rs->num_rows;

    if ($order_num > 0) {
      $order_d = $order_rs->fetch_assoc();

?>

      <!DOCTYPE html>
      <html lang="en">

      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

        <!-- Custom Style -->
        <link rel="stylesheet" href="assets/css/invoice-style.css" />

        <title>Invoice | Scorpex Clothing</title>
        <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">
      </head>

      <body>
        <div class="col-12">
          <div class="col-12 row d-flex justify-content-center">
            <div class="col-4 btn-group mt-4">
              <button class="btn btn-success" onclick="printInvoice();"><i class="fa-solid fa-print"></i> Print</button>
              <button class="btn btn-danger" onclick="printInvoice();"><i class="fa-solid fa-floppy-disk"></i> Export as PDF</button>
              <a class="btn btn-secondary" href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            </div>
          </div>

          <div class="my-5 page shadow" id="page">
            <div class="p-5">
              <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                  <img src="assets\img\logo-text-black.png" alt="" class="img-fluid" />
                </div>
                <div class="top-left">
                  <div class="position-relative text-end fw-bold mt-2">
                    <h1>INVOICE</h1>
                  </div>
                </div>
              </section>

              <section class="store-user mt-3">
                <div class="col-10">
                  <div class="row bb pb-3">
                    <div class="col-7">
                      <p>Customer:</p>
                      <?php
                      $address_rs = Database::search("SELECT * FROM `user_address` WHERE id='" . $order_d['address_id'] . "' AND user_id='" . $userid . "'");
                      $address_data = $address_rs->fetch_assoc();

                      $district_rs = Database::search("SELECT * FROM `district` WHERE id='" . $address_data['district_id'] . "'");
                      $district_data = $district_rs->fetch_assoc();

                      $address_no = $address_data['no'];
                      $address_line1 = $address_data['line1'];
                      $address_line2 = $address_data['line2'];
                      $address_city = $address_data['city'];
                      $address_postal = $address_data['postal_code'];
                      ?>
                      <p><?php echo $user_fname . " " . $user_lname ?></p>
                      <p class="address"><?php echo $address_no . ", " . $address_line1 . "," ?></p>
                      <p class="address"><?php echo $address_line2 . ", " . $address_city . "." ?></p>
                      <p class="address">Postal Code : <?php echo $address_postal ?></p>
                      <div class="txn">Tel : <?php echo $user_mobile ?></div>
                    </div>
                    <div class="col-5">
                      <p>OrderID: <span>#<?php echo $orderid ?></span></p>
                      <p>Delivered: <span><?php echo $order_d['date'] ?></span></p>
                      <p>Payment Method: <span>Debit/Credit</span></p>
                    </div>
                  </div>
                </div>
              </section>

              <section class="product-area">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <td>Item Description</td>
                      <td>Price</td>
                      <td>Quantity</td>
                      <td>Total</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $order_drs = Database::search("SELECT * FROM `orders` WHERE order_id='" . $orderid . "' AND user_id='" . $userid . "'");
                    $order_dnum = $order_rs->num_rows;

                    for ($i = 0; $i < $order_dnum; $i++) {
                      $order_data = $order_drs->fetch_assoc();

                      $product_rs = Database::search("SELECT * FROM `product` WHERE id='" . $order_data['product_id'] . "'");
                      $product_data = $product_rs->fetch_assoc();

                      $size_rs = Database::search("SELECT * FROM `size` WHERE id='" . $order_data['size_id'] . "'");
                      $size_d = $size_rs->fetch_assoc();
                    ?>
                      <tr>
                        <td>
                          <div class="media">
                            <div class="media-body">
                              <p class="mt-0 title"><?php echo $product_data['title'] ?></p>
                              Size : <?php echo $size_d['size'] ?>
                            </div>
                          </div>
                        </td>
                        <td><span>Rs </span><?php echo $product_data['price'] ?></td>
                        <td><?php echo $order_d['qty'] ?></td>
                        <td><span>Rs </span><?php echo $product_data['price'] * $order_d['qty'] ?></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </section>

              <section class="balance-info">
                <div class="row">
                  <div class="col-8">
                    <p class="m-0 fw-bold mt-5">Thank You for Shopping with Us.</p>
                  </div>
                  <div class="col-4 pe-4">
                    <table class="table border-0 table-hover">
                      <tr>
                        <td>Sub Total:</td>
                        <td class="text-end"><?php echo $order_d['total'] - 450 ?></td>
                      </tr>
                      <tr>
                        <td>Shipping:</td>
                        <td class="text-end">450</td>
                      </tr>
                      <tfoot>
                        <tr>
                          <td>Total:</td>
                          <td class="text-end">Rs <span><?php echo $order_d['total'] ?></span></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>


        <script src="assets/js/bootstrap.bundle.js"></script>
        <script src="assets/js/script.js"></script>
      </body>

      </html>

<?php
    } else {
      echo "Incorrect Order Id";
    }
  } else {
    header("Location : orderHistory.php");
  }
} else {
  header("Location : index.php");
}
?>