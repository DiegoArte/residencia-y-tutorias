<?php
session_start();
$carrera=$_GET['carrera']??"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/estiloAssitencia.css"/>
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <link rel="stylesheet" href="css/estilo01_botones.css">
    <title>Asistencia</title>
    <link rel="icon" type="image/gif" href="css/plano.gif">
</head>
<body>
<header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
        <img src="img/profile.png" alt="" >
            <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>
        </div>
    </header>
    <main>
        <div class="barraLateral fixed h-100">
        <a href="formatos.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
        </a>
        <button type="button" class="boton2" data-bs-toggle="modal" data-bs-target="#exampleModal">Generar lista</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Generar la lista para imprimir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="php/GeneraAsis.php" method="POST">
                <div class="row mb-3">
                        <div class="col mb-3">
                        <label for="acade">Selecciona la carrera</label>
                        <select class="form-select" name="acade" id="acade">
                            <?php
                            require_once "php/db.php";
                            $conexion = conectar();

                            $sql = "SELECT NombredeCarrera, Semestre FROM grupos";
                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                $currentGroup = '';

                                while ($row = $result->fetch_assoc()) {
                                    $carrera = $row["NombredeCarrera"];
                                    $semestre = $row["Semestre"];
                                    $opcion = $carrera . " - " . $semestre;

                                    if ($currentGroup !== $carrera) {
                                        if ($currentGroup !== '') {
                                            echo '</optgroup>';
                                        }
                                        echo '<optgroup label="' . $carrera . '">';
                                        $currentGroup = $carrera;
                                    }

                                    echo "<option value='" . $opcion . "'>" . $opcion . "</option>";
                                }

                                echo '</optgroup>';
                            } else {
                                echo "<option value=''>No hay datos</option>";
                            }

                            $conexion->close();
                            ?>
                        </select>
                        </div>
                        </div>
                    
                    <div class="row mb-3">
                        <label class="form-label">Selecciona la fecha de la asistencia</label>
                        <input type="date" name="fecha">
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Generar</button>
            </div>
            </div>
            </form>
        </div>
        </div>

        <div class="container" style="padding-top: 80px; padding-left: 50px;">
            <div class="container mb-3">
                <h2>Lista de asistencia</h2>
                <form action="" method="post">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" name="Actividad" id="Actividad"></textarea>
                                <label for="Actividad">Actividad del dia planeada</label>
                            </div>
                        </div>
                    </div>

                    <?php
                    $conec=conectar();
                    $com1="SELECT NumerodeControl FROM `docentes` WHERE NombredelDocente = '$nombre'";
                    $res1=$conec->query($com1);

                    while ($row=$res1->fetch_assoc()){
                        $de=$row['NumerodeControl'];                        
                    }

                    $com2="SELECT Grupo FROM `tabla_tutorados` WHERE Tutor = '$de'";
                    $res2=$conec->query($com2);

                    while ($row=$res2->fetch_assoc()){
                        $gru=$row['Grupo'];                        
                    }

                    $com3="SELECT NombredeCarrera, Semestre FROM `grupos` WHERE NumerodeControl = '$gru'";
                    $res3=$conec->query($com3);

                    while ($row=$res3->fetch_assoc()){
                        $ca=$row['NombredeCarrera'];
                        $se=$row['Semestre'];
                        $op=$ca . " - " . $se;

                    }
                    $conec->close();
                    ?>

                    <div class="row mb-3">
                        <div class="col mb-3">
                        <label for="acade">Selecciona la carrera</label>
                        <select class="form-select" name="acade" id="acade">
                            <?php
                            require_once "php/db.php";
                            $conexion = conectar();

                            $sql = "SELECT NombredeCarrera, Semestre FROM grupos";
                            $result = $conexion->query($sql);

                            $opSeleccionada = $op; // La opción que deseas seleccionar por defecto

                            if ($result->num_rows > 0) {
                                $currentGroup = '';

                                while ($row = $result->fetch_assoc()) {
                                    $carrera = $row["NombredeCarrera"];
                                    $semestre = $row["Semestre"];
                                    $opcion = $carrera . " - " . $semestre;

                                    $selected = ($opcion === $opSeleccionada) ? 'selected' : ''; // Compara y selecciona la opción deseada

                                    if ($currentGroup !== $carrera) {
                                        if ($currentGroup !== '') {
                                            echo '</optgroup>';
                                        }
                                        echo '<optgroup label="' . $carrera . '">';
                                        $currentGroup = $carrera;
                                    }

                                    echo "<option value='" . $opcion . "' " . $selected . ">" . $opcion . "</option>";
                                }

                                echo '</optgroup>';
                            } else {
                                echo "<option value=''>No hay datos</option>";
                            }

                            $conexion->close();
                            ?>
                        </select>
                        </div>
                        </div>

                    <div class="row mb-3">
                        <div class="col mb-3">
                            <label class="form-label">Selecciona la fecha de hoy</label>
                            <input type="date" name="fecha">
                        </div>
                        <div class="col mb-3">
                            <button type="submit" class="btn btn-primary">Generar lista</button>
                        </div>
                </div>
            </form>
        </div>
            <hr>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $acade = $_POST["acade"];
                $fecha = $_POST["fecha"];
                $activi =$_POST["Actividad"];
                $fechaObj = new DateTime($fecha);
                $fechaFormateada = $fechaObj->format('d/m/Y');
                echo "<form action='php/guardar_asistencia.php' method='post'>";
                echo "<div class='row mb-3'>";
                echo "<div class='col'>";
                echo "<div class='form-floating'>";
                echo "<input class='form-control' id='grup' name='grup' type='text' value='$acade'>";
                echo " <label for='grup'>Grupo</label>";
                echo "</div>";
                echo "</div>";
                echo "<div class='col'>";
                echo "<div class='form-floating'>";
                echo "<input class='form-control' id='date' name='date' type='text' value='$fechaFormateada'>";
                echo " <label for='fecha'>Fecha</label>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "<div class='form-floating'>";
                echo "<textarea class='form-control' id='act' name='act' type='text'>$activi</textarea>";
                echo " <label for='act'>Actividad del dia planeada</label>";
                echo "</div>";
                echo "<table name='lista' id='lista' class='table table-bordered'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Número de Control</th>";
                echo "<th>Nombre del Estudiante</th>";
                echo "<th>Asistencia</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                require_once "php/db.php";
                $conexion=conectar();
                $sql = "SELECT NumeroDeControl, NombreDelEstudiante FROM alumnosnormales WHERE Academia='$acade'";
                $resul = $conexion->query($sql);

                if ($resul->num_rows > 0) {
                    while ($fila = $resul->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila["NumeroDeControl"] . "</td>";
                        echo "<td>" . $fila["NombreDelEstudiante"] . "</td>";
                        // Añadir campos ocultos con otros datos de la fila
                        echo "<td><input type='checkbox' name='asistencia[]' value='" . $fila["NumeroDeControl"] . "' id='asistencia-" . $fila["NumeroDeControl"] . "'></td>";
                        echo "</tr>";
                    }
                }
                else {
                    echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<div class='col mb-3'>";
                    echo "<button type='submit' class='btn btn-primary' id='btnGuardar' name='btnGuardar'>Guardar</button>";
                echo "</div>";
                echo "</form>";

            $conexion->close();
            }
            
            ?>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
