<?php
// Establece la conexión a tu base de datos (debes configurar esto)
require 'db.php';

$conexion = conectar();

// Obtiene las fechas desde el formulario
$fechaInicio3 = $_POST['fechaInicio3'];
$fechaFinal3 = $_POST['fechaFinal3'];

// Obtén las fechas existentes en la tabla fecharepo1
$sql = "SELECT fechaini, fechafin FROM fecharepo2";
$result = $conexion->query($sql);

if($fechaFinal3>$fechaInicio3){
if ($result->num_rows > 0) {
    // Recorre las fechas existentes
    while ($row = $result->fetch_assoc()) {
        $fechaInicio2 = $row["fechaini"];
        $fechaFinal2 = $row["fechafin"];

        // Compara las fechas
        if ($fechaInicio3 >= $fechaInicio2 && $fechaFinal3 >= $fechaFinal2) {
            $conexion->query("DELETE FROM fecharepo3");
            // Las fechas son válidas, procede con la inserción en fecharepo2
            $sql = "INSERT INTO fecharepo3 (fechaini, fechafin) VALUES ('$fechaInicio3', '$fechaFinal3')";

            if ($conexion->query($sql) === TRUE) {
                echo "<script>alert('Fecha activada');history.go(-1);</script>";
            } else {
                echo "Error al guardar datos: " . $conexion->error;
            }
        } else {
            // Las fechas son anteriores a las fechas existentes en fecharepo1, muestra un mensaje de error
            echo "<script>alert('Las fechas ingresadas son anteriores a las fechas del reporte 2. Por favor, ingrese fechas válidas.');history.go(-1);</script>";
        }
        }
    }
     else {
    echo "<script>alert('No se encontraron fechas en reporte 2. Asegúrese de que haya fechas válidas antes de insertar en Reporte 3.');history.go(-1);</script>";
}
}else{
    echo "<script>alert('La fecha de Fin es antes que la fecha de inicio');history.go(-1);</script>";
// Cierra la conexión a la base de datos
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
