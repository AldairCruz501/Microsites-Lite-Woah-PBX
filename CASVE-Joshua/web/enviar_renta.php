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
$presupuesto = trim($_POST['presupuesto']);
$fecha = trim($_POST['fecha']);
$personas = trim($_POST['personas']);
$empresa = trim($_POST['empresa']);
$tiempo = trim($_POST['tiempo']);
$rentado = trim($_POST['rentado']);
$mensaje = trim($_POST['mensaje']);


$consulta =  "Nombre: " . $nombre . "\n Numero de contacto: " . $numero .  "\n Presupuesto: " . $presupuesto . "\n Fecha: " . $fecha . "\n Cantidad de personas: " . $personas  . "\n Empresa " . $empresa. "\n Cantidad de días: " . $tiempo . "\n Ya había rentado con nostros:" . $rentado . "\n Mensaje: " . $mensaje;
echo '
            <script>
                 alert("Gracias por comunicarte");
                 window.location = "https://casv3.com/";
            </script>        
        ';

mail("contacto@casv3.com", "Contacto desea Rentar", $consulta);header("location:index.html");
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