<?php
// Establecer la conexión a la base de datos
function Conex(){


$servername = "localhost"; // Cambia esto si es necesario
$username = "root";
$password = "";
$dbname = "prueba_de_ryt";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
else{
    return $conn;
}
}
?>