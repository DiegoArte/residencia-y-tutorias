<?php
include "db.php";

// Obtener el nombre del archivo desde la URL
$idalumno = $_GET['idalumno'];

// Buscar el archivo en la base de datos
$sql = "SELECT * FROM documento WHERE idalumno = '$idalumno'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_assoc($resultado);
    $archivo = $fila['archivo'];
    $ruta_archivo = "files/" . $archivo;

    // Verificar que el archivo exista en el servidor
    if (file_exists($ruta_archivo)) {
        // Mostrar el archivo en el navegador
        header('Content-Type: ' . mime_content_type($ruta_archivo));
        readfile($ruta_archivo);
    } else {
        echo "El archivo no existe en el servidor.";
    }
} else {
    echo "El archivo no se encontró en la base de datos.";
}
?>

