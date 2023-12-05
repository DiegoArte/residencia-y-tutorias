<?php
// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

// Recibe el ID y nombre del alumno desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idalumno']) && isset($_POST['nombrealumno'])) {
    $idalumno = $_POST['idalumno'];
    $nombrealumno = $_POST['nombrealumno'];
    echo "ID del alumno: " . $idalumno . "<br>";
    echo "Nombre del alumno: " . $nombrealumno . "<br>";

    // Aquí puedes realizar la lógica para guardar datos en la base de datos
    // Por ejemplo, insertar datos en una tabla
    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Suponiendo que tienes una tabla llamada 'asesorados' con columnas 'Idalumno' y 'Alumno'
    $sql = "INSERT INTO asesorados (Idalumno, Alumno) VALUES ('$idalumno', '$nombrealumno')";
    
    if ($conexion->query($sql) === TRUE) {
        echo "Datos guardados correctamente";
    } else {
        echo "Error al guardar los datos: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "No se recibió el ID o nombre del alumno correctamente";
}
?>
