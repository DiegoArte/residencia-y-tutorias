<?php
// Establece la conexión a tu base de datos (debes configurar esto)

require 'php/db.php';

    $conexion=conectar();

// Obtiene las fechas desde el formulario
$fechaInicio2 = $_POST['fechaInicio2'];
$fechaFinal2 = $_POST['fechaFinal2'];

// Elimina los registros existentes en la tabla fecharepo1
$conexion->query("DELETE FROM fecharepo2");

// Inserta los nuevos datos en la tabla fecharepo1
$sql = "INSERT INTO fecharepo2 (fechaini, fechafin) VALUES ('$fechaInicio2', '$fechaFinal2')";

if ($conexion->query($sql) === TRUE) {
    echo "Datos guardados exitosamente en Reporte 2.";
} else {
    echo "Error al guardar datos: " . $conexion->error;
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
