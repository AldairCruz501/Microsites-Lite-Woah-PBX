<?php 
    $destino = "echong.pbxhosting@gmail.com";
    $vivienda = $_POST(['vivienda']);
    $name = $_POST(['name']);
    $gravamen = $_POST(['gravamen']);
    $numero = $_POST(['number']);
    $hm = $_POST(['hm']);
    $avaluo = $_POST(['avaluo']);
    $cuartos= $_POST(['cuartos']);
    $tiempo = $_POST(['tiempo']);

    $contenido =  "Nombre: " . $name . "\n Numero de contacto: " . $number .  "\n ¿Dirección de la casa?: " . $vivienda . "\n ¿Está libre de gravamen?: " . $gravamen . "\n ¿Ya tienes avaluo de la vivienda? " . $hm . $avaluo . "\n Cantidad de cuartos: " . $cuartos . "\n Tiempo vendiendo: " . $tiempo;
    mail($destino, "Contacto", $contenido);
    header("location:index.html");
?>