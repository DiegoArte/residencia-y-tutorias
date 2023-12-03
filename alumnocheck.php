<?php
// Conexión a la base de datos (reemplaza con tus datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta a la base de datos para obtener alumnos
$sql = "SELECT NombredelEstudiante FROM alumnos";
$result = $conn->query($sql);

// Comprobar si hay resultados y generar la lista desplegable
if ($result->num_rows > 0) {
    echo '<select name="Nombre" id="nombre" class="form-control" required>';
    echo '<option value="" disabled selected>Selecciona un estudiante</option>'; // Opción inicial
    while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['NombredelEstudiante'] . '">' . $row['NombredelEstudiante'] . '</option>';
    }
    echo '</select>';
} else {
    echo "No se encontraron alumnos";
}

$conn->close();
?>
