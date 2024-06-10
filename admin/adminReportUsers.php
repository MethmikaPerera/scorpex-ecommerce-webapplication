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

        <title>User Report | Admin @ Scorpex Clothing</title>
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
                            <h1 class="mb-2 fw-bold text-center">Report of Users</h1>

                            <!--  Active -->
                            <div class="card">
                                <?php
                                $active_rs = Database::search("SELECT * FROM `users`");
                                $active_n = $active_rs->num_rows;

                                ?>
                                <div class="card-body">
                                    <table class="table table-responsive table-hover table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">First Name</th>
                                                <th scope="col" class="text-center">Last Name</th>
                                                <th scope="col" class="text-center">Email</th>
                                                <th scope="col" class="text-center">Mobile</th>
                                                <th scope="col" class="text-center">Status</th>
                                                <th scope="col" class="text-center">Joined Date</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-group-divider">
                                            <?php
                                            for ($i = 0; $i < $active_n; $i++) {
                                                $user_data = $active_rs->fetch_assoc();

                                                $id = $i + 1;
                                                $fname = $user_data["fname"];
                                                $lname = $user_data["lname"];
                                                $email = $user_data["email"];
                                                $mobile = $user_data["mobile"];
                                                $joined_date = $user_data["joined_date"];
                                                $status = $user_data["ban"];
                                            ?>
                                                <tr>
                                                    <th scope='row'><?php echo $id ?></th>
                                                    <td><?php echo $fname ?></td>
                                                    <td><?php echo $lname ?></td>
                                                    <td><?php echo $email ?></td>
                                                    <td><?php echo $mobile ?></td>
                                                    <td>
                                                        <?php
                                                        if ($status == 0) {
                                                            echo "Active";
                                                        } else {
                                                            echo "Blocked";
                                                        }

                                                        ?>
                                                    </td>
                                                    <td><?php echo $joined_date ?></td>
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