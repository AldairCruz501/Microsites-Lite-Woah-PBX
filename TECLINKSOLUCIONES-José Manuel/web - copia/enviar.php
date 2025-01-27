<?php

if ($_POST['g-recaptcha-response'] == '') {

} else {
$obj = new stdClass();
$obj->secret = "6LeNsDcjAAAAADtFTOKgX6OvPAseTbSdNw-s07kK";
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
$servicios = trim($_POST['servicios']);


$consulta =  "Nombre: " . $nombre . "\n Correo: " . $correo .  "\n Numero de contacto: " . $celular  .  "\n Servicio de Interes: " . $servicio;
          echo '
                    <script>
                         alert("Gracias por comunicarte");
                         window.location = "https://teclinksoluciones.com.mx/";
                    </script>        
               ';

          mail("contacto@teclinksoluciones.com.mx", "Formulario Tecklink", $consulta);header("location:index.html");
} 

     else {
          echo '
          <script>
               alert("Error resuelva el captcha");
               window.location = "https://teclinksoluciones.com.mx/";
          </script>        
          ';
          header("location:index.html");

     }
}
?>