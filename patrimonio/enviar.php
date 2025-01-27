<?php
if($_POST['g-recaptcha-response'] == null || !isset($_POST['g-recaptcha-response']) || $_POST['g-recaptcha-response'] == ''){
    echo "<script>alert('Complete el reCAPTCHA para continuar')</script>";
    echo "<script>window.location.replace('index.html#contacto');</script>";
    return;
}elseif(isset($_POST['correo']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['celular']) && isset($_POST['mensaje']) && isset($_POST['servicio'])){
    $correo= trim($_POST['correo']);
    $apellido = trim($_POST['apellido']);
    $nombre = trim($_POST['nombre']);
    $celular = trim($_POST['celular']);
    $mensaje = trim($_POST['mensaje']);
    $servicio = trim($_POST['servicio']);

    $message =  "Nombre: " . $nombre . "\n Apellido: " . $apellido . "\n Correo: " . $correo .  "\n Numero de contacto: " . $celular  .  "\n Servicio de interes: " . $servicio  .  "\n Mensaje: " . $mensaje;


    $response = $_POST['g-recaptcha-response'];
    $secret = '6LevJbEoAAAAAJfIHjT0ok7Ul5el2IEWMjjiUbdI';
    $url = "https://www.google.com/recaptcha/api/siteverify";

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];


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
       
        $to = 'contacto@maspatrimonio.org.mx';
        $subject = 'Formulario de contacto Mas Patrimonio';


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






