<?php
require_once "db.php";
$conexion=conectar();
// Recibir datos enviados desde JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Obtener datos generales
$actividad = $data['actividad'];
$fecha = $data['fecha'];
$grupo = $data['grupo'];

$query="INSERT INTO asisactivi (Actividad, Grupo, Fecha) VALUES ('$actividad', '$grupo', '$fecha')";
mysqli_query($conexion,$query);

if (isset($data['asistencias']) && is_array($data['asistencias'])) {
    $asistencias = $data['asistencias'];
    foreach ($asistencias as $asistencia) {
        $numeroControl = $asistencia['numeroControl'];
        $nombreEstudiante = $asistencia['nombreEstudiante'];
        $asistio = $asistencia['asistencia'];

        $sql = "INSERT INTO asistut (NumeroControl, Nombre, Fecha, carrera, Asistio) VALUES ('$numeroControl', '$nombreEstudiante', '$fecha', '$grupo', '$asistio')";
        mysqli_query($conexion, $sql);
    }
} else {
    // Si 'asistencias' no está definido o no es un array
    echo "Error: Datos de asistencias no recibidos correctamente.";
}

$conexion->close();

echo"listo";
?>