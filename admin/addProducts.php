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

    <title>Add Product | Admin @ Scorpex Clothing</title>
    <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />

    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

    <link rel="stylesheet" href="../Vendor/sweetalert/sweetalert2.min.css">

    <link rel="stylesheet" href="../assets/css/admin-styles.css" />
</head>

<body class="bg-dark" onload="addProductLoad();">
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
                            <h1 class="fw-bold mb-4 text-center">Add a Product</h1>
                            <div class="col-12 d-none" id="addproductmsgdiv">
                                <div class="alert" role="alert" id="addproductmsg"></div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-12">
                                            <label class="form-label">Product Title</label>
                                            <input type="text" class="form-control" id="addproducttitle">
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Product Description</label>
                                            <textarea class="form-control" id="addproductdescription" rows="5" style="resize: none;"></textarea>
                                        </div>

                                        <div class="mb-3 col-6" id="categorydiv">



                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label">Add a Category</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="New Category" id="newcategory">
                                                <button class="btn btn-primary" type="button" id="button-addon2" onclick="addNewCategory();">Add</button>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-6" id="materialdiv">



                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label">Add a Material</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="New Material" id="newmaterial">
                                                <button class="btn btn-primary" type="button" id="button-addon2" onclick="addNewMaterial();">Add</button>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label">Price</label>
                                            <input type="text" class="form-control" id="addproductprice">
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label">Product Image</label>
                                            <div class="input-group mb-3 col-4">
                                                <input type="file" class="form-control" id="addproductimg">
                                            </div>
                                        </div>
                                        <button class="btn btn-secondary" onclick="addProduct();">Add Product</button>
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