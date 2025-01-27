<?php
if($_POST['g-recaptcha-response'] == null || !isset($_POST['g-recaptcha-response']) || $_POST['g-recaptcha-response'] == ''){
    echo "<script>alert('Complete el reCAPTCHA para continuar')</script>";
    echo "<script>window.location.replace('index.html#contacto');</script>";
    return;
}elseif(isset($_POST['correo']) && isset($_POST['nombre']) && isset($_POST['celular']) && isset($_POST['empresa']) && isset($_POST['asunto'])){
    $correo= trim($_POST['correo']);
    $nombre = trim($_POST['nombre']);
    $empresa = trim($_POST['empresa']);
    $celular = trim($_POST['celular']);
    $asunto = trim($_POST['asunto']);

    $message =  "Nombre: " . $nombre . "\n Empresa: " . $empresa. "\n Correo: " . $correo .  "\n Numero de contacto: " . $celular  .  "\n Asunto: " . $asunto;


    $response = $_POST['g-recaptcha-response'];
    $secret = '6LfAnEgqAAAAAMoG8w4KOe8-q0NIDoMOx8Fez9jP';
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
        $to = 'jballadares.pbxhosting@gmail.com';
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


