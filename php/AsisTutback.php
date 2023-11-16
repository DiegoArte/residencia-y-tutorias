<?php
require_once "php/db.php";
$conexion=conecta();
// Recibir datos enviados desde JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Obtener datos generales
$actividad = $data['actividad'];
$fecha = $data['fecha'];
$grupo = $data['grupo'];

$query="INSERT INTO asisactivi (Actividad, Grupo, Fecha) VALUES ('$actividad', '$fecha', '$grupo')";
mysqli_query($conexion,$query);

// Procesar e insertar datos en la base de datos (ajustar la lógica según tu estructura de base de datos)
foreach ($data['asistencia'] as $row) {
    $numeroControl = $row['numeroControl'];
    $nombreEstudiante = $row['nombreEstudiante'];
    $asistencia = $row['asistencia'];

    // Realizar la inserción en la base de datos usando la conexión a tu base de datos
    $sql="INSERT INTO asistut ( NumeroControl, Nombre, Fecha, carrera, Asistio) VALUES ('$numeroControl', '$nombreEstudiante', '$fecha', '$grupo', '$asistencia')";
    mysqli_query($conexion,$sql);
}
$conexion->close();

echo"listo";
?>