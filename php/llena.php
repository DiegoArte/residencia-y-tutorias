<?php
include 'conexion.php';
conecta();

$Id = filter_input(INPUT_POST, "Id");
$Nombre_Alumno = filter_input(INPUT_POST, "Nombre_Alumno");
$Nombre_del_proyecto = filter_input(INPUT_POST, "Nombre_del_proyecto");
$Empresa = filter_input(INPUT_POST, "Empresa");

// Verificamos si se ha cargado un archivo
if ($_FILES['Anteproyecto']['error'] === UPLOAD_ERR_OK) {
    $Anteproyecto = $_FILES['Anteproyecto']['name'];
    $tempFilePath = $_FILES['Anteproyecto']['tmp_name'];

    // Ruta donde se guardará el archivo en el servidor
    $uploadDirectory = 'C:/xampp/htdocs/Anteproyecto/pdf/';  // Cambia esta ruta a la ruta adecuada en tu servidor
    $targetFilePath = $uploadDirectory . $Anteproyecto;
    
    // Mueve el archivo a la ubicación deseada
    if (move_uploaded_file($tempFilePath, $targetFilePath)) {
        mysqli_select_db($conexion, "anteproyecto");
        
        // Realiza la inserción en la base de datos
        $query = "INSERT INTO archivos (Id, Nombre_Alumno, Nombre_del_proyecto, Empresa, Ruta_Anteproyecto) 
                  VALUES ('$Id', '$Nombre_Alumno', '$Nombre_del_proyecto', '$Empresa', '$targetFilePath')";
        
        if (mysqli_query($conexion, $query)) {
            echo "Datos almacenados correctamente.";
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
    } else {
        echo "Error al cargar el archivo.";
    }
} else {
    echo "Error al cargar el archivo.";
}
?>
