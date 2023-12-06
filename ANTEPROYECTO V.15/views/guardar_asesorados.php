<?php
// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

// Recibe la carrera seleccionada desde la solicitud AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['carrera'])) {
    $carreraSeleccionada = $_POST['carrera'];

    // Aquí puedes realizar la lógica para guardar datos filtrados por carrera en la base de datos
    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Suponiendo que tienes una tabla llamada 'documento' con columnas 'idalumno', 'nombrealumno', 'carrera', etc.
    // Realiza una inserción filtrada por la carrera seleccionada
    $sql = "INSERT INTO documento (idalumno, nombrealumno, carrera) SELECT idalumno, nombrealumno, carrera FROM documento WHERE carrera = '$carreraSeleccionada' AND liberado = 0";

    if ($conexion->query($sql) === TRUE) {
        echo "Datos filtrados por carrera guardados correctamente";
    } else {
        echo "Error al guardar los datos: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "No se recibió la carrera seleccionada correctamente";
}
?>
