<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "tutorias_residencia";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del registro a eliminar (puede ser proporcionado a través de una solicitud POST o GET)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sentencia SQL para eliminar el registro
    $sql = "DELETE FROM documento WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado con éxito";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
} else {
    echo "ID del registro no proporcionado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
