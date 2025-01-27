<?php

if ($_POST['g-recaptcha-response'] == '') {

} else {
$obj = new stdClass();
$obj->secret = "6LeRcRoiAAAAACcaiBdQbBXeJS3CskAc5VaDvOKb";
$obj->response = $_POST['g-recaptcha-response'];
$obj->remoteip = $_SERVER['REMOTE_ADDR'];
$url = 'https://www.google.com/recaptcha/api/siteverify';

$options = array(
'http' => array(
'header' => "Content-type: application/x-www-form-urlencoded\r\n",
'method' => 'POST',
'content' => http_build_query($obj)
)
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$validar = json_decode($result);

/*  FIN DE CAPTCHA   */

if ($validar->success) {
$credito = trim($_POST['credito']);
$numero = trim($_POST['numero']);
$nombre = trim($_POST['nombre']);
$monto = trim($_POST['monto']);
$zona = trim($_POST['zona']);
$diferencia = trim($_POST['diferencia']);
$operacion = trim($_POST['operacion']);
$tiempo = trim($_POST['tiempo']);
$ingreso = trim($_POST['ingreso']);
$deudas = trim($_POST['deudas']);
$apoyo = trim($_POST['apoyo']);


$consulta =  "Nombre: " . $nombre . "\n Numero de contacto: " . $numero .  "\n Tipo de credito: " . $credito . "\n Monto del credito: " . $monto . "\n Zona de interes: " . $zona  . "\n Tiene planeado dar una direncia: " . $diferencia . "\n Inversión o Personal: " . $operacion . "\n Cuando compraria la casa: " . $tiempo . "\n Ingreso mensual: " . $ingreso . "\n Cuanto paga creditos y tarjetas: " . $deudas . "\n Cuenta con apoyo: " . $apoyo;
echo '
            <script>
                 alert("Gracias por comunicarte");
                 window.location = "https://casv3.com/";
            </script>        
        ';

mail("contacto@casv3.com", "Contacto desea Comprar", $consulta);header("location:index.html");
} 

else {
    echo '
    <script>
         alert("Error resuelva el captcha");
         window.location = "https://casv3.com/";
    </script>        
';
header("location:index.html");

}
}
?>