<?php

if (isset($_FILES['archivo'])) {
    extract($_POST);
    $idalumno = $_POST['idalumno'];
    $nombre = $_POST['nombrealumno'];
    $nombreproyecto = $_POST['nombreproyecto'];
    $empresa = $_POST['empresa'];
    $asesor = $_POST['asesor'];
    
    // Verificar si se ha cargado un archivo
    if (!empty($_FILES["archivo"]["name"])) {
        // Definir la carpeta de destino
        $carpeta_destino = "files/";

        // Obtener el nombre y la extensión del archivo
        $nombre_archivo = basename($_FILES["archivo"]["name"]);
        $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

        // Validar la extensión del archivo
        if ($extension == "pdf") {
            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
                // Insertar la información del archivo en la base de datos
                include "db.php";
                $sql = "INSERT INTO documento (idalumno, nombrealumno, nombreproyecto, empresa, asesor, archivo) 
                VALUES ( '$idalumno', '$nombrealumno', '$nombreproyecto', '$empresa', '$asesor', '$nombre_archivo')";
                $resultado = mysqli_query($conexion, $sql);
                if ($resultado) {
                    echo "<script language='JavaScript'>
                    alert('Registro Guardado');
                    location.assign('../views/index(VISTA ALUMNO).php');
                    </script>";
                } else {
                    echo "<script language='JavaScript'>
                    alert('Error al subir el archivo: ');
                    location.assign('../views/index(VISTA ALUMNO).php');
                    </script>";
                }
            } else {
                echo "<script language='JavaScript'>
                alert('Error al subir el archivo. ');
                location.assign('../views/index(VISTA ALUMNO).php');
                </script>";
            }
        } else {
            echo "<script language='JavaScript'>
            alert('Solo se permiten archivos PDF.');
            location.assign('../views/index(VISTA ALUMNO).php');
            </script>";
        }
    } else {
        // Insertar la información en la base de datos sin el archivo
        include "db.php";
        $sql = "INSERT INTO documento (idalumno, nombrealumno, nombreproyecto, empresa, asesor) 
        VALUES ( '$idalumno', '$nombrealumno', '$nombreproyecto', '$empresa', '$asesor')";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo "<script language='JavaScript'>
            alert('Registro Guardado');
            location.assign('../views/index(VISTA ALUMNO).php');
            </script>";
        } else {
            echo "<script language='JavaScript'>
            alert('Error al guardar el registro: ');
            location.assign('../views/index(VISTA ALUMNO).php');
            </script>";
        }
    }
}
