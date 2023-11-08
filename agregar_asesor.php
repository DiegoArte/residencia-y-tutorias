<?php
// Conecta a la base de datos
require '../php/db.php';

// Realiza una consulta para obtener la lista de carreras
$query = "SELECT id_carrera, nombre_carrera FROM carreras";
$result = mysqli_query($con, $query);

$carreras = array();

while ($row = mysqli_fetch_assoc($result)) {
    $carreras[] = $row;
}

// Devuelve la lista de carreras en formato JSON
echo json_encode($carreras);

// Cierra la conexión a la base de datos
mysqli_close($con);
?>

