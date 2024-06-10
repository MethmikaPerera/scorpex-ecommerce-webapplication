<?php
session_start();

require "../connection.php";

if (isset($_SESSION["a"])) {

    if (isset($_GET["id"])) {

        $id = $_GET["id"];

?>

        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>Update Product | Admin @ Scorpex Clothing</title>
            <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />

            <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
            <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

            <link rel="stylesheet" href="../Vendor/sweetalert/sweetalert2.min.css">

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
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="fw-bold mb-4 text-center">Update Product</h1>

                                    <?php
                                    $prs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
                                    $pd = $prs->fetch_assoc();
                                    ?>

                                    <div class="col-12 d-none" id="updateproductmsgdiv">
                                        <div class="alert" role="alert" id="updateproductmsg"></div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <input disabled type="hidden" class="form-control" id="productid" value="<?php echo $pd["id"] ?>">

                                                <div class="mb-3 col-12">
                                                    <label class="form-label">Product Title</label>
                                                    <input type="text" class="form-control" id="producttitle" value="<?php echo $pd["title"] ?>">
                                                </div>

                                                <div class="mb-3 col-12">
                                                    <label class="form-label">Product Description</label>
                                                    <textarea class="form-control" id="productdescription" rows="5" style="resize: none;"> <?php echo $pd["description"] ?></textarea>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-control form-select" id="productcategory">
                                                        <?php
                                                        $pcatid = $pd["category_id"];
                                                        $pcatrs = Database::search("SELECT * FROM `category` WHERE `id`='" . $pcatid . "'");
                                                        $pcatd = $pcatrs->fetch_assoc();
                                                        ?>

                                                        <option selected disabled><?php echo $pcatd["name"] ?></option>
                                                        <option>Select Category</option>

                                                        <?php
                                                        $catrs = Database::search("SELECT * FROM `category`");
                                                        $catn = $catrs->num_rows;

                                                        for ($x = 0; $x < $catn; $x++) {
                                                            $catd = $catrs->fetch_assoc();

                                                        ?>
                                                            <option value="<?php echo $catd["id"] ?>">
                                                                <?php echo $catd["name"]; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Add a Category</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="New Category" id="newcategory">
                                                        <button class="btn btn-primary" type="button" id="button-addon2" onclick="updateNewCategory();">Add</button>
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Material</label>
                                                    <select class="form-control form-select" id="productmaterial">
                                                        <?php
                                                        $pmatid = $pd["material_id"];
                                                        $pmatrs = Database::search("SELECT * FROM `material` WHERE `id`='" . $pmatid . "'");
                                                        $pmatd = $pmatrs->fetch_assoc();
                                                        ?>

                                                        <option selected disabled><?php echo $pmatd["name"] ?></option>
                                                        <option>Select Material</option>
                                                        <?php

                                                        $matrs = Database::search("SELECT * FROM `material`");
                                                        $matn = $matrs->num_rows;

                                                        for ($x = 0; $x < $matn; $x++) {
                                                            $matd = $matrs->fetch_assoc();

                                                        ?>
                                                            <option value="<?php echo $matd["id"] ?>">
                                                                <?php echo $matd["name"]; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Add a Material</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="New Material" id="newmaterial">
                                                        <button class="btn btn-primary" type="button" id="button-addon2" onclick="updateNewMaterial();">Add</button>
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Price</label>
                                                    <input type="text" class="form-control" id="productprice" value="<?php echo $pd["price"] ?>">
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Product Image</label>
                                                    <div class="input-group mb-3 col-4">
                                                        <input type="file" class="form-control" id="productimg">
                                                    </div>
                                                </div>
                                                <button class="btn btn-secondary" onclick="updateProduct();">Update Product</button>
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
            <script src="../Vendor/jquery/jquery.min.js"></script>
            <script src="../assets/js/bootstrap.bundle.js"></script>
            <script src="../assets/js/sidebarmenu.js"></script>
            <script src="../assets/js/app.min.js"></script>
            <script src="../Vendor/apexcharts/dist/apexcharts.min.js"></script>
            <script src="../assets/js/dashboard.js"></script>
            <script src="../Vendor/sweetalert/sweetalert2.all.min.js"></script>
        </body>

        </html>
<?php
    }
} else {
    header('Location: adminSignin.php');
    exit;
}
?>