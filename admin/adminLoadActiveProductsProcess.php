<?php

require "../connection.php";

$active_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1' ORDER BY datetime_added DESC");
$active_num = $active_rs->num_rows;

?>

<div class="col-lg-12">
    <div class="row">

        <?php
        if ($active_num < 1) {
        ?>
            <h3 class="mt-5">No Active Products Available...</h3>
            <?php
        } else {
            for ($x = 0; $x < $active_num; $x++) {
                $active_data = $active_rs->fetch_assoc();
            ?>

                <div class="card m-2" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-4 d-flex align-items-center justify-content-center">

                            <?php

                            $active_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $active_data["id"] . "'");
                            $active_img_data = $active_img_rs->fetch_assoc();

                            ?>

                            <img src="../assets/<?php echo $active_img_data["code"]; ?>" class="img-fluid rounded">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $active_data["title"]; ?></h5>
                                <p class="card-text"><?php echo $active_data["description"]; ?></p>
                                <p class="card-text">Price : <?php echo $active_data["price"]; ?></p>

                                <a type="button" class="btn btn-secondary col-12" href="updateStock.php?pid=<?php echo $active_data["id"]; ?>">Update Stock</a>

                                <div class="col-12 mt-1 btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a type="button" class="btn btn-warning" href="updateProducts.php?id=<?php echo $active_data["id"]; ?>">Edit</a>
                                    <a type="button" class="btn btn-danger" onclick="deactiveProduct(<?php echo $active_data['id']; ?>);">Deactive</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>

    </div>
</div>