<?php

if ($_POST['g-recaptcha-response'] == '') {
header("location: index.html");
} else {
$obj = new stdClass();
$obj->secret = "6LdztcwgAAAAAJjBXJXhVJhcvPrTmDd8AjesNxiQ";
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
$name= trim($_POST['name']);
$number= trim($_POST['number']);
$mail = trim($_POST['mail']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

$consulta =  "Nombre " . $name . "\n Teléfono " . $number . "\n Correo " . $mail . "\n Asunto: " . $subject . "\n Mensaje: " . $message;

echo '
            <script>
                 alert("Gracias por comunicarte");
                 window.location = "../index.html";
            </script>        
        ';

mail("echong.pbxhosting@gmail.com", "Formulario SEPCO", $consulta);
} else {
header("location: index.html");
}
}
?>