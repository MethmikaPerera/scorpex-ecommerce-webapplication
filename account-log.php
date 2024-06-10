<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign In or Sign Up | Scorpex Clothing</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/all.css">

    <link rel="stylesheet" href="assets/css/util.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="sign-body vh-100">
    <div class="comtainer-fluid d-flex justify-content-center">
        <div class="row align-content-center">
            <!-- header  -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                </div>
            </div>
            <!-- end header -->

            <!-- content -->
            <div class="col-12 mt-3">
                <div class="row text-center justify-content-center">
                    <!-- signup box -->
                    <div class="col-11 col-lg-6 bg-dark p-2 p-lg-5 sign-box" id="signupbox">
                        <div class="row g-1">
                            <div class="col-12 mt-2">
                                <p class="ltext-110">Create New Account</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert" role="alert" id="msg"></div>
                            </div>

                            <div class="col-6 mt-3">
                                <label class="form-label stext-104">First Name</label>
                                <input class="form-control stext-115" type="text" placeholder="ex: John" id="fname">
                            </div>
                            <div class="col-6 mt-3">
                                <label class="form-label stext-104">Last Name</label>
                                <input class="form-control stext-115" type="text" placeholder="ex: Doe" id="lname">
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label stext-104">Email</label>
                                <input class="form-control stext-115" type="email" placeholder="ex: john@company.com" id="email">
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label stext-104">Password</label>
                                <input class="form-control stext-115" type="password" placeholder="Password" id="password">
                            </div>
                            <div class="col-6 mt-3">
                                <label class="form-label stext-104">Mobile</label>
                                <input class="form-control stext-115" type="text" placeholder="ex: 0123456789" id="mobile">
                            </div>
                            <div class="col-6 mt-3">
                                <label class="form-label stext-104">Gender</label>
                                <select class="form-control form-select stext-115" id="gender">
                                    <option value="0">Select Your Gender</option>
                                    <?php
                                    require "connection.php";

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $d["id"] ?>">
                                            <?php echo $d["gender_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn4 p-lr-15 trans-04 text-decoration-none" onclick="signUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button class="flex-c-m stext-101 cl0 size-101 bg4 bor1 hov-btn4 p-lr-15 trans-04 text-decoration-none" onclick="changeView();">Already have an account</button>
                            </div>
                        </div>

                    </div>
                    <!-- signup box -->

                    <!-- signin box -->
                    <div class="col-11 col-lg-8 bg-dark p-2 p-lg-5 sign-box d-none" id="signinbox">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="ltext-110">Sign In</p>
                            </div>

                            <?php
                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }
                            ?>

                            <div class="col-12 d-none" id="simsgdiv">
                                <div class="alert" role="alert" id="simsg"></div>
                            </div>

                            <div class="col-12">
                                <label class="form-label stext-104">Email</label>
                                <input class="form-control stext-115" type="email" value="<?php echo $email; ?>" placeholder="ex: john@company.com" id="signinemail">
                            </div>
                            <div class="col-12">
                                <label class="form-label stext-104">Password</label>
                                <input class="form-control stext-115" type="password" value="<?php echo $password; ?>" placeholder="Password" id="signinpassword">
                            </div>

                            <div class="col-6 text-start">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                    <label class="form-check-label stext-107" for="rememberme">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 text-end fw-bold">
                                <a href="#" class="link-primary stext-107" onclick="forgotPassword();">Forgotten Password?</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid g-3">
                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn4 p-lr-15 trans-04 text-decoration-none" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid g-3">
                                <button class="flex-c-m stext-101 cl0 size-101 bg10 bor1 hov-btn4 p-lr-15 trans-04 text-decoration-none" onclick="changeView();">Join Now</button>
                            </div>
                        </div>

                    </div>
                    <!-- signin box -->
                </div>
            </div>
            <!-- end content -->

            <!-- modal -->
            <div class="modal text-black" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mtext-106">Forgot Password?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">

                                <div class="col-12">
                                    <label class="form-label stext-104">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control stext-115" id="np" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="shownp();">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label stext-104">Retype New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control stext-115" id="rnp" />
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showrnp();">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label stext-104">Verifiction Code</label>
                                    <input type="text" class="form-control stext-115" id="vc" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword()">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->


            <!-- footer -->
            <div class="col-12 d-none d-lg-block fixed-bottom mb-3">
                <p class="text-center text-dark stext-111">&copy; SCORPEX CLOTHING 2023 | All Rights Reserved</p>
            </div>
            <!-- end footer -->
        </div>
    </div>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>