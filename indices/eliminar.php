<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Eliminar el registro de la base de datos
    $sql = "DELETE FROM indices WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: Tabla_mostrar.php");
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
        
    }
}


$conn->close();
?>
