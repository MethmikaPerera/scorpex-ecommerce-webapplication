<?php

session_start();
require __DIR__ . '/Vendor/Stripe/autoload.php';
require "secret.php";
require "connection.php";

$session_data = $_SESSION["u"];
$userid = $session_data["id"];

\Stripe\Stripe::setApiKey($stripe_secret_key);

$cart_total = $_POST['total'];
$item_qty = $_POST['items'];
$selected_addressid = $_POST['selected_address'];

$code = uniqid();
$orderid = preg_replace('/[^0-9]/', '', $code);

try {

    $session = \Stripe\Checkout\Session::create([
        "mode" => 'payment',
        "success_url" => "http://localhost/scorpex/checkoutSuccess.php?orderid=" . $orderid,
        "cancel_url" => "http://localhost/scorpex/checkoutCancel.php",
        "payment_method_types" => ['card'],

        "line_items" => [
            [
                "price_data" => [
                    "currency" => 'LKR',
                    "unit_amount" => $cart_total * 100,
                    "product_data" => [
                        "name" => "Amount To Pay",
                        "description" => "Number of Items : ".$item_qty.""
                    ]
                ],

                "quantity" => 1,
            ]
        ],

    ]);

    json_encode(['id' => $session->id]);

    $_SESSION['cart'] = [
        'cart_total' => $cart_total,
        'orderid' => $orderid,
        'selected_address' => $selected_addressid,
    ];

    http_response_code(303);
    header('Location: ' . $session->url);
} catch (Exception $e) {

    http_response_code(500);
    echo "Error" . $e->getMessage();
}
