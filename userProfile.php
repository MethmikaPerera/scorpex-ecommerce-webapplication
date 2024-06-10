<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <title>User Profile | Scorpex Clothing</title>

    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/fonts/linearicons-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" href="Vendor/animate/animate.css">
    <link rel="stylesheet" href="Vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" href="Vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="Vendor/select2/select2.min.css">
    <link rel="stylesheet" href="Vendor/slick/slick.css">
    <link rel="stylesheet" href="Vendor/sweetalert/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/util.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="animsition" onload="loadAddress();">

    <?php
    require "header.php";
    ?>

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                User Profile
            </span>
        </div>
    </div>

    <?php



    ?>

    <?php
    if (isset($_SESSION["u"])) {
        $session_data = $_SESSION["u"];
        $user_search_id = $session_data["id"];

        $user_rs = Database::search("SELECT * FROM `users` WHERE `id`='" . $user_search_id . "'");
        $user_d = $user_rs->fetch_assoc();
    }
    ?>

    <div class="container mb-5 mt-5">
        <div class="user-body">
            <div class="row gutters-sm">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <?php
                                $select_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_d["email"] . "'");
                                $select_img_data = $select_img_rs->fetch_assoc();
                                ?>
                                <img src="./<?php echo $select_img_data["path"]; ?>" alt="Admin" class="rounded-circle" width="150" />
                                <div class="mt-3">
                                    <h4><?php echo $user_d["fname"] . " " . $user_d["lname"]; ?></h4>
                                    <p class="text-muted font-size-sm">Member scince <?php echo $user_d["joined_date"] ?></p>
                                    <button class="btn bg1 cl0 hov-btn1 rounded-pill mt-2" onclick="updateProfileImgView();">Update Profile Photo</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="d-flex align-items-center mb-3 fw-bold">
                                <i class="fa-solid fa-key p-1"></i> Change Password
                            </h6>
                            <div class="row mt-4 mb-3">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Current Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control stext-115" id="cp" placeholder="Current Password" />
                                            <button class="btn btn-outline-secondary bg3 cl0 rounded-end" type="button" id="cpb" onclick="showcp();">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control stext-115" id="np" placeholder="New Password" />
                                            <button class="btn btn-outline-secondary bg3 cl0 rounded-end" type="button" id="npb" onclick="shownp();">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-danger hov-btn1 rounded-pill" onclick="changeUserPassword();">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Profile Image Modal -->
                <div class="modal" tabindex="-1" id="profileImageUpdateModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Profile Photo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Select a photo</label>
                                    <input class="form-control" type="file" id="newdp">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn bg1 cl0 hov-btn1 rounded-pill" onclick="updateProfileImg();">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update Profile Image Modal -->

                <div class="col-md-8">
                    <div class="card mb-3" id="user-details">
                        <div class="card-body">
                            <h6 class="d-flex align-items-center mb-4 fw-bold">
                                <i class="fa-regular fa-circle-user p-1"></i> User Details
                            </h6>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php echo $user_d["fname"] . " " . $user_d["lname"]; ?></div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php echo $user_d["email"] ?></div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Gender</h6>
                                </div>

                                <?php
                                $user_gender = $user_d["gender_id"];
                                $gender_rs = Database::search("SELECT * FROM `gender` WHERE `id`='" . $user_gender . "'");
                                $gender_d = $gender_rs->fetch_assoc();
                                ?>

                                <div class="col-sm-9 text-secondary"><?php echo $gender_d["gender_name"] ?></div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"><?php echo $user_d["mobile"] ?></div>
                            </div>
                            <hr />
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button class="btn bg1 cl0 hov-btn1 rounded-pill" onclick="updateProfileChangeView();">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3 d-none" id="user-update">
                        <div class="card-body">
                            <h6 class="d-flex align-items-center mb-4 fw-bold">
                                <i class="fa-solid fa-pen-to-square p-1"></i> Update User Details (ID : <?php echo $user_search_id ?>)
                            </h6>
                            <div class="row">
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="user-fname" value="<?php echo $user_d["fname"] ?>">
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="user-lname" value="<?php echo $user_d["lname"] ?>">
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="user-email" value="<?php echo $user_d["email"] ?>" disabled>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="inputCity" class="form-label">Gender</label>
                                    <select class="form-control form-select" id="user-gender" disabled>
                                        <?php
                                        $user_gender = $user_d["gender_id"];
                                        $gender_rs = Database::search("SELECT * FROM `gender` WHERE `id`='" . $user_gender . "'");
                                        $gender_d = $gender_rs->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $gender_d["id"] ?>" selected>
                                            <?php echo $gender_d["gender_name"]; ?>
                                        </option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="inputEmail4" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="user-mobile" value="<?php echo $user_d["mobile"] ?>">
                                </div>
                            </div>
                            <hr />
                            <div class="row mt-4">
                                <div class="col-12">
                                    <a href="#" class="btn btn-warning hov-btn1 rounded-pill" onclick="updateProfile();">Save</a>
                                    <button class="btn btn-secondary hov-btn3 rounded-pill" onclick="updateProfileChangeView();">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gutters-sm">
                        <div class="col-sm-12 mb-3">
                            <div class="card h-100">
                                <div class="card-body" id="addressBody">



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require "footer.php";
    ?>


    <!--===============================================================================================-->
    <script src="Vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="Vendor/animsition/js/animsition.min.js"></script>
    <script src="Vendor/bootstrap/js/popper.js"></script>
    <script src="Vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="Vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="Vendor/slick/slick.min.js"></script>
    <script src="assets/js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script src="Vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script src="Vendor/sweetalert/sweetalert2.all.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/js/main.js"></script>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
</body>

</html>