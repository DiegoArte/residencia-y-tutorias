<?php
include "db.php";

// Verificar si se proporcionó un ID válido
if(isset($_GET['idalumno'])) {
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
            // Establecer la cabecera para mostrar el PDF en el navegador
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $archivo . '"');

            // Leer y mostrar el contenido del archivo PDF
            readfile($ruta_archivo);
        } else {
            echo "El archivo no existe en el servidor.";
        }
    } else {
        echo "El archivo no se encontró en la base de datos.";
    }
} else {
    echo "ID no proporcionado o inválido.";
}
?>
