<?php
session_start();

require "../connection.php";

if (isset($_SESSION["a"])) {
?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reports | Admin @ Scorpex Clothing</title>
        <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />

        <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

        <link rel="stylesheet" href="../assets/css/admin-styles.css" />
    </head>

    <body class="bg-dark">
        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed">
            <!-- Sidebar Start -->
            <?php
            require "adminSidebar.php";
            ?>
            <!--  Sidebar End -->
            <!--  Main wrapper -->
            <div class="body-wrapper">
                <div class="container-fluid">
                    <div class="card d-flex justify-content-center">
                        <div class="p-2 text-end" onclick="printPage();">
                            <button class="btn btn-danger">Print Report</button>
                        </div>
                        <div class="card-body text-center" id="page">
                            <h1 class="mb-2 fw-bold text-center">Report of Sales</h1>

                            <!--  Active -->
                            <div class="card">
                                <?php
                                $active_rs = Database::search("SELECT * FROM `orders`");
                                $active_n = $active_rs->num_rows;

                                ?>
                                <div class="card-body">
                                    <table class="table table-responsive table-hover table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">Order Id</th>
                                                <th scope="col" class="text-center">Order Date</th>
                                                <th scope="col" class="text-center">Product</th>
                                                <th scope="col" class="text-center">Size</th>
                                                <th scope="col" class="text-center">Qty</th>
                                                <th scope="col" class="text-center">Total</th>
                                                <th scope="col" class="text-center">User</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-group-divider">
                                            <?php
                                            for ($i = 0; $i < $active_n; $i++) {
                                                $order_data = $active_rs->fetch_assoc();

                                                $user_rs = Database::search("SELECT * FROM `users` WHERE id='" . $order_data["user_id"] . "'");
                                                $user_data = $user_rs->fetch_assoc();

                                                $p_rs = Database::search("SELECT * FROM `product` WHERE id='" . $order_data["product_id"] . "'");
                                                $pd = $p_rs->fetch_assoc();

                                                $size_rs = Database::search("SELECT * FROM `size` WHERE id='" . $order_data["size_id"] . "'");
                                                $sized = $size_rs->fetch_assoc();

                                                $id = $i + 1;
                                                $oid = $order_data["order_id"];
                                                $odate = $order_data["date"];
                                                $title = $pd["title"];
                                                $size = $sized["size"];
                                                $qty = $order_data["qty"];
                                                $total = $order_data["total"];
                                                $user_fname = $user_data["fname"];
                                                $user_lname = $user_data["lname"];
                                            ?>
                                                <tr>
                                                    <th scope='row'><?php echo $id ?></th>
                                                    <td><?php echo $oid ?></td>
                                                    <td><?php echo $odate ?></td>
                                                    <td><?php echo $title ?></td>
                                                    <td><?php echo $size ?></td>
                                                    <td><?php echo $qty ?></td>
                                                    <td><?php echo $total ?></td>
                                                    <td><?php echo $user_fname . " " . $user_lname ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="../assets/js/admin-script.js"></script>
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/vendor/apexcharts/dist/apexcharts.min.js"></script>
        <script src="../assets/vendor/simplebar/dist/simplebar.js"></script>
        <script src="../assets/js/dashboard.js"></script>
    </body>

    </html>

<?php
} else {
    header('Location: adminSignin.php');
    exit;
}
?>