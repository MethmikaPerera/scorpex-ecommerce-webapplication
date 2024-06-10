<?php

require "connection.php";

$pageno = 0;
$page = $_POST["pg"];

$txt = $_POST['txt'];
$cat_id = $_POST['cat'];
$mat_id = $_POST['mat'];
$min = $_POST['min'];
$max = $_POST['max'];

if ($page != 0) {
    $pageno = $page;
} else {
    $pageno = 1;
}

// Base query
$q = "SELECT * FROM `product` WHERE `status_id`='1'";

// Search By Title
if (!empty($txt)) {
    $q .= " AND `title` LIKE '%$txt%'";
}

// Search By Category
if ($cat_id != 0) {
    $q .= " AND `category_id` = '" . $cat_id . "'";
}

// Search By Material
if ($mat_id != 0) {
    $q .= " AND `material_id` = '" . $mat_id . "'";
}

// Search By Min Price
if (!empty($min)) {
    $q .= " AND `price` >= '" . $min . "'";
}

// Search By Max Price
if (!empty($max)) {
    $q .= " AND `price` <= '" . $max . "'";
}

// Search By Price Range
if (!empty($max) && !empty($min)) {
    $q .= " AND `price` BETWEEN '" . $min . "' AND '" . $max . "' ORDER BY `price` ASC";
}

$rs = Database::search($q);
$num = $rs->num_rows;

// Pagination logic
$results_per_page = 8;
$num_of_pages = ceil($num / $results_per_page);
$page_results = ($pageno - 1) * $results_per_page;

$q2 = $q . " LIMIT $results_per_page OFFSET $page_results";

$rs2 = Database::search($q2);
$num2 = $rs2->num_rows;

if ($num2 == 0) {
?>
    <div class="offset-5 col-2 mt-5">
        <span class="fw-bold text-black-50"><i class="fa-regular fa-face-frown h1" style="font-size: 100px;"></i></span>
    </div>
    <div class="offset-3 col-6 mt-3 mb-5">
        <span class="h1 text-black-50 fw-bold">No Items Found</span>
    </div>
    <?php
} else {
    for ($i = 0; $i < $num2; $i++) {
        $product = $rs2->fetch_assoc();
    ?>
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $product["category_id"]; ?>">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <?php
                    $active_img_rs = Database::searchPrepared("SELECT * FROM `product_images` WHERE `product_id`=?", [$product["id"]], "i");
                    $active_img_data = $active_img_rs->fetch_assoc();
                    ?>
                    <img src="assets/<?php echo $active_img_data["code"]; ?>" alt="IMG-PRODUCT">
                    <a href='<?php echo "viewProduct.php?id=" . ($product["id"]); ?>' class="block2-btn flex-c-m stext-103 cl0 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04 btn-purple">View Product</a>
                </div>
                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l">
                        <a href='<?php echo "viewProduct.php?id=" . ($product["id"]); ?>' class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            <?php echo $product["title"]; ?>
                        </a>
                        <span class="stext-105 cl3">
                            LKR <?php echo $product["price"]; ?>.00
                        </span>
                    </div>
                    <div class="block2-txt-child2 flex-r p-t-3">
                        <?php
                        if (isset($_SESSION["u"])) {
                            $session_data = $_SESSION["u"];
                            $uw_rs = Database::searchPrepared("SELECT * FROM `watchlist` WHERE `user_id`=? AND `product_id`=?", [$session_data["id"], $product["id"]], "ii");
                            $uw_num = $uw_rs->num_rows;

                            if ($uw_num > 0) {
                                $uw_data = $uw_rs->fetch_assoc();
                        ?>
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative text-danger text-decoration-none" onclick="removeFromWatchlist(<?php echo $uw_data['id'] ?>);">
                                    <i class="fas fa-heart icon-heart1 dis-block trans-04"></i>
                                    <i class="fas fa-heart-broken icon-heart2 dis-block trans-04 ab-t-l"></i>
                                </a>
                            <?php
                            } else {
                            ?>
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative text-danger text-decoration-none" onclick="addToWatchlist(<?php echo $product['id'] ?>);">
                                    <i class="far fa-heart icon-heart1 dis-block trans-04"></i>
                                    <i class="fab fa-gratipay icon-heart2 dis-block trans-04 ab-t-l"></i>
                                </a>
                            <?php
                            }
                        } else {
                            ?>
                            <a href="#" class="btn-addwish-b2 dis-block pos-relative text-danger text-decoration-none" onclick="addToWatchlist(<?php echo $product['id'] ?>);">
                                <i class="far fa-heart icon-heart1 dis-block trans-04"></i>
                                <i class="fas fa-heart icon-heart2 dis-block trans-04 ab-t-l"></i>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- pagination -->
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a href="#" class="page-link" <?php if ($pageno <= 1) {
                                                                        echo ("#");
                                                                    } else { ?>onclick="advancedSearch(<?php echo ($pageno - 1); ?>);" <?php } ?>>Previous</a></li>
                <?php
                for ($y = 1; $y <= $num_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a href="#" class="page-link" onclick="advancedSearch(<?php echo $y; ?>);"><?php echo $y; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a href="#" class="page-link" onclick="advancedSearch(<?php echo $y; ?>);"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }
                ?>
                <li class="page-item"><a href="#" class="page-link" <?php if ($pageno >= $num_of_pages) {
                                                                        echo ("#");
                                                                    } else { ?>onclick="advancedSearch(<?php echo ($pageno + 1); ?>);" <?php } ?>>Next</a></li>
            </ul>
        </nav>
    </div>
    <!-- pagination -->
<?php
}
?>