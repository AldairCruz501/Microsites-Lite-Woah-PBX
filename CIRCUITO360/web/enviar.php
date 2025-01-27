<?php

if ($_POST['g-recaptcha-response'] == '') {

} else {
    $obj = new stdClass();
    $obj->secret = "6Lc61XIoAAAAAMWk3fTqjnHqldrZbc7lnA7C4meg";
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

    if ($validar->success) {
        $correo= trim($_POST['correo']);
        $nombre = trim($_POST['nombre']);
        $celular = trim($_POST['celular']);
        $mensaje = trim($_POST['mensaje']);
        $asunto = trim($_POST['asunto']);

        $consulta =  "Nombre: " . $nombre . "\n Correo: " . $correo .  "\n Numero de contacto: " . $celular  .  "\n Asunto: " . $asunto  .  "\n Mensaje: " . $mensaje;

        // Envía el correo primero
        mail("echong.pbxhosting@gmail.com", "Formulario Grupo Altra", $consulta);

        // Luego muestra el mensaje y redirige
        echo '
            <script>
                alert("Gracias por comunicarte");
                window.location = "https://circuito360.com.mx/";
            </script>        
        ';
    } else {
        echo '
            <script>
                alert("Error resuelva el captcha");
                window.location = "hhttps://circuito360.com.mx/";
            </script>        
        ';
    }
}
?>






