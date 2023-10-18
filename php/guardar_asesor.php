<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Realiza la conexión a la base de datos (reemplaza con tus propios datos de conexión)
    require 'app.php';
    require 'Asesorados.php';

    // Consultas
    $asesorados=new Asesorados($_POST);
    $asesorados->crear();

    if ($asesorados) {
        header("Location: ../asignar_Asesores.php");
    } else {
        echo "Error: " . $conn->error;
    }

    exit();
}
?>