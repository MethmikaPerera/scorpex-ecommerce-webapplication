<?php

require "../connection.php";

?>
<label class="form-label">Material</label>
<select class="form-control form-select" id="addproductmaterial">
    <option value="0">Select Material</option>
    <?php

    $rs = Database::search("SELECT * FROM `material`");
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