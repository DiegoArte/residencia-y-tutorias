<?php

require 'app.php';
require 'Tutorados.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $alumno = $_POST["alumno"];
    $asesor = $_POST["asesor"];

    // Consulta SQL para eliminar el registro
    $sql_eliminar = Tutorados::eliminar("Grupo = '$alumno' AND Tutor = '$asesor'");

    if ($sql_eliminar) {
        echo "Registro insertado exitosamente.";
    } else {
        echo "Error al eliminar el registro: ";
    }

    header("Location: ../asignar_Tutores.php");
    exit();
}

$conn->close();
?>