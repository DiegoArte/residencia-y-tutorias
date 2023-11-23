<?php
// Configuración de la conexión a la base de datos (ajusta estos valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener las empresas
$sql = "SELECT empresa FROM documento"; // Reemplaza 'nombre_empresa' y 'empresas' con tus nombres de columna y tabla reales
$resultado = $conexion->query($sql);

$empresas = array();

if ($resultado->num_rows > 0) {
    // Recorrer los resultados y almacenarlos en un array
    while ($row = $resultado->fetch_assoc()) {
        $empresas[] = $row["empresa"];
    }
}

// Cerrar conexión
$conexion->close();

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode(['empresas' => $empresas]);
?>
