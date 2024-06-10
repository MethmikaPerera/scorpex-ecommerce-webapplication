<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Sign In | Scorpex Clothing</title>
    <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png" />

    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

    <link rel="stylesheet" href="../assets/css/admin-styles.css" />
</head>

<body class="admin-body">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body" id="emailDiv">

                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../assets/img/logo-text-black.png" width="180" alt="">
                                </a>

                                <p class="text-center text-black fw-bold">Admin Login</p>

                                <div class="col-12 d-none" id="adminmsgdiv">
                                    <div class="alert" role="alert" id="adminmsg"></div>
                                </div>

                                <div>

                                    <?php
                                    $email = "";
                                    $password = "";

                                    if (isset($_COOKIE["admemail"])) {
                                        $email = $_COOKIE["admemail"];
                                    }

                                    if (isset($_COOKIE["admpassword"])) {
                                        $password = $_COOKIE["admpassword"];
                                    }
                                    ?>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label"><i class="fa-solid fa-envelope"></i> Email</label>
                                        <input type="email" value="<?php echo $email ?>" class="form-control" id="adminemail" aria-describedby="emailHelp" placeholder="Email">
                                    </div>

                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label"><i class="fa-solid fa-key"></i> Password</label>
                                        <input type="password" value="<?php echo $password ?>" class="form-control" id="adminpassword" placeholder="Password">
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check pointer">
                                            <input class="form-check-input primary" type="checkbox" value="" id="adminremember">
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>

                                    <button class="btn btn-indigo w-100 py-8 fs-4 mb-4 rounded-2" onclick="adminSignIn();">Sign In</button>
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
</body>

</html>