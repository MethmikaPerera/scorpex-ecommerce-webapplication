<?php

require "../connection.php";

?>
<label class="form-label">Category</label>
<select class="form-control form-select" id="addproductcategory">
    <option value="0">Select Category</option>
    <?php

    $rs = Database::search("SELECT * FROM `category`");
    $n = $rs->num_rows;

    for ($x = 0; $x < $n; $x++) {
        $d = $rs->fetch_assoc();

    ?>
        <option value="<?php echo $d["id"] ?>">
            <?php echo $d["name"]; ?>
        </option>
    <?php
    }
    ?>
</select>