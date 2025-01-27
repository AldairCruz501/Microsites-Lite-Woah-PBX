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
$correo = trim($_POST['correo']);
$name = trim($_POST['name']);
$asuntos = trim($_POST['asuntos']);
$numero = trim($_POST['number']);
$mensaje = trim($_POST['mensaje']);

$consulta =  "Nombre:: " . $name . "\n Correo: " . $email . "\n Asunto " . $asuntos  .  "\n Numero de contacto: " . $number.  "\n Mensaje: " . $mensaje;
echo '
            <script>
                 alert("Gracias por comunicarte");
                 window.location = "https://casv3.com/";
            </script>        
        ';

mail("contacto@casv3.com", "Contacto desde Formulario", $consulta);header("location:index.html");
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