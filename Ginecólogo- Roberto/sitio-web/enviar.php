<?php

if ($_POST['g-recaptcha-response'] == '') {

} else {
$obj = new stdClass();
$obj->secret = "6Ler9bAiAAAAAJOhjeiptbw816wwp4jXHq959RKV";
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
$correo= trim($_POST['correo']);
$nombre = trim($_POST['nombre']);
$celular = trim($_POST['celular']);
$direccion = trim($_POST['direccion']);
$planes = trim($_POST['planes']);


$consulta =  "Nombre: " . $nombre . "\n Correo: " . $Correo .  "\n Numero de contacto: " . $numero  .  "\n Dirección: " . $direccion  .  "\n Plan Interesado: " . $plan;
echo '
            <script>
                 alert("Gracias por comunicarte");
                 window.location = "https://conektamexico.com/";
            </script>        
        ';

mail("echong.pbxhosting@gmail.com", "Formulario Conekta", $consulta);header("location:index.html");
} 

else {
    echo '
    <script>
         alert("Error resuelva el captcha");
         window.location = "https://conektamexico.com/";
    </script>        
';
header("location:index.html");

}
}
?>