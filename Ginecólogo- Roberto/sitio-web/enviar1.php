<?php 
    $destino = "echong.pbxhosting@gmail.com";
    $email = $_POST(['email']);
    $name = $_POST(['name']);
    $date = $_POST(['date']);
    $message = $_POST(['message']);
    $service = $_POST(['service']);
 

    $contenido =  "Nombre: " . $name . "\n Numero de contacto: " . $number .  "\n Información de " . $service . "\n Fecha: " . $date . "\n Correo " . $email;
    mail($destino, "Contacto", $contenido);
    header("location:index.html");


?>