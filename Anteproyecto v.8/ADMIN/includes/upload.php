<?php

// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);

    $idalumno = $_POST['idalumno'];
    $nombre = $_POST['nombrealumno'];
    $nombreproyecto = $_POST['nombreproyecto'];
    $empresa = $_POST['empresa'];

    // Definir la carpeta de destino para usuarios
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "pdf" || $extension == "doc" || $extension == "docx") {

        // Mover el archivo a la carpeta de destino para usuarios
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos
            include "db.php";
            $sql = "INSERT INTO documento (idalumno,nombrealumno, nombreproyecto, empresa, archivo) 
                    VALUES ('$idalumno','$nombrealumno', '$nombreproyecto','$empresa','$carpeta_destino$nombre_archivo')";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo "<script language='JavaScript'>
                alert('Archivo Subido');
                location.assign('../views/index.php');
                </script>";

                // Definir la nueva carpeta de destino y el nuevo nombre del archivo
                $nueva_carpeta_destino = "ADMIN/includes/files/";  // Cambia "nueva_ruta/" a la ruta real de tu nueva carpeta

                // Copiar el archivo a la nueva carpeta
                if (copy($carpeta_destino . $nombre_archivo, $nueva_carpeta_destino)) {
                    echo "Archivo copiado a la nueva carpeta.";
                } else {
                    echo "Error al copiar el archivo a la nueva carpeta.";
                }
            } else {
                echo "<script language='JavaScript'>
                alert('Error al subir el archivo: ');
                location.assign('../views/index.php');
                </script>";
            }
        } else {
            echo "<script language='JavaScript'>
            alert('Error al subir el archivo. ');
            location.assign('../views/index.php');
            </script>";
        }
    } else {
        echo "<script language='JavaScript'>
        alert('Solo se permiten archivos PDF, DOC y DOCX.');
        location.assign('../views/index.php');
        </script>";
    }
}
?>
