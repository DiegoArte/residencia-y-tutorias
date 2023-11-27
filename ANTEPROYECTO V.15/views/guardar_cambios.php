<?php
if (isset($_POST['guardar_cambios'])) {
    require_once "../includes/db.php"; // Asegúrate de incluir tu archivo de conexión a la base de datos

    // Recupera los datos del formulario o los datos que deseas guardar en la nueva tabla
    $idalumno = $_POST['idalumno'];
    $nombrealumno = $_POST['nombrealumno'];
    $nombreass = $_POST['NombredelDocente'];
    
  

    // Inserta los datos en la nueva tabla
    $sqlGuardarCambios = "INSERT INTO asesorados (id, alumno, asesor) VALUES ('$idalumno', '$nombrealumno', '$nombreass')";
    $resultadoGuardarCambios = mysqli_query($conexion, $sqlGuardarCambios);

    if ($resultadoGuardarCambios) {
        echo "<script language='JavaScript'>
        alert('Cambios guardados en la nueva tabla');
        // Otra redirección o acción después de guardar los cambios si es necesario
        </script>";
    } else {
        echo "<script language='JavaScript'>
        alert('Error al guardar los cambios en la nueva tabla: " . mysqli_error($conexion) . "');
        </script>";
    }
}
?>
