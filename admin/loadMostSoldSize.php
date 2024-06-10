<?php
include "../connection.php";

$rs = Database::search("SELECT size.size, SUM(`orders`.`qty`) AS `total_sold` FROM `orders` 
                        INNER JOIN `size` ON `orders`.`size_id` = `size`.`id`
                        GROUP BY `size`.`id`, size.size ORDER BY `total_sold` DESC");

$labels = array();
$data = array();

while ($d = $rs->fetch_assoc()) {
    $labels[] = $d["size"];
    $data[] = $d["total_sold"];
}

echo json_encode(["labels" => $labels, "data" => $data]);
