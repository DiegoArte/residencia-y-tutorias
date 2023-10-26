<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/estiloAssitencia.css"/>
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Asistencia</title>
    <link rel="icon" type="image/gif" href="css/plano.gif">
</head>
<body>
    <main>
        <div class="barraLateral fixed h-100">
        </div>
        <div class="barraLateral fixed h-100">  
            <header class="fixed w-100">
                <div class="usuarioOp d-flex justify-content-end">
                    <img src="img/profile.png" alt="" />
                    <p>Usuario</p>
                    <a href="#">Cerrar sesión</a>
                </div>
            </header>
            <a href="#"></a>
        </div>
        <div class="barraLateral fixed h-100">
        </div>

        <div class="container" style="padding-top: 80px; padding-left: 50px;">
            <div class="container mb-3">
                <h2>Lista de asistencia</h2>
                <form action="" method="post">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="Actividad"></textarea>
                                <label for="Actividad">Actividad del dia planeada</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col mb-3">
                            <div class="form-floating">
                                <select class="form-select" name="acade" id="acade">
                                    <option value="ISC">Ingenieria en sistemas computacionales</option>
                                    <option value="IGE">Ingenieria en gestion Empresarial</option>
                                    <option value="IA">Ingeniereia en administracion</option>
                                    <option value="IEM">Ingenieria en electromecanica</option>
                                    <option value="II">Ingenieria industrial</option>
                                    <option value="IGE">Contador público</option>
                                </select>
                                <label for="acade">Selecciona la carrera</label>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="semes">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                    <option value="3">6</option>
                                    <option value="2">7</option>
                                    <option value="3">8</option>
                                </select>
                                <label for="semes">Selecciona el periodo semestral</label>
                            </div>
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
                $fechaObj = new DateTime($fecha);
                $fechaFormateada = $fechaObj->format('d/m/Y');
                echo "<table class='table table-bordered'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Número de Control</th>";
                echo "<th>Nombre del Estudiante</th>";
                echo "<th>$fechaFormateada</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                require_once "php/db.php";
                $conexion=conectar();
                $sql = "SELECT NumerodeControl, NombredelEstudiante FROM alumnos WHERE Academia='$acade'";
                $resul = $conexion->query($sql);

                if ($resul->num_rows > 0) {
                    while ($fila = $resul->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila["NumerodeControl"] . "</td>";
                        echo "<td>" . $fila["NombredelEstudiante"] . "</td>";
                        echo "<td><input type='checkbox' name='asistencia[]' value='" . $fila["NumerodeControl"] . "'></td>";
                        echo "</tr>";
                    }
                }
                else {
                    echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<div class='col mb-3'>";
                    echo "<button type='submit' class='btn btn-primary'>Guardar</button>";
                echo "</div>";
            }
            ?>

        </div>
    </main>
</body>
</html>
