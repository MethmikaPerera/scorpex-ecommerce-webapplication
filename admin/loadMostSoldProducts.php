<?php
include "../connection.php";

$rs = Database::search("SELECT `product`.`title`, SUM(`orders`.`qty`) AS `total_sold` FROM `orders` 
                        INNER JOIN `product` ON `orders`.`product_id` =  `product`.`id` 
                        GROUP BY `product`.`id`, `product`.`title` ORDER BY `total_sold` DESC");

$labels = array();
$data = array();

while ($d = $rs->fetch_assoc()) {
    $labels[] = $d["title"];
    $data[] = $d["total_sold"];
}

echo json_encode(["labels" => $labels, "data" => $data]);
