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

    <title>Manage Products | Admin @ Scorpex Clothing</title>
    <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />

    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../Vendor/sweetalert/sweetalert2.min.css">

    <link rel="stylesheet" href="../assets/css/admin-styles.css" />
</head>

<body class="bg-dark" onload="loadProducts();">
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
                <div class="card">
                    <div class="card-body text-center" id="productBody">
                        <h3 class="fw-bold mb-4 text-center">Manage Products</h3>
                        <div class="btn-group mb-3" role="group">
                            <button id="activeproductsbtn" type="button" class="btn btn-dark" onclick="changeActiveView();">Active Products</button>
                            <button id="deactiveproductsbtn" type="button" class="btn btn-outline-dark" onclick="changeDeactiveView();">Deactive Products</button>
                        </div>

                        <!--  Active -->
                        <div class="row" id="activeproducts">



                        </div>

                        <!--  Deactive -->
                        <div class="row d-none" id="deactiveproducts">



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../assets/js/admin-script.js"></script>
    <script src="../Vendor/jquery/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../Vendor/apexcharts/dist/apexcharts.min.js"></script>
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