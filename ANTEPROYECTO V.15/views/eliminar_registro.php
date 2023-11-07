<?php
// Conéctate a tu base de datos (ajusta los detalles de la conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtiene el ID del alumno a eliminar desde la solicitud POST
$data = json_decode(file_get_contents("php://input"));
$idAlumno = $data->id;

// Realiza la consulta para eliminar el registro
$sql = "DELETE FROM documento WHERE idalumno = $idAlumno";

if ($conn->query($sql) === TRUE) {
    // Éxito al eliminar el registro
    echo "Registro eliminado correctamente";
} else {
    // Error al eliminar el registro
    echo "Error al eliminar el registro: " . $conn->error;
}

// Cierra la conexión a la base de datos
$conn->close();
?>
