<?php
session_start();
$carrera = $_GET['carrera'] ?? "";

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

// Obtener opciones para carrera
$queryCarreras = "SELECT DISTINCT carrera FROM materia";
$resultCarreras = $conn->query($queryCarreras);

// Obtener opciones para semestre
$querySemestres = "SELECT DISTINCT semestre FROM materia";
$resultSemestres = $conn->query($querySemestres);

// Obtener opciones para unidad
$queryMaterias = "SELECT DISTINCT materia FROM materia";
$resultMaterias = $conn->query($queryMaterias);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carrera = $_POST["carrera"];
    $materia = $_POST["materia"];
    $semestre = $_POST["semestre"];
    $grupo = $_POST["grupo"];
    $unidad = $_POST["unidad"];
    $alumnosA = $_POST["alumnosA"];
    $alumnosR = $_POST["alumnosR"];

    // Insertar nuevo registro en la base de datos
    $sql = "INSERT INTO indices (carrera, materia, semestre, grupo, unidad, alumnosA, alumnosR) VALUES ('$carrera', '$materia', '$semestre','$grupo', '$unidad', '$alumnosA', '$alumnosR')";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="indices.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Añadir Registro</title>
</head>
<body>

<header class="fixed w-100">
    <div class="usuarioOp d-flex justify-content-end">
        <img src="profile.png" alt="">
        <?php
        $nombre = $_SESSION['nombre'];
        echo '<p>' . $nombre . '</p>';
        ?>
        <div class="dropdown-content">
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </div>
</header>
<main>
    <div class="barraLateral fixed h-100">
        <a href="#"></a>
    </div>
    <div class="container" style="margin-top: 10%;">
        <h1>Añadir Registro</h1>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="col-md-5">
                <label for="carrera" class="form-label">Plan de estudio</label>
                <select class="form-select" id="carrera" name="carrera" required>
                    <option value="">Seleccione</option>
                    <?php
                    while ($row = $resultCarreras->fetch_assoc()) {
                        echo "<option value='" . $row['carrera'] . "'>" . $row['carrera'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-5">
                <label for="semestre" class="form-label">Semestre</label>
                <select class="form-select" id="semestre" name="semestre" required>
                    <option value="">Seleccione</option>
                    <?php
                    while ($row = $resultSemestres->fetch_assoc()) {
                        echo "<option value='" . $row['semestre'] . "'>" . $row['semestre'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-5">
                <label for="materia" class="form-label">Materia</label>
                <select class="form-select" id="materia" name="materia" required>
                    <option value="">Seleccione</option>
                    <?php
                    while ($row = $resultMaterias->fetch_assoc()) {
                        echo "<option value='" . $row['materia'] . "'>" . $row['materia'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-5">


                Grupo: <input type="text" name="grupo" required><br>
                Unidad: <input type="text" name="unidad" required><br>
                Alumnos Aprobados : <input type="text" name="alumnosA" required><br>
                Alumnos Reprobados: <input type="text" name="alumnosR" required><br>
            </div>
            <input class="eliminar" type="submit" value="Añadir">
            
        </form>
    </div>
</main>
<a class="eliminar2" href="Tabla_mostrar.php" style="margin-top: 10%;">Regresar</a>
</body>
</html>
