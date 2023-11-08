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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["registro_id"]) && isset($_POST["asesor_id"])) {
    $registro_id = $_POST["registro_id"];
    $asesor_id = $_POST["asesor_id"];
    
    // Actualizar el asesor del registro en la base de datos
    $query = "UPDATE asesorados SET Asesor='$asesor_id' WHERE id='$registro_id'";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: formulario.php"); // Redirige a tu página principal
        exit();
    } else {
        echo "Error al actualizar el asesor: " . mysqli_error($conexion);
    }
} else {
    echo "Error en la solicitud: datos faltantes.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
