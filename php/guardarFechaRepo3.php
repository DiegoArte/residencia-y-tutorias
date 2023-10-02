<?php
// Establece la conexión a tu base de datos (debes configurar esto)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "protutres";


$conexion = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtiene las fechas desde el formulario
$fechaInicio3 = $_POST['fechaInicio3'];
$fechaFinal3 = $_POST['fechaFinal3'];

// Elimina los registros existentes en la tabla fecharepo1
$conexion->query("DELETE FROM fecharepo3");

// Inserta los nuevos datos en la tabla fecharepo1
$sql = "INSERT INTO fecharepo3 (fechaini, fechafin) VALUES ('$fechaInicio3', '$fechaFinal3')";

if ($conexion->query($sql) === TRUE) {
    echo "Datos guardados exitosamente en Reporte 3.";
} else {
    echo "Error al guardar datos: " . $conexion->error;
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
