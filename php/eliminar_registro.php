<?php

// Crear una conexión
require 'php/db.php';

    $conn=conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $alumno = $_POST["alumno"];
    $asesor = $_POST["asesor"];

    // Consulta SQL para eliminar el registro
    $sql_eliminar = "DELETE FROM tabla_tutorados WHERE Grupo = '$alumno' AND Tutor = '$asesor'";

    if ($conn->query($sql_eliminar) === TRUE) {
        echo "Registro insertado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $sql_generar = "INSERT INTO `grupos` (`NumerodeControl`) VALUES ('$alumno')";

    if ($conn->query($sql_generar) === TRUE) {
        echo "Registro insertado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }


    header("Location: ../asignar_Tutores.php");
    exit();
}

$conn->close();
?>