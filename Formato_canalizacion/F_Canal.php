<?php
session_start();
$carrera=$_GET['carrera']??"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formato de Canalización</title>
    
    <style>
        body {
            background-color: white;
            font-family: 'Open Sans', sans-serif;
        }

        form {
            width: 60%;
            margin: 0 auto;
            font-weight: bold;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid gray;
            border-radius: 4px;
            box-sizing: border-box;
        }


        .boton{
            display: inline-block;
            background: linear-gradient(to bottom, #0D65D9, #57E3F2);
            width: 300px;
            height: 80px;
            text-align: center;
            color: #000000;
            font-family: 'Open Sans', sans-serif;
            font-weight: bold;
            font-size: 18px;
            
            border-radius: 20px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: button-shimmer 2s infinite;
            transition: all 0.3s ease-in-out;
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
            
            }


            /* Hover animation */
        .boton:hover {
            background: linear-gradient(to bottom, #49C2F2, white);
            animation: button-particles 1s ease-in-out infinite;
            transform: translateY(-2px);
            }
    </style>

<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="jspdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="canal.js"></script>

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/comunicacionDocenteAlumno.css">

</head>
<body>
    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
    </main>
    
    <header class="fixed w-100">
    <a href="../formatos.php" class="back-arrow rounded-pill d-flex justify-content-start">
    <img src="../img/back.svg" alt="" height="50">
    <span class="regresar d-none text-white m-auto">Regresar</span>
    </a>
    <div class="usuarioOp d-flex justify-content-end">
        <img src="../img/profile.png" alt="" >
        <?php
        $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
        echo '<p>' . $nombre . '</p>';
        ?>
        <div class="dropdown-content">
        <a href="../logout.php">Cerrar sesión</a>
        </div>
    </header>
    <br><br><br><br>



    <?php
    require '../php/db.php';
    $mysqli = conectar();

    // Obtener el nombre del tutor de la sesión
    $nombreTutor = $_SESSION['nombre'];

        // Realizar la consulta a la tabla carrera para obtener los nombres de las carreras
        $consulta = "SELECT NombredeCarrera FROM carrera";
        $resultados = $mysqli->query($consulta);
    
        // Verificar si hay resultados
        if ($resultados) {
            // Inicializar una variable para almacenar las opciones del menú desplegable
            $opciones = '';
    
            // Recorrer los resultados y construir las opciones del menú desplegable
            while ($fila = $resultados->fetch_assoc()) {
                $nombreCarrera = $fila['NombredeCarrera'];
                $opciones .= "<option value='$nombreCarrera'>$nombreCarrera</option>";
            }
    
            // Liberar los resultados
            $resultados->free();
        } else {
            // Manejar el caso en que la consulta no sea exitosa
            echo "Error al ejecutar la consulta: " . $mysqli->error;
        }
    

    // Consultar el número de control del docente en la tabla docentes
    $consultaDocente = "SELECT NumerodeControl FROM docentes WHERE NombredelDocente = '$nombreTutor'";
    $resultadoDocente = $mysqli->query($consultaDocente);

    if ($resultadoDocente && $resultadoDocente->num_rows > 0) {
        $filaDocente = $resultadoDocente->fetch_assoc();
        $numeroControlDocente = $filaDocente['NumerodeControl'];

        // Consultar si el número de control del docente existe en la tabla_tutorados
        $consultaTutorados = "SELECT Grupo FROM tabla_tutorados WHERE Tutor = '$numeroControlDocente'";
        $resultadoTutorados = $mysqli->query($consultaTutorados);

        if ($resultadoTutorados && $resultadoTutorados->num_rows > 0) {
            $filaTutorados = $resultadoTutorados->fetch_assoc();
            $numeroControlGrupo = $filaTutorados['Grupo'];

            // Consultar información de alumnosnormales y grupos
            $consultaAlumnos = "SELECT NombreDelEstudiante, Academia, NumeroDeControl FROM alumnosnormales WHERE Numerocontrolgrupo = '$numeroControlGrupo'";
            $resultadoAlumnos = $mysqli->query($consultaAlumnos);

            //echo '<script>';
            //echo 'var resultadoAlumnos = ' . json_encode($resultadoAlumnos) . ';';
            //echo '</script>';

            $consultaGrupos = "SELECT Semestre FROM grupos WHERE NumerodeControl = '$numeroControlGrupo'";
            $resultadoGrupos = $mysqli->query($consultaGrupos);

            if ($resultadoAlumnos && $resultadoGrupos) {
                // Obtener el semestre
                $filaGrupos = $resultadoGrupos->fetch_assoc();
                $semestre = $filaGrupos['Semestre'];

            } else {
                echo "Error al obtener información de alumnos o grupos: " . $mysqli->error;
            }
        } else {
            echo "No se le ha asignado a ningún grupo.";
        }
    } else {
        echo "Error al obtener el número de control del docente: " . $mysqli->error;
    }

    // Cerrar la conexión
    $mysqli->close();

    ?>


    <form id="form"> <!-- Inicio del formulario -->
        <h3>Formato de Canalización</h3><hr><br>
        <label for="nombreCompleto">Nombre Completo del Estudiante:</label>
        <!--<input type="text" id="nombre" name="nombre" required><br>-->
        <select name="nombre" id="nombre" onchange="guardarValorSeleccionado()" required>
            <option value="0">Seleccione</option>
            <?php
            // Inicializar un arreglo para almacenar los resultados
            $alumnosArray = array();

            while ($filaAlumnos = $resultadoAlumnos->fetch_assoc()) {
                echo '<option value="' . $filaAlumnos['NombreDelEstudiante'] . '">' . $filaAlumnos['NombreDelEstudiante'] . '</option>';
                $alumnosArray[] = $filaAlumnos;
            }                        

            // Convertir el arreglo a formato JSON para su uso en JavaScript
            $jsonAlumnos = json_encode($alumnosArray);
            ?>
        </select>
        <!-- Agregar un campo oculto para almacenar el valor seleccionado -->
        <input type="hidden" name="valor_seleccionado" id="valorSeleccionado" value="">

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br>

        <label for="numeroControl">Número de Control:</label>
        <input type='text' id='numeroControl' name='numeroControl' placeholder='Selecciona un nombre del estudiante' value='' readonly><br>

        <script>
            function guardarValorSeleccionado() {
                // Obtener el elemento select y el valor seleccionado
                var selectElement = document.getElementById("nombre");
                var selectedValue = selectElement.options[selectElement.selectedIndex].value;

                // Convertir el JSON de PHP a un objeto de JavaScript
                var alumnosArray = <?php echo $jsonAlumnos; ?>;

                // Buscar el objeto que coincide con el valor seleccionado
                var selectedAlumno = alumnosArray.find(function(alumno) {
                    return alumno.NombreDelEstudiante === selectedValue;
                });

                // Acceder a la propiedad deseada y asignarla al campo oculto
                document.getElementById("numeroControl").value = selectedAlumno.NumeroDeControl;
            }
        </script>

        <label for="semestre">Semestre:</label>
        <input type="text" id="semestre" name="semestre" required><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br>

        <label for="nombreTutor">Nombre del Tutor(a):</label>
        <input type="text" id="nombreTutor" name="nombreTutor" required><br>

        <label for="estudio" class="form-label">Plan de estudio</label>
        <select class="form-select" id="estudio" required>
            <option value="0">Seleccione</option> 
            <option value="Ingeniería Industrial">Ingeniería Industrial</option>
            <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
            <option value="Ingeniería en Electromecánica">Ingeniería en Electromecánica</option>
            <option value="Ingeniería en Gestión Empresarial">Ingeniería en Gestión Empresarial</option>
            <option value="Contador Público">Contador Público</option>
            <option value="Ingeniería en Administración">Ingeniería en Administración</option>
        </select>

        <label for="problematica">Problemática Identificada:</label>
        <textarea id="problematica" name="problematica" rows="4" required></textarea><br>

        <label for="servicioSolicitado">Servicio Solicitado:</label>
        <input type="text" id="servicioSolicitado" name="servicioSolicitado" required><br>

        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" rows="4" required></textarea><br>

        <label for="imagen1">Firma del coordindor(a) de tutorías:</label>
        <input type="file" id="imagen1" name="imagen1" accept="image/*" required><br>

        <label for="imagen1">Firma del tutor(a):</label>
        <input type="file" id="imagen2" name="imagen2" accept="image/*" required><br>

        <label for="imagen1">Firma y cargo de quien recibe la canalización:</label>
        <input type="file" id="imagen3" name="imagen3" accept="image/*" required><br>

        <br><br>
        <button type="submit" class="boton">Generar PDF</button>
        <br><br><br>

    </form> <!-- Cierre del formulario -->

</body>
</html> 