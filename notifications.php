<?php
require './vendor/autoload.php';

MercadoPago\SDK::setAccessToken("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398");

switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        break;
    case "plan":
        $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
        break;
    case "subscription":
        $plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
        break;
    case "invoice":
        $plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
        break;
}

file_put_contents(
    'payment.txt',
    json_encode($_POST, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL,
    FILE_APPEND
);

header('HTTP/1.1 200 OK');
header('Content-Type: application/json');
echo json_encode($payment);