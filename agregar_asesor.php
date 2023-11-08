<?php
// Conexión a la base de datos (reemplaza con tus propios valores)
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "tutorias_residencia";

$conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre_asesor = $_POST["nombre_asesor"];
    
    // Insertar el asesor en la base de datos
    $query = "INSERT INTO asesorados (Asesor) VALUES ('$nombre_asesor')";
    if (mysqli_query($conexion, $query)) {
        echo "Asesor agregado con éxito.";
    } else {
        echo "Error al agregar el asesor: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
