<?php
if($_POST['g-recaptcha-response'] == null || !isset($_POST['g-recaptcha-response']) || $_POST['g-recaptcha-response'] == ''){
    echo "<script>alert('Complete el reCAPTCHA para continuar')</script>";
    echo "<script>window.location.replace('index.html#contacto');</script>";
    return;
}elseif(isset($_POST['correo']) && isset($_POST['nombre']) && isset($_POST['celular']) && isset($_POST['mensaje']) && isset($_POST['apellido'])){
    $correo= trim($_POST['correo']);
    $nombre = trim($_POST['nombre']);
    $celular = trim($_POST['celular']);
    $mensaje = trim($_POST['mensaje']);
    $apellido = trim($_POST['apellido']);

    $message =  "Nombre: " . $nombre .  "\n Apellido: " . $apellido .  "\n Numero de contacto: " . $celular  .  "\n Correo: " . $correo  .  "\n Mensaje: " . $mensaje;


    $response = $_POST['g-recaptcha-response'];
    $secret = '6LerhPcpAAAAAFrgamdRZSe2bdpT8I0QiYxnsVEk';
    $url = "https://www.google.com/recaptcha/api/siteverify";

    


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 
        http_build_query(
            array(
                'secret'=>$secret,
                'response'=>$response
            )
        )
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($result);

    if($result->success){
        // $to = 'ana.barrera@jjbusinessconsulting.net';
        $to = 'echong.pbxhosting@gmail.com';
        $subject = 'Formulario de contacto';


        $mail = mail($to, $subject, $message);
        if($mail){
            echo "<script>alert('Formulario enviado con exito')</script>";
            echo "<script>window.location.replace('index.html');</script>";
            return;
        }else{
            echo "<script>alert('Ocurrio un error al enviar el formulario')</script>";
            echo "<script>window.location.replace('index.html');</script>";
            return;
        }
    }

}else{
    echo "<script>alert('Llene todos los campos obligatorios del formulario para continuar')</script>";
    echo "<script>window.location.replace('index.html#contacto');</script>";
    return;
}

?>


