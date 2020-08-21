<?php  
	if (isset($_GET['status'])) {
		switch ($_GET['status']) {
			case 'success':
				// INICIAMOS EL CURL
				$request_url  = 'https://api.mercadopago.com/v1/payments/'.$_GET['collection_id'].'?access_token=APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398';

				$curl = curl_init($request_url);

				// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

				# Send request.
				$result = curl_exec($curl);

				curl_close($curl);

				if (!$result) {
					echo 'Curl error: ' . curl_error($curl);
				} else{
					$message = '';

					$payment = json_decode($result);

					$message .= '<strong>El pago ha sido exitoso!</strong><br>';
					$message .= 'ID Método de pago: '.$payment->payment_method_id.'<br>';
					$message .= 'Monto: '.$payment->transaction_amount.'<br>';
					$message .= 'ID Orden: '.$payment->order->id.'<br>';
					$message .= 'ID Pago: '.$payment->id.'<br>';
				}

				break;

			case 'pending':
				$message = 'El pago se encuentra pendiente';
				break;
			
			case 'failure':
				$message = 'El pago ha sido rechazado';
				break;
		}
	}
?>

<!doctype html>
<html>
  <head>  
    <title>Resultado del pago</title>
  </head>
  <body>
    <?= $message ?>
  </body>
</html>