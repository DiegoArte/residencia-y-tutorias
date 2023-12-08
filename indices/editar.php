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

// Obtener opciones de carrera, materia y semestre desde la tabla "materia"
$queryCarreras = "SELECT DISTINCT NombredeCarrera FROM carrera";
$resultCarreras = $conn->query($queryCarreras);

// Obtener opciones para semestre
$querySemestres = "SELECT DISTINCT Semestre FROM grupos";
$resultSemestres = $conn->query($querySemestres);

// Obtener opciones para unidad
$queryMaterias = "SELECT DISTINCT NombredelaMateria FROM materias";
$resultMaterias = $conn->query($queryMaterias);

$queryGrupos = "SELECT DISTINCT NumerodeControl FROM materias";
$resultGrupos = $conn->query($queryGrupos);

$queryLimiteUnidad = "SELECT MAX(Unidades) AS limite FROM materias";
$resultLimiteUnidad = $conn->query($queryLimiteUnidad);
// Verificar si la consulta fue exitosa
if ($resultLimiteUnidad) {
    $rowLimiteUnidad = $resultLimiteUnidad->fetch_assoc();
    $limiteUnidad = $rowLimiteUnidad['limite'];
} else {
    // Manejo de error si la consulta falla
    $limiteUnidad = 10; // Establecer un valor predeterminado en caso de error
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    
    $sql = "SELECT * FROM indices WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $carrera = $row["carrera"];  // Corregir la asignación de la variable
        $materia = $row["materia"];  // Corregir la asignación de la variable
        $semestre = $row["semestre"];  // Corregir la asignación de la variable
        $grupo = $row["grupo"];  // Corregir la asignación de la variable
        $unidad = $row["unidad"];  // Corregir la asignación de la variable
        $alumnosA = $row["alumnosA"];  // Corregir la asignación de la variable
        $alumnosR = $row["alumnosR"];  // Corregir la asignación de la variable
   
    
    } else {
        echo "Registro no encontrado";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $carrera = $_POST["NombredeCarrera"];
    $materia = $_POST["NombredelaMateria"];
    $semestre = $_POST["Semestre"];
    $grupo = $_POST["NumerodeControl"];
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
                <img src="../img/profile.png" alt="">
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
                    <div class="container mt-8">
                        <h1>Editar Registro</h1>
                                <hr>
                        <div class="row">
                            <div class="col-md-8 offset-md-4">
                               
                                   

               
                                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                                    <div class="col-md-5">
                                        <label for="NombredeCarrera" class="form-label">Plan de estudio</label>
                                        <select class="form-select" id="NombredeCarrera" name="NombredeCarrera" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            while ($row = $resultCarreras->fetch_assoc()) {
                                                $selected = ($row['NombredeCarrera'] == $carrera) ? 'selected' : '';
                                                echo "<option value='" . $row['NombredeCarrera'] . "' $selected>" . $row['NombredeCarrera'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                   
                                    <div class="col-md-5">
                                        <label for="NombredelaMateria" class="form-label">Materia</label>
                                        <select class="form-select" id="NombredelaMateria" name="NombredelaMateria" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            while ($row = $resultMaterias->fetch_assoc()) {
                                                $selected = ($row['NombredelaMateria'] == $materia) ? 'selected' : '';
                                                echo "<option value='" . $row['NombredelaMateria'] . "' $selected>" .  $row['NombredelaMateria'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="Semestre" class="form-label">Semestre</label>
                                        <select class="form-select" id="Semestre" name="Semestre" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            while ($row = $resultSemestres->fetch_assoc()) {
                                                $selected = ($row['Semestre'] == $semestre) ? 'selected' : '';
                                                echo "<option value='" . $row['Semestre'] . "' $selected>" .  $row['Semestre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="NumerodeControl" class="form-label">Número de control</label>
                                        <select class="form-select" id="NumerodeControl" name="NumerodeControl" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            // Obtener opciones para grupo
                                            while ($row = $resultGrupos->fetch_assoc()) {
                                                $selected = ($row['NumerodeControl'] == $grupo) ? 'selected' : '';
                                                echo "<option value='" . $row['NumerodeControl'] . "' $selected>" . $row['NumerodeControl'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="unidad" class="form-label">Unidad</label>
                                        <select class="form-select" id="unidad" name="unidad" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            for ($i = 1; $i <= $limiteUnidad; $i++) {
                                                $selected = ($i == $unidad) ? 'selected' : '';
                                                echo "<option value='" . $i . "' $selected>" . $i . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <div>
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-md-8 offset-md-4">
                        <div class="col-md-5">
                            <label for="alumnosA"  class="form-label">Alumnos Aprobados:</label>
                            <input type="text" class="form-control" name="alumnosA" value="<?php echo $alumnosA; ?>"><br>
                        </div>
                        <div class="col-md-5">
                            <label for="alumnosA"  class="form-label">Alumnos Aprobados:</label>
                        
                            <input type="text" class="form-control" name="alumnosR" value="<?php echo $alumnosR; ?>"><br>
                        </div>
                    </div>
                </div>
                       
            </form>
            <input class="eliminar" type="submit" value="Actualizar">

        </main>

    </body>

</html>