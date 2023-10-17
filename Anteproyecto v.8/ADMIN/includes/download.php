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
        // Configurar cabeceras para la descarga del archivo
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=' . basename($ruta_archivo));
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($ruta_archivo));
        ob_clean();
        flush();
        
        // Leer y mostrar el archivo en el navegador
        readfile($ruta_archivo);
        exit;
    } else {
        echo "El archivo no existe en el servidor.";
    }
} else {
    echo "El archivo no se encontró en la base de datos.";
}
?>
