<?php
// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

// Crear la conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$search = $_GET['search'] ?? '';

$sql = "SELECT idalumno, nombrealumno, carrera, archivo FROM documento WHERE liberado = 0";

// Si se proporciona una cadena de búsqueda, agregarla a la consulta
if (!empty($search)) {
    $sql .= " AND carrera LIKE '%$search%'";
}

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["idalumno"] . "</td><td>" . $row["nombrealumno"] . "</td><td>" . $row["carrera"] . "</td><td>" . $row["archivo"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay asesorados registrados para esta carrera</td></tr>";
}

$conexion->close();
?>
