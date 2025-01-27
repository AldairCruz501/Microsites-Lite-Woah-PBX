<?php 
include 'config.php';

$name = $_POST["name"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$q1 = $_POST["q1"];
$q2 = $_POST["q2"];
$q3 = $_POST["q3"];
$q4 = $_POST["q4"];
$q5 = $_POST["q5"];
$q6 = $_POST["q6"];

$query = "INSERT INTO Clientes(name, email, telefono, q1, q2, q3, q4, q5, q6)
VALUES('$name', '$email', '$telefono', '$q1', '$q2', '$q3', '$q4', '$q5', '$q6')";


$ejecutar = mysqli_query($conn, $query);


if($ejecutar){
    echo '
        <script>
             alert("Encuesta enviada");
             window.location = "../simulador.html";
        </script>                 
    ';
}else{
    echo'
        <script>
            alert("Error en la encuesta");
            window.location = "../simulador.html";
        </script>
    ';
}
mysqli_close($conn);

?>