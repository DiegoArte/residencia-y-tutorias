<?php
session_start();
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
        $grupo = $row["grupo"];
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
    $grupo = $_POST["grupo"];
    $unidad = $_POST["unidad"];
    $alumnosA = $_POST["alumnosA"];
    $alumnosR = $_POST["alumnosR"];

    // Actualizar el registro en la base de datos
    $sql = "UPDATE indices SET carrera='$carrera', materia='$materia', semestre='$semestre',grupo='$grupo', unidad='$unidad', alumnosA='$alumnosA', alumnosR='$alumnosR' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: /Tabla_mostrar.php");
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

// Obtener opciones de carrera, materia y semestre desde la tabla "materia"
$queryCarreras = "SELECT DISTINCT carrera FROM materia";
$resultCarreras = $conn->query($queryCarreras);

$querySemestres = "SELECT DISTINCT semestre FROM materia";
$resultSemestres = $conn->query($querySemestres);

$queryMaterias = "SELECT DISTINCT materia FROM materia";
$resultMaterias = $conn->query($queryMaterias);

$conn->close();
?>

<<!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" >
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/comunicacionDocenteAlumno.css">  
        <link rel="stylesheet" href="indices.css">
        <link rel="stylesheet" href="../css/normalize.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <title>Editar Registro</title>

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
            <a href="../Tabla_mostrar.php" class="back-arrow rounded-pill d-flex justify-content-start">
                <img src="../img/back.svg" alt="" height="50">
                <span class="regresar d-none text-white m-auto">Regresar</span>
            </a>
            <div class="usuarioOp d-flex justify-content-end">
                <img src=".../img/profile.png" alt="">
                <?php
                $nombre = $_SESSION['nombre'];
                echo '<p>' . $nombre . '</p>';
                ?>
                <div class="dropdown-content">
                    <a href="logout.php">Cerrar sesión</a>
                </div>
        </header>
        <main>
            <div class="barraLateral fixed h-100">
                <a href="#"></a>
            </div>
            <div class="container" style="margin-top: 10%;">
                <h1>Editar Registro</h1>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="col-md-5">
                        <label for="carrera" class="form-label">Plan de estudio</label>
                        <select class="form-select" id="carrera" name="carrera" required>
                            <option value="">Seleccione</option>
                            <?php
                            while ($row = $resultCarreras->fetch_assoc()) {
                                $selected = ($row['carrera'] == $carrera) ? 'selected' : '';
                                echo "<option value='" . $row['carrera'] . "' $selected>" . $row['carrera'] . "</option>";
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
                                $selected = ($row['materia'] == $materia) ? 'selected' : '';
                                echo "<option value='" . $row['materia'] . "' $selected>" .  $row['materia'] . "</option>";
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
                                $selected = ($row['semestre'] == $semestre) ? 'selected' : '';
                                echo "<option value='" . $row['semestre'] . "' $selected>" .  $row['semestre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div>

                        Grupo= <input type="text" name="grupo" value="<?php echo $grupo; ?>"><br>
                        Unidad: <input type="text" name="unidad" value="<?php echo $unidad; ?>"><br>
                        AlumnosA: <input type="text" name="alumnosA" value="<?php echo $alumnosA; ?>"><br>
                        AlumnosR: <input type="text" name="alumnosR" value="<?php echo $alumnosR; ?>"><br>
                        <input class="eliminar" type="submit" value="Actualizar">

                    </div>
                </form>

        </main>

    </body>

    </html>