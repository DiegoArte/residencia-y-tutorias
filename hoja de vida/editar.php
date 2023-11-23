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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Obtener datos del registro específico
    $sql = "SELECT * FROM indices WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $carrera = $row["carrera"];
        $materia = $row["materia"];
        $semestre = $row["semestre"];
        $unidad = $row["unidad"];
        $alumnosA = $row["alumnosA"];
        $alumnosR = $row["alumnosR"];
    } else {
        echo "Registro no encontrado";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $carrera = $_POST["carrera"];
    $materia = $_POST["materia"];
    $semestre = $_POST["semestre"];
    $unidad = $_POST["unidad"];
    $alumnosA = $_POST["alumnosA"];
    $alumnosR = $_POST["alumnosR"];

    // Actualizar el registro en la base de datos
    $sql = "UPDATE indices SET carrera='$carrera', materia='$materia', semestre='$semestre', unidad='$unidad', alumnosA='$alumnosA', alumnosR='$alumnosR' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: Tabla_mostrar.php");
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
</head>
<body>

<h2>Editar Registro</h2>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
    Materia: <input type="text" name="materia" value="<?php echo $materia; ?>"><br>
    Semestre: <input type="text" name="semestre" value="<?php echo $semestre; ?>"><br>
    Unidad: <input type="text" name="unidad" value="<?php echo $unidad; ?>"><br>
    AlumnosA: <input type="text" name="alumnosA" value="<?php echo $alumnosA; ?>"><br>
    AlumnosR: <input type="text" name="alumnosR" value="<?php echo $alumnosR; ?>"><br>
    <input type="submit" value="Actualizar">
</form>
<a href="Tabla_mostrar.php">Regresar</a>

</body>
</html>
