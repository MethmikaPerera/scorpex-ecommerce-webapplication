<?php

require "../connection.php";

?>
<label class="form-label col-12">Product Title</label>
<div class="col-12">
    <select class="form-control form-select" id="addproductid">
        <option value="0">Select Product</option>
        <?php

        $prs = Database::search("SELECT * FROM `product` WHERE status_id='1'");
        $pn = $prs->num_rows;

        for ($x = 0; $x < $pn; $x++) {
            $pd = $prs->fetch_assoc();
            $pid = $pd["id"];

            $srs = Database::search("SELECT * FROM `product_size` WHERE product_id='" . $pid . "'");
            $sn = $srs->num_rows;

            if ($sn < 6) {
        ?>
                <option value="<?php echo $pid ?>">
                    <?php echo $pid ?> - <?php echo $pd["title"]; ?>
                </option>

        <?php
            }
        }
        ?>
    </select>
</div>