<!DOCTYPE html>
<html>
<head>
    <title>Registros y Asesores</title>
</head>
<body>

<h1>Registros</h1>

<?php
// Conexión a la base de datos (reemplaza con tus propios valores)
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "tutorias_residencia";

$conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Mostrar registros con opción de actualización de asesor
$query = "SELECT * FROM asesorados";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    echo "<ul>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<li>{$fila['id']} - {$fila['Alumno']} - Asesor: {$fila['Asesor']}</li>";
        
        // Formulario para actualizar el asesor de este registro
        echo "<form method='post' action='actualizar_asesor.php'>";
        echo "<input type='hidden' name='registro_id' value='{$fila['id']}'>";
        
        // Lista desplegable de asesores
        echo "<label>Seleccionar Asesor:</label>";
        echo "<select name='asesor_id'>";
        
        // Consulta para obtener la lista de asesores
        $query_asesores = "SELECT NumerodeControl, NombredelDocente FROM docentes";
        $resultado_asesores = mysqli_query($conexion, $query_asesores);

        if ($resultado_asesores) {
            while ($fila_asesor = mysqli_fetch_assoc($resultado_asesores)) {
                $selected = ($fila_asesor['id'] == $fila['Asesor']) ? "selected" : "";
                echo "<option value='{$fila_asesor['NumerodeControl']}' $selected>{$fila_asesor['NombredelDocente']}</option>";
            }
        }
        
        echo "</select>";
        
        echo "<input type='submit' value='Actualizar Asesor'>";
        echo "</form>";
    }
    echo "</ul>";
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>


</body>
</html>
