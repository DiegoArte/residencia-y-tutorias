<?php
// Establece la conexión a tu base de datos (debes configurar esto)
require 'db.php';

$conexion = conectar();

// Obtiene las fechas desde el formulario
$fechaInicio2 = $_POST['fechaInicio2'];
$fechaFinal2 = $_POST['fechaFinal2'];

// Obtén las fechas existentes en la tabla fecharepo1
$sql = "SELECT fechaini, fechafin FROM fecharepo1";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Recorre las fechas existentes
    while ($row = $result->fetch_assoc()) {
        $fechaInicio1 = $row["fechaini"];
        $fechaFinal1 = $row["fechafin"];

        // Compara las fechas
        if ($fechaInicio2 >= $fechaInicio1 && $fechaFinal2 >= $fechaFinal1) {
            $conexion->query("DELETE FROM fecharepo2");
            // Las fechas son válidas, procede con la inserción en fecharepo2
            $sql = "INSERT INTO fecharepo2 (fechaini, fechafin) VALUES ('$fechaInicio2', '$fechaFinal2')";

            if ($conexion->query($sql) === TRUE) {
                echo "<script>alert('Fecha activada');history.go(-1);</script>";
            } else {
                echo "Error al guardar datos: " . $conexion->error;
            }
        } else {
            // Las fechas son anteriores a las fechas existentes en fecharepo1, muestra un mensaje de error
            echo "<script>alert('Las fechas ingresadas son anteriores a las fechas del reporte 1. Por favor, ingrese fechas válidas.');history.go(-1);</script>";
        }
    }
} else {
    echo "<script>alert('No se encontraron fechas en reporte 1. Asegúrese de que haya fechas válidas antes de insertar en Reporte 2.');history.go(-1);</script>";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
