<?php

require "../connection.php";

$deactive_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='0' ORDER BY datetime_added DESC");
$deactive_num = $deactive_rs->num_rows;
?>

<div class="col-lg-12">
    <div class="row">

        <?php
        if ($deactive_num < 1) {
        ?>
            <h3 class="mt-5">No Deactive Products Available...</h3>
            <?php
        } else {
            for ($x = 0; $x < $deactive_num; $x++) {
                $deactive_data = $deactive_rs->fetch_assoc();
            ?>

                <div class="card m-2" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-4 d-flex align-items-center justify-content-center">

                            <?php

                            $deactive_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $deactive_data["id"] . "'");
                            $deactive_img_data = $deactive_img_rs->fetch_assoc();

                            ?>

                            <img src="../assets/<?php echo $deactive_img_data["code"]; ?>" class="img-fluid rounded">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $deactive_data["title"]; ?></h5>
                                <p class="card-text"><?php echo $deactive_data["description"]; ?></p>
                                <p class="card-text">Price : <?php echo $deactive_data["price"]; ?></p>

                                <div class="col-12 mt-1 btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a type="button" class="btn btn-warning" href="updateProducts.php?id=<?php echo $deactive_data["id"]; ?>">Edit</a>
                                    <a type="button" class="btn btn-success" onclick="activeProduct(<?php echo $deactive_data['id']; ?>);">Active</a>
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