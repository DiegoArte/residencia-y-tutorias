<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carrera = $_POST["carrera"];
    $materia = $_POST["materia"];
    $semestre = $_POST["semestre"];
    $unidad = $_POST["unidad"];
    $alumnosA = $_POST["alumnosA"];
    $alumnosR = $_POST["alumnosR"];

    // Insertar nuevo registro en la base de datos
    $sql = "INSERT INTO indices (carrera, materia, semestre, unidad, alumnosA, alumnosR) VALUES ('$carrera', '$materia', '$semestre', '$unidad', '$alumnosA', '$alumnosR')";

    if ($conn->query($sql) === TRUE) {
        header("Location: Tabla_mostrar.php");
    } else {
        echo "Error al añadir el registro: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Registro</title>
</head>
<body>

<h2>Añadir Registro</h2>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<div class="col-md-5">
    <label for="carrera" class="form-label">Plan de estudio</label>
    <select class="form-select" id="carrera" name="carrera" required>
        <option value="0">Seleccione</option> 
        <option value="Ingeniería Industrial">Ingeniería Industrial</option>
        <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
        <option value="Ingeniería en Electromecánica">Ingeniería en Electromecánica</option>
        <option value="Ingeniería en Gestión Empresarial">Ingeniería en Gestión Empresarial</option>
        <option value="Contador Público">Contador Público</option>
        <option value="Ingeniería en Administración">Ingeniería en Administración</option>

    </select>
</div>
    Materia: <input type="text" name="materia"><br>
    Semestre: <input type="text" name="semestre"><br>
    Unidad: <input type="text" name="unidad"><br>
    AlumnosA: <input type="text" name="alumnosA"><br>
    AlumnosR: <input type="text" name="alumnosR"><br>
    <input type="submit" value="Añadir">
</form>
<a href="Tabla_mostrar.php">Regresar</a>
</body>
</html>

