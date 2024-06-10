<?php

session_start();
require __DIR__ . '/Vendor/Stripe/autoload.php';
require "secret.php";
require "connection.php";

$session_data = $_SESSION["u"];
$userid = $session_data["id"];

\Stripe\Stripe::setApiKey($stripe_secret_key);

$product_id = $_POST['product_id'];
$product_title = $_POST['product_title'];
$product_price = $_POST['product_price'];
$product_sizeid = $_POST['product_sizeid'];
$product_qty = $_POST['product_qty'];
$order_total = $_POST['total'];
$selected_addressid = $_POST['selected_address'];

$size_rs = Database::search("SELECT * FROM `size` WHERE id='" . $product_sizeid . "'");
$size_d = $size_rs->fetch_assoc();

$product_size = $size_d["size"];

$code = uniqid();
$orderid = preg_replace('/[^0-9]/', '', $code);

try {

    $session = \Stripe\Checkout\Session::create([
        "mode" => 'payment',
        "success_url" => "http://localhost/scorpex/buynowSuccess.php?orderid=" . $orderid,
        "cancel_url" => "http://localhost/scorpex/viewProduct.php?id=" . $product_id,
        "payment_method_types" => ['card'],

        "line_items" => [
            [
                "price_data" => [
                    "currency" => 'LKR',
                    "unit_amount" => $order_total * 100,
                    "product_data" => [
                        "name" => "Amount To Pay",
                        "description" => $product_title . " (Size : " . $product_size . ") | Qty : ".$product_qty."",
                    ]
                ],

                "quantity" => 1,
            ]
        ],

        "metadata" => [
            'product_id' => $product_id,
            'product_title' => $product_title,
            'product_size' => $product_size
        ]
    ]);

    json_encode(['id' => $session->id]);

    $_SESSION['order'] = [
        'product_id' => $product_id,
        'product_price' => $product_price,
        'product_title' => $product_title,
        'product_sizeid' => $product_sizeid,
        'product_qty' => $product_qty,
        'order_total' => $order_total,
        'selected_addressid' => $selected_addressid,
        'orderid' => $orderid,
    ];

    http_response_code(303);
    header('Location: ' . $session->url);
} catch (Exception $e) {

    http_response_code(500);
    echo "Error" . $e->getMessage();
}
