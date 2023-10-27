<?php

require 'app.php';
require 'Asesorados.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $alumno = $_POST["alumno"];
    $asesor = $_POST["asesor"];

    // Consulta SQL para eliminar el registro
    $sql_eliminar = Asesorados::eliminar("Alumno = '$alumno' AND Asesor = '$asesor'");

    if ($sql_eliminar) {
        echo "Registro insertado exitosamente.";
    } else {
        echo "Error al eliminar el registro: ";
    }

    header("Location: ../asignar_Asesores.php");
    exit();
}

$conn->close();
?>