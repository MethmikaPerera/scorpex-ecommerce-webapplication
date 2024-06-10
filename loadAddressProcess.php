<?php
session_start();
require "connection.php";

$session_data = $_SESSION["u"];
$userid = $session_data["id"];
?>

<h6 class="d-flex align-items-center mb-3 fw-bold">
    <i class="fa-solid fa-map-location-dot p-1"></i> Saved Addresses
</h6>
<?php
$address_rs = Database::search("SELECT * FROM `user_address` WHERE `user_id`='" . $userid . "'");
$address_num = $address_rs->num_rows;
?>
<div class="row mt-2 mb-3 d-flex justify-content-center">
    <?php
    if ($address_num > 0) {
        for ($i = 0; $i < $address_num; $i++) {
            $address_data = $address_rs->fetch_assoc();

            $district_rs = Database::search("SELECT * FROM `district` WHERE `id`='" . $address_data["district_id"] . "'");
            $district_data = $district_rs->fetch_assoc();

            $adid = $address_data["id"];
            $tagname = $address_data["tag_name"];
            $no = $address_data["no"];
            $line1 = $address_data["line1"];
            $line2 = $address_data["line2"];
            $city = $address_data["city"];
            $district = $district_data["name"];
            $postal = $address_data["postal_code"];
    ?>
            <div class="card col-12 col-md-5 col-lg-3 m-2 m-md-3">
                <h6 class="card-header fw-bold text-center text-uppercase">
                    <?php echo $tagname ?>
                </h6>
                <div class="card-body">
                    <p class="card-text fw-bold"><?php echo ($no . "," . $line1 . ", " . $line2 . ", " . $city . ", " . $district . ". ") ?></p>
                    <p class="card-text mt-1">Postal Code : <?php echo $postal ?>.</p>
                    <button class="btn btn-danger hov-btn1 rounded-pill btn-sm mt-2 col-12" onclick="removeAddress(<?php echo $adid ?>);">Remove</button>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
            <p class="mtext-110 cl6 p-t-10 fst-italic text-center">
                No Saved Address Found.
            </p>
        </div>
    <?php
    }
    ?>
</div>
<?php
if ($address_num < 3) {
?>
    <hr />
    <div class="row">
        <div class="col-sm-12 mt-2 mb-3">
            <h6 class="mb-0 fw-bold text-decoration-underline">Add New Address</h6>
        </div>

        <div class="alert alert-warning col-12 mb-3 d-none" role="alert" id="addressAlert">
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Address Tag Name</label>
            <input type="text" class="form-control" id="tagname" placeholder="Tag Name">
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label">No</label>
            <input type="text" class="form-control" id="no" placeholder="No">
        </div>
        <div class="col-md-5 mb-3">
            <label class="form-label">Line 1</label>
            <input type="text" class="form-control" id="line1" placeholder="Address Line 1">
        </div>
        <div class="col-md-5 mb-3">
            <label class="form-label">Line 2</label>
            <input type="text" class="form-control" id="line2" placeholder="Address Line 2">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">City</label>
            <input type="text" class="form-control" id="city" placeholder="City">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">District</label>
            <select id="district" class="form-select">
                <option value="0" selected>Select Your District</option>
                <?php

                $district_rs = Database::search("SELECT * FROM `district`");
                $district_n = $district_rs->num_rows;

                for ($x = 0; $x < $district_n; $x++) {
                    $district_d = $district_rs->fetch_assoc();

                ?>
                    <option value="<?php echo $district_d["id"] ?>">
                        <?php echo $district_d["name"]; ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Postal Code</label>
            <input type="number" class="form-control" id="postal" placeholder="Postal Code" min="0">
        </div>
        <div class="col-12">
            <button class="btn btn-success hov-btn1 rounded-pill" onclick="saveAddress();">Save Address</button>
        </div>
    </div>
<?php
}
?>