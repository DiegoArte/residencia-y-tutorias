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
        header("Location: /Tabla_mostrar.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">  
    <link rel="stylesheet" href="indices.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Añadir Registro</title>
    <style>
    header {
      z-index: 1;
    }

    .back-arrow {
      position: absolute !important;
      margin: 90px 70px;
      background-color: #4F648B;
      padding: 10px;
      top: 15px;
      font-size: 16px;
    }

    .back-arrow:hover .regresar {
      display: block !important;
    }

    img {
      width: 50px;
      /* Puedes ajustar el valor según tus necesidades */
      height: auto;
      /* Para mantener la proporción de la imagen */
    }
  </style>

</head>
<body>
    <header class="fixed w-100">
        <a href="/Tabla_mostrar.php" class="back-arrow rounded-pill d-flex justify-content-start">
        <img src="../img/back.svg" alt="" height="50">
        <span class="regresar d-none text-white m-auto">Regresar</span>
        </a>
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
    </main>
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
        <a class="eliminar" href="/Tabla_mostrar.php">Regresar</a>
    </div>
    

</main>

</body>
</html>
