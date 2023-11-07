<?php

if (isset($_POST['idalumno'])) {
    $idalumno = $_POST['idalumno'];


    require_once "../includes/db.php";

    // Verifica si el ID de alumno existe antes de eliminar
    $sql = "SELECT * FROM documento WHERE idalumno = $idalumno";
    $result = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // El ID de alumno existe, ahora puedes ejecutar la consulta de eliminación
        $sql = "DELETE FROM documento WHERE idalumno = $idalumno";

        if (mysqli_query($conexion, $sql)) {
            echo "success";
        } else {
            echo "error: " . mysqli_error($conexion); // Muestra el mensaje de error específico
        }
    } else {
        echo "El ID de alumno no existe en la base de datos.";
    }

    mysqli_close($conexion);
}

    ?>