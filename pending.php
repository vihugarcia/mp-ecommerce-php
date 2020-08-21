<?php
if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $protocol = 'https://';
} else {
    $protocol = 'http://';
}
?>

<h1>EL PAGO SE ENCUENTRA PENDIENTE</h1>

<a href="<?php echo $protocol . $_SERVER['SERVER_NAME'] ?>">Volver al sitio</a>