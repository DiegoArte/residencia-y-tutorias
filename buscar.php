<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "tutorias_residencia");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
}

$searchTerm = $_GET['searchTerm'];

// Consulta SQL para buscar en la base de datos
$sql = "SELECT * FROM carrera WHERE NumerodeControl LIKE '%$searchTerm%' OR NombredeCarrera LIKE '%$searchTerm%' OR NumerodeSemestres LIKE '%$searchTerm%'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array());
}

$mysqli->close();
?>
