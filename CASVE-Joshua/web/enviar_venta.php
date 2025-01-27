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
$vivienda = trim($_POST['vivienda']);
$name = trim($_POST['name']);
$gravamen = trim($_POST['gravamen']);
$numero = trim($_POST['number']);
$hm = trim($_POST['hm']);
$avaluo = trim($_POST['avaluo']);
$cuartos= trim($_POST['cuartos']);
$tiempo = trim($_POST['tiempo']);

$consulta =  "Nombre: " . $name . "\n Numero de contacto: " . $number .  "\n ¿Dirección de la casa?: " . $vivienda . "\n ¿Está libre de gravamen?: " . $gravamen . "\n ¿Ya tienes avaluo de la vivienda? " . $hm . $avaluo . "\n Cantidad de cuartos: " . $cuartos . "\n Tiempo vendiendo: " . $tiempo;
echo '
            <script>
                 alert("Gracias por comunicarte");
                 window.location = "https://casv3.com/";
            </script>        
        ';

mail("contacto@casv3.com", "Contacto desea Vender", $consulta);header("location:index.html");
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