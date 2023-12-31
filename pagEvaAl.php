<?php
session_start();
$carrera=$_GET['carrera']??"";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/estiloInforRes.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/estiloBoton.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <title>Evaluacion al alumno</title>
    <link rel="icon" type="image/gif" href="css/plano.gif">
</head>
<body>
    
    <header class="fixed w-100">
    <a href="formatos.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
    </a>
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="">
            <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>

            </div>
        </div>
    </header>

    <div class="barraLateral fixed h-100">
        <a href="#"></a>
    </div>
    <div class="container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-md-10 offset-md-2">
                <h2>Evaluacion al Alumno</h2>
                <hr>
                <form action="php/evaluacionalalumno.php" method="post" class="needs-validation" novalidate>

                    <div class="row mb-3">
                        <div class="form-floating">
                            <!-- Reemplazamos el input por la lista desplegable generada desde PHP -->
                            <?php include 'alumnocheck.php'; ?>
                            <label for="opciones">NOMBRE DEL ESTUDIANTE (1):</label>
                            <div class="invalid-feedback">
                                Completa el campo!!
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="form-floating">
                            <input type="text" name="actividad" id="actividad" class="form-control"
                                placeholder="Leave a comment here" required>
                            <label for="actividad">ACTIVIDAD COMPLEMENTARIA (2)</label>
                            <div class="invalid-feedback">
                                Completa el campo!!
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class=" col mb-6">
                            <div class="form-floating">
                                <input type="text" name="periodo" id="periodo" class="form-control"
                                    placeholder="Leave a comment here" required>
                                <label for="periodo">PERIODO DE REALIZACIÓN (3)</label>
                                <div class="invalid-feedback">
                                    Completa el campo!!
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col">
                                <hr>
                                <h5>NIVEL DE DESEMPEÑO DEL CRITERIO (4) </h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Criterios a evaluar</th>
                                            <th>Insuficiente</th>
                                            <th>Suficiente</th>
                                            <th>Bueno</th>
                                            <th>Notable</th>
                                            <th>Insuficiente</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Cumple en tiempo y forma con las actividades encomendadas alcanzando
                                                los objetivos.</td>
                                            <td>
                                                <input type="text" name="I1" id="I1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="S1" id="S1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="B1" id="B1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="N1" id="N1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="E1" id="E1" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Trabaja en equipo y se adapta a nuevas situaciones.</td>
                                            <td>
                                                <input type="text" name="I2" id="I2" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="S2" id="S2" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="B2" id="B2" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="N2" id="N2" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="E2" id="E2" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Muestra liderazgo en las actividades encomendadas.</td>
                                            <td>
                                                <input type="text" name="I3" id="I3" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="S3" id="S3" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="B3" id="B3" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="N3" id="N3" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="E3" id="E3" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Organiza su tiempo y trabaja de manera proactiva.</td>
                                            <td>
                                                <input type="text" name="I4" id="I4" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="S4" id="S4" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="B4" id="B4" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="N4" id="N4" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="E4" id="E4" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Interpreta la realidad y se sensibiliza aportando soluciones a la
                                                problemática con la actividad complementaria.</td>
                                            <td>
                                                <input type="text" name="I5" id="I5" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="S5" id="S5" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="B5" id="B5" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="N5" id="N5" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="E5" id="E5" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Realiza sugerencias innovadoras para beneficio o mejora del programa
                                                en el que participa.</td>
                                            <td>
                                                <input type="text" name="I6" id="I6" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="S6" id="S6" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="B6" id="B6" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="N6" id="N6" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="E6" id="E6" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiene iniciativa para ayudar en las actividades encomendadas y
                                                muestra espíritu de servicio.</td>
                                            <td>
                                                <input type="text" name="I7" id="I7" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="S7" id="S7" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="B7" id="B7" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="N7" id="N7" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="E7" id="E7" class="form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="form-floating">
                                <input type="text" name="observaciones" id="observaciones" class="form-control"
                                    placeholder="Leave a comment here" required>
                                <label for="Observaciones"> OBSERVACIONES (5)</label>
                                <div class="invalid-feedback">
                                    Completa el campo!!
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" name="valor" id="valor"
                                    placeholder="Leave a comment here" required>
                                <label for="Valor"> VALOR NUMÉRICO DE LA ACTIVIDAD COMPLEMENTARIA (6)</label>
                                <div class="invalid-feedback">
                                    Completa el campo!!
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" name="nivel" id="nivel"
                                    placeholder="Leave a comment here" required>
                                <label for="Nivel"> NIVEL DE DESEMPEÑO ALCANZADO DE LA ACTIVIDAD COMPLEMENTARIA
                                    (7)</label>
                                <div class="invalid-feedback">
                                    Completa el campo!!
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Generar</button>
                </form>
            </div>
        </div>
    </div>
    </main>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>