<?php
include "../connection.php";

$rs = Database::search("SELECT `category`.`name`, SUM(`orders`.`qty`) AS `total_sold` FROM `orders` 
                        INNER JOIN `product` ON `orders`.`product_id` =  `product`.`id`
                        INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
                        GROUP BY `category`.`id`, `category`.`name` ORDER BY `total_sold` DESC");

$labels = array();
$data = array();

while ($d = $rs->fetch_assoc()) {
    $labels[] = $d["name"];
    $data[] = $d["total_sold"];
}

echo json_encode(["labels" => $labels, "data" => $data]);
