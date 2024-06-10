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

        <title>Admin Dashboard | Scorpex Clothing</title>
        <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />

        <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/all.css">
        <link rel="stylesheet" href="../assets/css/admin-styles.css" />
    </head>

    <body class="bg-dark">
        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed">
            <!-- Sidebar Start -->
            <?php require "adminSidebar.php"; ?>
            <!--  Sidebar End -->
            <!--  Main wrapper -->
            <div class="body-wrapper">
                <div class="container-fluid">
                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- Sales Number -->
                                    <div class="card overflow-hidden">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-1 fw-semibold">Number of Sales</h5>
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <?php
                                                    $sales_rs = Database::search("SELECT * FROM `orders`");
                                                    $sales_n = $sales_rs->num_rows;
                                                    ?>
                                                    <h1 class="fw-semibold mb-1"><?php echo ($sales_n); ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- Active Products -->
                                    <div class="card overflow-hidden">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-1 fw-semibold">Active Products</h5>
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <?php
                                                    $activep_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1'");
                                                    $activep_n = $activep_rs->num_rows;
                                                    ?>
                                                    <h1 class="fw-semibold mb-1"><?php echo ($activep_n); ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- Active Users -->
                                    <div class="card overflow-hidden">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-1 fw-semibold">Active Users</h5>
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <?php
                                                    $active_rs = Database::search("SELECT * FROM `users` WHERE `ban`='0'");
                                                    $active_n = $active_rs->num_rows;
                                                    ?>
                                                    <h1 class="fw-semibold mb-1"><?php echo ($active_n); ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="charts">
                        <div class="col-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4 row col-12 d-flex justify-content-center">
                                    <div class="card col-8 p-2 shadow-lg">
                                        <div>
                                            <h2 class="text-center">Most Sold Products</h2>
                                            <canvas id="mostSoldChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="card col-5 p-2 shadow-lg">
                                        <div>
                                            <h2 class="text-center">Most Sold Category</h2>
                                            <canvas id="mostCatChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="card col-5 offset-1 p-2 shadow-lg">
                                        <div>
                                            <h2 class="text-center">Most Sold Size</h2>
                                            <canvas id="mostSizeChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="../assets/js/admin-script.js"></script>
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.js"></script>
        <script src="../assets/js/sidebarmenu.js"></script>
        <script src="../assets/js/app.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                loadChart('mostSoldChart', 'loadMostSoldProducts.php', 'pie', 'Most Sold Products');
                loadChart('mostCatChart', 'loadMostSoldCategories.php', 'pie', 'Most Sold Categories');
                loadChart('mostSizeChart', 'loadMostSoldSize.php', 'pie', 'Most Sold Size');
            });
        </script>
    </body>

    </html>

<?php
} else {
    header('Location: adminSignin.php');
    exit;
}
?>