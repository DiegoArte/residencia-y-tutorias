<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los valores seleccionados del formulario
    $alumnoSeleccionado = $_POST["Lista1"];
    $docenteSeleccionado = $_POST["Lista2"];

    // Realiza la conexión a la base de datos (reemplaza con tus propios datos de conexión)

    require 'php/db.php';

    $conn=conectar();

    // Consultas
    $sql_insert = "INSERT INTO tabla_tutorados (grupo, tutor) VALUES ('$alumnoSeleccionado', '$docenteSeleccionado')";

    if ($conn->query($sql_insert) === TRUE) {
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    $sql_eliminar = "DELETE FROM grupos WHERE NumerodeControl = '$alumnoSeleccionado'";

    if ($conn->query($sql_eliminar) === TRUE) {
        header("Location: ../asignar_Tutores.php");
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
    
    exit();

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>