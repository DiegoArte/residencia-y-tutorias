<?php
// Establece la conexión a tu base de datos (debes configurar esto)

require 'db.php';

$conexion=conectar();

// Obtiene las fechas desde el formulario
$fechaInicio1 = $_POST['fechaInicio1'];
$fechaFinal1 = $_POST['fechaFinal1'];

// Elimina los registros existentes en la tabla fecharepo1


if($fechaFinal1>$fechaInicio1){
    $conexion->query("DELETE FROM fecharepoTu1");

    // Inserta los nuevos datos en la tabla fecharepo1
    $sql = "INSERT INTO fecharepoTu1 (fechaini, fechafin) VALUES ('$fechaInicio1', '$fechaFinal1')";
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