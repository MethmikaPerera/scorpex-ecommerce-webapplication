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

        <title>Add Stock | Admin @ Scorpex Clothing</title>
        <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />

        <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

        <link rel="stylesheet" href="../Vendor/sweetalert/sweetalert2.min.css">

        <link rel="stylesheet" href="../assets/css/admin-styles.css" />
    </head>

    <body class="bg-dark" onload="loadNoStockProducts();">
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
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="fw-bold mb-4 text-center">Add Stock</h1>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="mb-3 col-12 row" id="productiddiv">

                                            </div>
                                            <div class="mb-3 mt-3 col-12 row">
                                                <label class="form-label col-12">Available Sizes (If not Available put 0)</label>

                                                <div class="mb-3 col-12">
                                                    <div class="mb-3 col-12 row">

                                                        <?php

                                                        $rs = Database::search("SELECT * FROM `size`");
                                                        $n = $rs->num_rows;

                                                        for ($x = 0; $x < $n; $x++) {
                                                            $d = $rs->fetch_assoc();
                                                            $sid = $d["id"];

                                                        ?>

                                                            <div class="input-group mb-3 col-12">
                                                                <span class="input-group-text col-3">Size : <?php echo $d["size"] ?></span>
                                                                <input type="hidden" value="<?php echo $d["id"] ?>" id="sizeid">
                                                                <input type="text" class="form-control" placeholder="Enter Quantity" id="<?php echo $d["id"] ?>stockqty">
                                                                <button class="btn btn-primary col-3" type="button" id="stockaddbtn<?php echo $d["id"] ?>" onclick="addStock(<?php echo $d['id'] ?>);">Add</button>
                                                            </div>

                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script src="../assets/js/app.min.js"></script>
        <script src="../assets/vendor/apexcharts/dist/apexcharts.min.js"></script>
        <script src="../assets/js/dashboard.js"></script>
        <script src="../Vendor/sweetalert/sweetalert2.all.min.js"></script>
    </body>

    </html>

<?php
} else {
    header('Location: adminSignin.php');
    exit;
}
?>