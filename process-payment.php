<?php

require './vendor/autoload.php';

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}

$image = $protocol . $_SERVER['SERVER_NAME'] . $_POST['img'];

MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "test_user_63274575@testuser.com";
$payer->date_created = "2018-06-02T12:58:41.425-04:00";
$payer->phone = array(
    "area_code" => "11",
    "number" => "22223333"
);

$payer->address = array(
    "street_name" => False,
    "street_number" => 123,
    "zip_code" => "1111"
);

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id = "1234";
$item->currency_id = "ARS";
$item->title = $_POST['title'];
$item->description = 'Dispositivo móvil de Tienda e-commerce';
$item->picture_url = $image;
$item->quantity = 1;
$item->unit_price = $_POST['price'];

$preference->payer = $payer;
$preference->external_reference = "vihugarcia@gmail.com";
$preference->items = array($item);
$preference->back_urls = array(
    "success" => $protocol . $_SERVER['SERVER_NAME'] . "/success.php",
    "failure" => $protocol . $_SERVER['SERVER_NAME'] . "/failure.php",
    "pending" => $protocol . $_SERVER['SERVER_NAME'] . "/pending.php"
);
$preference->auto_return = "approved";
$preference->payment_methods = array(
    "excluded_payment_methods" => array(
        array("id" => "amex")
    ),
    "excluded_payment_types" => array(
        array("id" => "atm")
    ),
    "installments" => 6
);
$preference->notification_url =  $protocol . $_SERVER['SERVER_NAME'] . "/notifications.php?source_news=webhooks";

$preference->save();
?>

<!doctype html>
<html>
  <head>
  <script src="https://www.mercadopago.com/v2/security.js" view=""></script>
    <title>Pagar</title>
  </head>
  <body>
    <a href="<?php echo $preference->init_point; ?>">Pagar la compra</a>
  </body>
</html>