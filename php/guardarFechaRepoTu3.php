<?php
// Establece la conexión a tu base de datos (debes configurar esto)

require 'db.php';

$conexion=conectar();

// Obtiene las fechas desde el formulario
$fechaInicio3 = $_POST['fechaInicio3'];
$fechaFinal3 = $_POST['fechaFinal3'];

// Elimina los registros existentes en la tabla fecharepo1


if($fechaFinal3>$fechaInicio3){
    $conexion->query("DELETE FROM fecharepoTu3");

    // Inserta los nuevos datos en la tabla fecharepo1
    $sql = "INSERT INTO fecharepoTu3 (fechaini, fechafin) VALUES ('$fechaInicio3', '$fechaFinal3')";
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