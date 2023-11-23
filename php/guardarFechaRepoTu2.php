<?php
// Establece la conexión a tu base de datos (debes configurar esto)

require 'db.php';

$conexion=conectar();

// Obtiene las fechas desde el formulario
$fechaInicio2 = $_POST['fechaInicio2'];
$fechaFinal2 = $_POST['fechaFinal2'];

// Elimina los registros existentes en la tabla fecharepo1


if($fechaFinal2>$fechaInicio2){
    $conexion->query("DELETE FROM fecharepoTu2");

    // Inserta los nuevos datos en la tabla fecharepo1
    $sql = "INSERT INTO fecharepoTu2 (fechaini, fechafin) VALUES ('$fechaInicio2', '$fechaFinal2')";
    if ($conexion->query($sql) === TRUE) {
    echo "<script>alert('Fecha activada');history.go(-1);</script>";
} else {
    echo "Error al guardar datos: " . $conexion->error; 
}

}else{
    echo "<script>alert('La fecha de Fin es antes que la fecha de inicio');history.go(-1);</script>";
}


// Cierra la conexión a la base de datos
$conexion->close();
?>