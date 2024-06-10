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

        <title>Products Report | Admin @ Scorpex Clothing</title>
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
                            <h1 class="mb-2 fw-bold text-center">Report of Products</h1>

                            <!--  Active -->
                            <div class="card">
                                <?php
                                $active_rs = Database::search("SELECT * FROM `product`");
                                $active_n = $active_rs->num_rows;

                                ?>
                                <div class="card-body">
                                    <table class="table table-responsive table-hover table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">Title</th>
                                                <th scope="col" class="text-center">Description</th>
                                                <th scope="col" class="text-center">Category</th>
                                                <th scope="col" class="text-center">Material</th>
                                                <th scope="col" class="text-center">Status</th>
                                                <th scope="col" class="text-center">Price (Rs)</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-group-divider">
                                            <?php
                                            for ($i = 0; $i < $active_n; $i++) {
                                                $product_data = $active_rs->fetch_assoc();

                                                $cat_rs = Database::search("SELECT * FROM `category` WHERE id='". $product_data["category_id"]."'");
                                                $catd = $cat_rs->fetch_assoc();

                                                $mat_rs = Database::search("SELECT * FROM `material` WHERE id='" . $product_data["material_id"] . "'");
                                                $matd = $mat_rs->fetch_assoc();

                                                $id = $i + 1;
                                                $title = $product_data["title"];
                                                $description = $product_data["description"];
                                                $category = $catd["name"];
                                                $material = $matd["name"];
                                                $status = $product_data["status_id"];
                                                $price = $product_data["price"];
                                            ?>
                                                <tr>
                                                    <th scope='row'><?php echo $id ?></th>
                                                    <td><?php echo $title ?></td>
                                                    <td><?php echo $description ?></td>
                                                    <td><?php echo $category ?></td>
                                                    <td><?php echo $material ?></td>
                                                    <td>
                                                        <?php
                                                        if ($status == 0) {
                                                            echo "Deactive";
                                                        } else {
                                                            echo "Active";
                                                        }

                                                        ?>
                                                    </td>
                                                    <td><?php echo $price ?></td>
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