<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $acade = $_POST["grup"];
    $fecha = $_POST["date"];
    $activi = $_POST["act"];

     // Obtener los valores de asistencia y guardar en la tabla 'asistut'
     $asistencias = $_POST['asistencia'];
    $fechaObj = DateTime::createFromFormat('d/m/Y', $fecha);
    $fechaFormateada = $fechaObj->format('Y-m-d');
    // Conexión a la base de datos (asumiendo que ya tienes la función conectar())
    require_once "db.php";
    $conexion = conectar();

    // Insertar datos en la tabla 'asisactivi'
    $query_activi = "INSERT INTO asisactivi (Actividad, Grupo, Fecha) VALUES ('$activi', '$acade', '$fechaFormateada')";
    $resultado_activi = $conexion->query($query_activi);

    if ($resultado_activi) {
        
        foreach ($asistencias as $numeroControl) {
            // Obtener el nombre del estudiante de la tabla 'alumnosnormales'
            $query_nombre = "SELECT NombreDelEstudiante FROM alumnosnormales WHERE NumeroDeControl = '$numeroControl'";
            $resultado_nombre = $conexion->query($query_nombre);

            if ($resultado_nombre->num_rows > 0) {
                $fila_nombre = $resultado_nombre->fetch_assoc();
                $nombre = $fila_nombre['NombreDelEstudiante'];

                // Insertar datos en la tabla 'asistut'
                $query_asistut = "INSERT INTO asistut (NumeroControl, Nombre, Fecha, carrera, Asistio) VALUES ('$numeroControl', '$nombre', '$fechaFormateada', '$acade', 1)";
                $resultado_asistut = $conexion->query($query_asistut);

                echo "<script>alert('La lista de asistencia fue guardada con exito');window.location.href = '../AsistenciasTut.php';</script>";

                // Manejo de errores o mensajes de éxito
                if (!$resultado_asistut) {
                    echo "Error al guardar la asistencia para el estudiante con número de control: $numeroControl<br>";
                }
            } else {
                echo "No se encontró el nombre del estudiante con número de control: $numeroControl<br>";
            }
        }
        // Cerrar la conexión a la base de datos
        $conexion->close();
    } else {
        echo "Error al guardar la información de la actividad en la tabla 'asisactivi'";
    }
} else {
    echo "Error en la solicitud de datos";
}
?>
