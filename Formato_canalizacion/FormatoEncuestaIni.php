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
    <title>Formulario de Datos del Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="jspdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="appFormatoEncuesta.js"></script>

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/comunicacionDocenteAlumno.css">

</head>
<body>
    
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
            $consultaAlumnos = "SELECT NombreDelEstudiante, Academia FROM alumnosnormales WHERE Numerocontrolgrupo = '$numeroControlGrupo'";
            $resultadoAlumnos = $mysqli->query($consultaAlumnos);

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
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3>Diagnostico original</h3>
                <hr>
                <form id="form"> <!-- Inicio del formulario -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <select class="form-select" name="nombre" id="nombre" required>
                                <?php
                                while ($filaAlumnos = $resultadoAlumnos->fetch_assoc()) {
                                    echo '<option value="' . $filaAlumnos['NombreDelEstudiante'] . '">' . $filaAlumnos['NombreDelEstudiante'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="plan" class="form-label">Plan de estudio:</label>
                            <?php
                            // Resetear el puntero del resultado
                            mysqli_data_seek($resultadoAlumnos, 0);

                            // Obtener la Academia del primer estudiante (puedes ajustar esto según tus necesidades)
                            $filaAlumnos = $resultadoAlumnos->fetch_assoc();
                            $academia = $filaAlumnos['Academia'];
                            echo '<input type="text" name="plan" id="plan" class="form-control" value="' . $academia . '" required>';
                            ?>
                        </div>

                        <div class="col-md-6">
                            <label for="semestre" class="form_label">Semestre:</label>
                            <input type="text" name="semestre" id="semestre" class="form-control" value="<?php echo $semestre; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form_label">Fecha de Nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" >
                        </div>
    
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="genero" class="form_label">Género:</label>
                            <div class="radio-group">
                                <input type="radio" name="genero" value="M" id="genero-m" class="form-check-input"  value="1" >
                                <label for="genero-m" class="form-check-label">M</label>
                                <input type="radio" name="genero" value="F" id="genero-f" class="form-check-input"  value="0" >
                                <label for="genero-f" class="form-check-label">F</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <label for="lugar_nacimiento" class="form_label">Lugar de Nacimiento:</label>
                            <input type="text" name="lugar_nacimiento" id="lugar_nacimiento" class="form-control" >
                        </div>
                    </div>
    

    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="domicilio" class="form_label">Domicilio:</label>
                            <input type="text" name="domicilio" id="domicilio" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="colonia" class="form_label">Colonia:</label>
                            <input type="text" name="colonia" id="colonia" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="municipio" class="form_label">Municipio:</label>
                            <input type="text" name="municipio" id="municipio" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="estado" class="form_label">Estado:</label>
                            <input type="text" name="estado" id="estado" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="cp" class="form_label">C P:</label>
                            <input type="text" name="cp" id="cp" class="form-control" >
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tel_particular" class="form_label">TEL. PARTICULAR:</label>
                            <input type="tel" name="tel_particular" id="tel_particular" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="tel_celular" class="form_label">TEL. CELULAR:</label>
                            <input type="tel" name="tel_celular" id="tel_celular" class="form-control" >
                        </div>
                    </div>
    
                    <div class="input_container">
                        <label for="tel_otro" class="form_label">OTRO:</label>
                        <input type="tel" name="tel_otro" id="tel_otro" class="form-control" >
                    </div>
    
                    <div class="input_container">
                        <label for="emergencia" class="form_label">EN CASO DE EMERGENCIA LLAMAR A:</label>
                        <input type="text" name="emergencia" id="emergencia" class="form-control" >
                    </div>
    
                    <div class="input_container">
                        <label for="tel_emergencia" class="form_label">TELÉFONO:</label>
                        <input type="tel" name="tel_emergencia" id="tel_emergencia" class="form-control" >
                    </div>
    
                    <div class="input_container">
                        <label for="correo" class="form_label">CORREO ELECTRÓNICO:</label>
                        <input type="email" name="correo" id="correo" class="form-control" >
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="escuela_primaria" class="form_label">LA PRIMARIA LA CURSASTE EN ESCUELA:</label>
                            <div class="radio-group">
                                <input type="radio" name="escuela_primaria" value="publica" id="publica_primaria" class="form-check-input" required >
                                <label for="publica_primaria" class="form-check-label">PÚBLICA</label>
                                <input type="radio" name="escuela_primaria" value="particular" id="particular_primaria" class="form-check-input" required>
                                <label for="particular_primaria" class="form-check-label">PARTICULAR</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="promedio_primaria" class="form-control" placeholder="PROMEDIO">
                        </div>       
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="escuela_secundaria" class="form_label">LA SECUNDARIA LA CURSASTE EN ESCUELA:</label>
                            <div class="radio-group">
                                <input type="radio" name="escuela_secundaria" value="publica" id="publica_secundaria" class="form-check-input" required >
                                <label for="publica_secundaria" class="form-check-label">PÚBLICA</label>
                                <input type="radio" name="escuela_secundaria" value="particular" id="particular_secundaria" class="form-check-input" required>
                                <label for="particular_secundaria" class="form-check-label">PARTICULAR</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="promedio_secundaria" class="form-control" placeholder="PROMEDIO">
                        </div>       
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="bachillerato" class="form_label">EL BACHILLERATO LO CURSASTE EN ESCUELA:</label>
                            <div class="radio-group">
                                <input type="radio" name="bachillerato" value="publica" id="publica_bachillerato" class="form-check-input" required >
                                <label for="publica_bachillerato" class="form-check-label">PÚBLICA</label>
                                <input type="radio" name="bachillerato" value="particular" id="particular_bachillerato" class="form-check-input" required>
                                <label for="particular_bachillerato" class="form-check-label">PARTICULAR</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="promedio_bachillerato" class="form-control" placeholder="PROMEDIO">
                            <input type="text" id="nombre_bachillerato" class="form-control" placeholder="NOMBRE DEL BACHILLERATO">
                        </div>       
                    </div>

                    <div class="input_container">
                        <label for="motivos" class="form_label">MOTIVOS POR LOS CUALES DECIDISTE INGRESAR A ESTA INSTITUCIÓN:</label>
                        <div class="radio-group">
                            <input type="radio" id="amigo" name="motivos" value="amigo" class="form-check-input" >
                            <label for="amigo">AMIGO(A)</label>
                            <input type="radio" id="padres" name="motivos" value="padres" class="form-check-input" >
                            <label for="padres">PADRES</label>
                            <input type="radio" id="plan_estudio" name="motivos" value="plan_estudio" class="form-check-input" >
                            <label for="plan_estudio">PLAN DE ESTUDIO</label>
                            <input type="radio" id="conviccion" name="motivos" value="conviccion" class="form-check-input" >
                            <label for="conviccion">CONVICCIÓN</label>
                            <input type="radio" id="otros_motivos" name="motivos" value="otros_motivos" class="form-check-input" >
                            <label for="otros_motivos">OTROS:era el mas cercano</label>
                        </div>
                    </div>
                    
                    <div class="input_container">
                        <label for="consideracion" class="form_label">¿CÓMO TE CONSIDERAS COMO ESTUDIANTE?</label>
                        <div class="radio-group">
                            <input type="radio" name="consideracion" value="excelente" id="excelente" class="form-check-input" required>
                            <label for="excelente">EXCELENTE</label>
                            <input type="radio" name="consideracion" value="bueno" id="bueno" class="form-check-input" required>
                            <label for="bueno">BUENO</label>
                            <input type="radio" name="consideracion" value="regular" id="regular" class="form-check-input" required>
                            <label for="regular">REGULAR</label>
                            <input type="radio" name="consideracion" value="deficiente" id="deficiente" class="form-check-input" required>
                            <label for="deficiente">DEFICIENTE</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">¿HAZ REPETIDO O REPROBADO ALGÚN AÑO ESCOLAR? ¿CUÁL O CUÁLES? (MÁRCALOS)</label>
                        <div class="checkbox-group">
                            <p>PRIMARIA:</p>
                            <input type="checkbox" name="repeticion_primaria[]" value="1" id="repeticion_primaria_1" class="form-check-input" >
                            <label for="repeticion_primaria_1">1</label>
                            <input type="checkbox" name="repeticion_primaria[]" value="2" id="repeticion_primaria_2" class="form-check-input" >
                            <label for="repeticion_primaria_2">2</label>
                            <input type="checkbox" name="repeticion_primaria[]" value="3" id="repeticion_primaria_3" class="form-check-input" >
                            <label for="repeticion_primaria_3">3</label>
                            <input type="checkbox" name="repeticion_primaria[]" value="4" id="repeticion_primaria_4" class="form-check-input" >
                            <label for="repeticion_primaria_4">4</label>
                            <input type="checkbox" name="repeticion_primaria[]" value="5" id="repeticion_primaria_5" class="form-check-input" >
                            <label for="repeticion_primaria_5">5</label>
                            <input type="checkbox" name="repeticion_primaria[]" value="6" id="repeticion_primaria_6" class="form-check-input" >
                            <label for="repeticion_primaria_6">6</label>
                    
                    
                            <p>SECUNDARIA:</p>
                            <input type="checkbox" name="repeticion_secundaria[]" value="7" id="repeticion_secundaria_1" class="form-check-input" >
                            <label for="repeticion_secundaria_1">1</label>
                            <input type="checkbox" name="repeticion_secundaria[]" value="8" id="repeticion_secundaria_2" class="form-check-input" >
                            <label for="repeticion_secundaria_2">2</label>
                            <input type="checkbox" name="repeticion_secundaria[]" value="9" id="repeticion_secundaria_3" class="form-check-input" >
                            <label for="repeticion_secundaria_3">3</label>
                    
                            <p>PREPARATORIA:</p>
                            <input type="checkbox" name="repeticion_preparatoria[]" value="10" id="repeticion_preparatoria_1" class="form-check-input" >
                            <label for="repeticion_preparatoria_1">1</label>
                            <input type="checkbox" name="repeticion_preparatoria[]" value="11" id="repeticion_preparatoria_2" class="form-check-input" >
                            <label for="repeticion_preparatoria_2">2</label>
                            <input type="checkbox" name="repeticion_preparatoria[]" value="12" id="repeticion_preparatoria_3" class="form-check-input" >
                            <label for="repeticion_preparatoria_3">3</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label for="enfermedad" class="form_label">PADECES DE ALGUNA ENFERMEDAD O CAPACIDAD DIFERENTE:</label>
                        <div class="radio-group">
                            <input type="radio" name="enfermedad" value="SI" id="enfermedad-si" class="form-check-input" required>
                            <label for="enfermedad-si">SI</label>
                            <input type="radio" name="enfermedad" value="NO" id="enfermedad-no" class="form-check-input" required>
                            <label for="enfermedad-no">NO</label>
                        </div>
                        <input type="text" id="nombre_enfermedad" class="form-control" placeholder="CUAL">
                        <input type="text" id="medicamentos" class="form-control" placeholder="QUE MEDICAMENTOS TOMAS">
                        <input type="text" id="frecuencia_medicamentos" class="form-control" placeholder="CON QUE FRECUENCIA">
                    </div>

                    <div class="input_container">
                        <label for="tiempo_traslado" class="form_label">CUÁNTO TIEMPO EMPLEAS PARA TRASLADARTE DE TU DOMICILIO AL PLANTEL?</label>
                        <input type="text" id="tiempo_traslado" class="form-control">
                    </div>

                    <div class="input_container">
                        <label for="alimento" class="form_label">CUANDO LLEGAS A LA ESCUELA ¿YA CONSUMISTE ALIMENTO?</label>
                        <div class="radio-group">
                            <input type="radio" name="alimento" value="SIEMPRE" id="alimento-siempre" class="form-check-input" required>
                            <label for="alimento-siempre">SIEMPRE</label>
                            <input type="radio" name="alimento" value="CASISIEMPRE" id="alimento-casisiempre" class="form-check-input" required>
                            <label for="alimento-casisiempre">CASI SIEMPRE</label>
                            <input type="radio" name="alimento" value="NUNCA" id="alimento-nunca" class="form-check-input" required>
                            <label for="alimento-nunca">NUNCA</label>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="form_label">CUANTAS VECES A LA SEMANA CONSUMES LOS SIGUIENTES ALIMENTOS:</label>
                        <div class="col-md-6">
                            <label for="consumo_carne">CARNE:</label>
                            <input type="text" id="consumo_carne" class="form-control">
                        </div>   
                        <div class="col-md-6">
                            <label for="consumo_pollo">POLLO:</label>
                            <input type="text" id="consumo_pollo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="consumo_huevo">HUEVOS:</label>
                            <input type="text" id="consumo_huevo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="consumo_leche">LECHE:</label>
                            <input type="text" id="consumo_leche" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="consumo_verduras">VERDURAS:</label>
                            <input type="text" id="consumo_verduras" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="consumo_pan">PAN:</label>
                            <input type="text" id="consumo_pan" class="form-control">
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">ESTADO CIVIL:</label>
                        <div class="radio-group">
                            <input type="radio" name="estado_civil" value="Casado(a)" id="estado_civil_casado" class="form-check-input" required>
                            <label for="estado_civil_casado">Casado(a)</label>
                            <input type="radio" name="estado_civil" value="Unión libre" id="estado_civil_union_libre" class="form-check-input" required>
                            <label for="estado_civil_union_libre">Unión libre</label>
                            <input type="radio" name="estado_civil" value="Divorciado(a)" id="estado_civil_divorciado" class="form-check-input" required>
                            <label for="estado_civil_divorciado">Divorciado(a)</label>
                            <input type="radio" name="estado_civil" value="Viudo(a)" id="estado_civil_viudo" class="form-check-input" required>
                            <label for="estado_civil_viudo">Viudo(a)</label>
                            <input type="radio" name="estado_civil" value="Soltero(a)" id="estado_civil_soltero" class="form-check-input" required>
                            <label for="estado_civil_soltero">Soltero(a)</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">NUMERO DE HIJOS(AS):</label>
                        <div class="radio-group">
                            <input type="radio" name="numero_hijos" value="Sin hijos(as)" id="numero_hijos_sin" class="form-check-input" >
                            <label for="numero_hijos_sin">Sin hijos(as)</label>
                            <input type="radio" name="numero_hijos" value="1 a 2" id="numero_hijos_1_2" class="form-check-input" >
                            <label for="numero_hijos_1_2">1 a 2</label>
                            <input type="radio" name="numero_hijos" value="3 a 4" id="numero_hijos_3_4" class="form-check-input" >
                            <label for="numero_hijos_3_4">3 a 4</label>
                            <input type="radio" name="numero_hijos" value="Mas de 4" id="numero_hijos_mas_4" class="form-check-input" >
                            <label for="numero_hijos_mas_4">Mas de 4</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">TRABAJA TU CONYUGUÉ:</label>
                        <div class="radio-group">
                            <input type="radio" name="trabaja_conyuge" value="No" id="trabaja_conyuge_no" class="form-check-input" >
                            <label for="trabaja_conyuge_no">No</label>
                            <input type="radio" name="trabaja_conyuge" value="Si" id="trabaja_conyuge_si" class="form-check-input" >
                            <label for="trabaja_conyuge_si">Si</label>
                        </div>
                        <input type="text" id="lugar_trabajo_conyuge" class="form-control" placeholder="Lugar">
                        <input type="text" id="puesto_conyuge" class="form-control" placeholder="Puesto">
                        <input type="text" id="telefono_conyuge" class="form-control" placeholder="Teléfono">
                    </div>

                    <div class="input_container">
                        <label class="form_label">VIVES CON:</label>
                        <div class="radio-group">
                            <input type="radio" name="vives_con" value="Ambos padres" id="vives_con_ambos_padres" class="form-check-input" required>
                            <label for="vives_con_ambos_padres">Ambos padres</label>
                            <input type="radio" name="vives_con" value="Con tu cónyuge" id="vives_con_con_conyuge" class="form-check-input" required>
                            <label for="vives_con_con_conyuge">Con tu cónyuge</label>
                            <input type="radio" name="vives_con" value="Padre o Madre" id="vives_con_padre_madre" class="form-check-input" required>
                            <label for="vives_con_padre_madre">Padre o Madre</label>
                            <input type="radio" name="vives_con" value="Familiares cercanos" id="vives_con_familiares_cercanos" class="form-check-input" required>
                            <label for="vives_con_familiares_cercanos">Familiares cercanos</label>
                            <input type="radio" name="vives_con" value="Con amigos(as)" id="vives_con_amigos" class="form-check-input" required>
                            <label for="vives_con_amigos">Con amigos(as)</label>
                            <input type="radio" name="vives_con" value="Solo(a)" id="vives_con_solo" class="form-check-input" required>
                            <label for="vives_con_solo">Solo(a)</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">En El Transcurso De Tus Estudios Vivirás:</label>
                        <div class="radio-group">
                            <input type="radio" name="vivviras_con" value="Con mi familia" id="vivviras_con_Con mi familia" class="form-check-input" required>
                            <label for="vivviras_con_ambos_padres">Con mi familia</label>
                            <input type="radio" name="vivviras_con" value="Con familiares cercanos" id="vivviras_con_Con familiares cercanos" class="form-check-input" required>
                            <label for="vivviras_con_con_conyuge">Con familiares cercanos</label>
                            <input type="radio" name="vivviras_con" value="Con otros estudiantes" id="vivviras_Con otros estudiantes" class="form-check-input" required>
                            <label for="vivviras_con_padre_madre">Con otros estudiantes</label>
                            <input type="radio" name="vivviras_con" value="Solo(a)" id="vivviras_con_solo" class="form-check-input" required>
                            <label for="vivviras_con_solo">Solo(a)</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">TRABAJAS:</label>
                        <div class="radio-group">
                            <input type="radio" name="trabajas" value="No" id="trabajas_no" class="form-check-input" required>
                            <label for="trabajas_no">No</label>
                            <input type="radio" name="trabajas" value="Si" id="trabajas_si" class="form-check-input" required>
                            <label for="trabajas_si">Si</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">Lugar de trabajo:</label>
                        <input type="text" name="lugar_trabajo" id="lugar_trabajo" class="form-control">
                    </div>
                    <div class="input_container">
                        <label class="form_label">Puesto:</label>
                        <input type="text" name="puesto" id="puesto" class="form-control">
                    </div>
                    <div class="input_container">
                        <label class="form_label">Teléfono:</label>
                        <input type="tel" name="telefono_trabajo" id="telefono_trabajo"class="form-control">
                    </div>


                    <div class="input_container">
                        <label class="form_label">INGRESO FAMILIAR PROMEDIO AL MES:</label>
                        <div class="radio-group">
                            <input type="radio" name="ingreso_familiar" value="Mas de $6000" id="ingreso_familiar_mas_6000" class="form-check-input" required>
                            <label for="ingreso_familiar_mas_6000">Mas de $6000</label>
                            <input type="radio" name="ingreso_familiar" value="Entre $4001 y $5000" id="ingreso_familiar_4001_5000" class="form-check-input" required>
                            <label for="ingreso_familiar_4001_5000">Entre $4001 y $5000</label>
                            <input type="radio" name="ingreso_familiar" value="Entre $3001 y $4000" id="ingreso_familiar_3001_4000" class="form-check-input" required>
                            <label for="ingreso_familiar_3001_4000">Entre $3001 y $4000</label>
                            <input type="radio" name="ingreso_familiar" value="Entre $2001 y $3000" id="ingreso_familiar_2001_3000" class="form-check-input" required>
                            <label for="ingreso_familiar_2001_3000">Entre $2001 y $3000</label>
                            <input type="radio" name="ingreso_familiar" value="Menos de $2000" id="ingreso_familiar_menos_2000" class="form-check-input" required>
                            <label for="ingreso_familiar_menos_2000">Menos de $2000</label>
                            <input type="radio" name="ingreso_familiar" value="Nada" id="ingreso_familiar_nada" class="form-check-input" required>
                            <label for="ingreso_familiar_nada">Nada</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">NÚMERO DE PERSONAS QUE DEPENDEN DEL INGRESO FAMILIAR:</label>
                        <div class="radio-group">
                            <input type="radio" name="personas_dependen" value="1 ó 2" id="personas_dependen_1_2"class="form-check-input" required>
                            <label for="personas_dependen_1_2">1 ó 2</label>
                            <input type="radio" name="personas_dependen" value="3 ó 4" id="personas_dependen_3_4"class="form-check-input" required>
                            <label for="personas_dependen_3_4">3 ó 4</label>
                            <input type="radio" name="personas_dependen" value="5 ó 6" id="personas_dependen_5_6"class="form-check-input" required>
                            <label for="personas_dependen_5_6">5 ó 6</label>
                            <input type="radio" name="personas_dependen" value="7 ó más" id="personas_dependen_7_mas"class="form-check-input" required>
                            <label for="personas_dependen_7_mas">7 ó más</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">EN QUE MOMENTO CONVIVE TODA LA FAMILIA:</label>
                        <div class="radio-group">
                            <input type="radio" name="convive_familia" value="En la comida" id="convive_familia_comida" class="form-check-input" required>
                            <label for="convive_familia_comida">En la comida</label>
                            <input type="radio" name="convive_familia" value="En la cena" id="convive_familia_cena" class="form-check-input" required>
                            <label for="convive_familia_cena">En la cena</label>
                            <input type="radio" name="convive_familia" value="Viendo TV" id="convive_familia_tv" class="form-check-input" required>
                            <label for="convive_familia_tv">Viendo TV</label>
                            <input type="radio" name="convive_familia" value="Otros" id="convive_familia_otros" class="form-check-input" required>
                            <label for="convive_familia_otros">Otros</label>
                        </div>
                    </div>
                        
                    <div class="input_container">
                        <label class="form_label">A QUE LUGARES ACUDES CON TU FAMILIA PARA EL ESPARCIMIENTO:</label>
                        <div class="radio-group">
                            <input type="radio" name="esparcimiento_lugares" value="Cine" id="esparcimiento_lugares_cine" class="form-check-input" required>
                            <label for="esparcimiento_lugares_cine">Cine</label>
                            <input type="radio" name="esparcimiento_lugares" value="Parque" id="esparcimiento_lugares_parque" class="form-check-input" required>
                            <label for="esparcimiento_lugares_parque">Parque</label>
                            <input type="radio" name="esparcimiento_lugares" value="Con otros familiares" id="esparcimiento_lugares_familiares" class="form-check-input" required>
                            <label for="esparcimiento_lugares_familiares">Con otros familiares</label>
                            <input type="radio" name="esparcimiento_lugares" value="Otros" id="esparcimiento_lugares_otros" class="form-check-input" required>
                            <label for="esparcimiento_lugares_otros">Otros</label>
                        </div>
                    </div>
                        
                    <div class="input_container">
                        <label class="form_label">COMO ES LA COMUNICACIÓN CON TU FAMILIA:</label>
                        <div class="radio-group">
                            <input type="radio" name="comunicacion_familia" value="Buena" id="comunicacion_familia_buena" class="form-check-input" required>
                            <label for="comunicacion_familia_buena">Buena</label>
                            <input type="radio" name="comunicacion_familia" value="Regular" id="comunicacion_familia_regular" class="form-check-input" required>
                            <label for="comunicacion_familia_regular">Regular</label>
                            <input type="radio" name="comunicacion_familia" value="Mala" id="comunicacion_familia_mala" class="form-check-input" required>
                            <label for="comunicacion_familia_mala">Mala</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">CON QUE MIEMBRO DE TU FAMILIA EXISTE MAYOR CONFIANZA:</label>
                        <input type="text" name="mayor_confianza_parentesco" id="mayor_confianza_parentesco" class="form-control" placeholder="Parentesco">
                        <input type="text" name="mayor_confianza_nombre" id="mayor_confianza_nombre" class="form-control" placeholder="Nombre">
                    </div>
                    
                    <div class="input_container">
                        <label class="form_label">LA CASA EN LA QUE VIVES ES:</label>
                        <div class="radio-group">
                            <input type="radio" name="tipo_casa" value="Propia" id="tipo_casa_propia" class="form-check-input" required>
                            <label for="tipo_casa_propia">Propia</label>
                            <input type="radio" name="tipo_casa" value="Prestada" id="tipo_casa_prestada" class="form-check-input" required>
                            <label for="tipo_casa_prestada">Prestada</label>
                            <input type="radio" name="tipo_casa" value="Rentada" id="tipo_casa_rentada" class="form-check-input" required>
                            <label for="tipo_casa_rentada">Rentada</label>
                            <input type="radio" name="tipo_casa" value="Hipotecada" id="tipo_casa_hipotecada" class="form-check-input" required>
                            <label for="tipo_casa_hipotecada">Hipotecada</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label class="form_label">LOS MATERIALES DE LA CASA EN DONDE VIVES:</label>
                        <div class="radio-group">
                            <input type="radio" name="materiales_casa" value="Concreto totalmente" id="materiales_casa_concreto" class="form-check-input" required>
                            <label for="materiales_casa_concreto">Concreto totalmente</label>
                            <input type="radio" name="materiales_casa" value="Concreto y otros materiales" id="materiales_casa_concreto_otros" class="form-check-input" required>
                            <label for="materiales_casa_concreto_otros">Concreto y otros materiales</label>
                            <input type="radio" name="materiales_casa" value="Obra negra" id="materiales_casa_obra_negra" class="form-check-input" required>
                            <label for="materiales_casa_obra_negra">Obra negra</label>
                            <input type="radio" name="materiales_casa" value="Cartón o lámina" id="materiales_casa_carton" class="form-check-input" required>
                            <label for="materiales_casa_carton">Cartón o lámina</label>
                        </div>
                    </div>
                        
                    <div class="input_container">
                        <label class="form_label">HABITACIONES DE LA CASA:</label>
                        <div class="radio-group">
                            <input type="radio" name="habitaciones_casa" value="Mas de 6" id="habitaciones_casa_mas_6" class="form-check-input" required>
                            <label for="habitaciones_casa_mas_6">Mas de 6</label>
                            <input type="radio" name="habitaciones_casa" value="Entre 4 y 5" id="habitaciones_casa_4_5" class="form-check-input" required>
                            <label for="habitaciones_casa_4_5">Entre 4 y 5</label>
                            <input type="radio" name="habitaciones_casa" value="Entre 2 y 3" id="habitaciones_casa_2_3" class="form-check-input" required>
                            <label for="habitaciones_casa_2_3">Entre 2 y 3</label>
                            <input type="radio" name="habitaciones_casa" value="Solo 1" id="habitaciones_casa_1" class="form-check-input" required>
                            <label for="habitaciones_casa_1">Solo 1</label>
                        </div>
                    </div>
                        
                    <div class="input_container">
                        <label class="form_label">TUS PADRES ESTÁN:</label>
                        <div class="radio-group">
                            <input type="radio" name="estado_padres" value="Casados" id="estado_padres_casados" class="form-check-input" required>
                            <label for="estado_padres_casados">Casados</label>
                            <input type="radio" name="estado_padres" value="Unión libre" id="estado_padres_union_libre" class="form-check-input" required>
                            <label for="estado_padres_union_libre">Unión libre</label>
                            <input type="radio" name="estado_padres" value="Separados" id="estado_padres_separados" class="form-check-input" required>
                            <label for="estado_padres_separados">Separados</label>
                            <input type="radio" name="estado_padres" value="Padre viudo" id="estado_padres_padre_viudo" class="form-check-input" required>
                            <label for="estado_padres_padre_viudo">Padre viudo</label>
                            <input type="radio" name="estado_padres" value="Madre viuda" id="estado_padres_madre_viuda" class="form-check-input" required>
                            <label for="estado_padres_madre_viuda">Madre viuda</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label for="apellido_paterno_padre" class="form_label">Apellido Paterno (Padre):</label>
                        <input type="text" name="apellido_paterno_padre" id="apellido_paterno_padre" class="form-control" required>
                    </div>
                    
                    <div class="input_container">
                        <label for="apellido_materno_padre" class="form_label">Apellido Materno (Padre):</label>
                        <input type="text" name="apellido_materno_padre" id="apellido_materno_padre" class="form-control" required>
                    </div>
                    
                    <div class="input_container">
                        <label for="nombres_padre" class="form_label">Nombre(s) (Padre):</label>
                        <input type="text" name="nombres_padre" id="nombres_padre" class="form-control" required>
                    </div>
                    

                    <div class="input_container">
                        <label for="calle_padre" class="form_label">Calle (Padre):</label>
                        <input type="text" name="calle_padre" id="calle_padre" class="form-control" required>
                    </div>

                    <div class="input_container">
                        <label for="numero_padre" class="form_label">Número (Padre):</label>
                        <input type="text" name="numero_padre" id="numero_padre" class="form-control" required>
                    </div>

                    <div class="input_container">
                        <label for="colonia_padre" class="form_label">Colonia (Padre):</label>
                        <input type="text" name="colonia_padre" id="colonia_padre" class="form-control" required>
                    </div>

                    <div class="input_container">
                        <label for="ciudad_padre" class="form_label">Ciudad (Padre):</label>
                        <input type="text" name="ciudad_padre" id="ciudad_padre" class="form-control" required>
                    </div>

                    <div class="input_container">
                        <label for="estado_padre" class="form_label">Estado (Padre):</label>
                        <input type="text" name="estado_padre" id="estado_padre" class="form-control" required>
                    </div>
                    
                    <div class="input_container">
                        <label for="telefono_padre" class="form_label">TELÉFONO (PADRE):</label>
                        <input type="tel" name="telefono_padre" id="telefono_padre" class="form-control" required>
                    </div>
                        
                    <div class="row mb-3">
                        <label for="nacimiento_padre" class="form_label">LUGAR Y FECHA DE NACIMIENTO DEL PADRE:</label>
                        <div class="col-md-4">
                            <input type="text" name="ciudad_nacimiento_padre" id="ciudad_nacimiento_padre" class="form-control" required placeholder="Ciudad">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="estado_nacimiento_padre" id="estado_nacimiento_padre" class="form-control" required placeholder="Estado:">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="fecha_nacimiento_padre" id="fecha_nacimiento_padre" class="form-control" required>
                        </div>
                    </div>

                    <div class="input_container">
                        <label for="grado_estudios_padre" class="form_label">ÚLTIMO GRADO DE ESTUDIOS DEL PADRE:</label>
                        <div class="radio-group">
                            <input type="radio" name="grado_estudios_padre" value="Licenciatura" id="grado_estudios_padre_licenciatura" class="form-check-input" required>
                            <label for="grado_estudios_padre_licenciatura">Licenciatura</label>
                            <input type="radio" name="grado_estudios_padre" value="Bachillerato" id="grado_estudios_padre_bachillerato" class="form-check-input" required>
                            <label for="grado_estudios_padre_bachillerato">Bachillerato</label>
                            <input type="radio" name="grado_estudios_padre" value="Técnico ó comercio" id="grado_estudios_padre_tecnico" class="form-check-input" required>
                            <label for="grado_estudios_padre_tecnico">Técnico ó comercio</label>
                            <input type="radio" name="grado_estudios_padre" value="Secundaria" id="grado_estudios_padre_secundaria" class="form-check-input" required>
                            <label for="grado_estudios_padre_secundaria">Secundaria</label>
                            <input type="radio" name="grado_estudios_padre" value="Primaria" id="grado_estudios_padre_primaria" class="form-check-input" required>
                            <label for="grado_estudios_padre_primaria">Primaria</label>
                            <input type="radio" name="grado_estudios_padre" value="Sin estudios" id="grado_estudios_padre_sin_estudios" class="form-check-input" required>
                            <label for="grado_estudios_padre_sin_estudios">Sin estudios</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label for="trabajo_padre" class="form_label">TRABAJA EL PADRE:</label>
                        <div class="radio-group">
                            <input type="radio" name="trabajo_padre" value="No" id="trabajo_padre_no" class="form-check-input" required>
                            <label for="trabajo_padre_no">No</label>
                            <input type="radio" name="trabajo_padre" value="Sí" id="trabajo_padre_si" class="form-check-input" required>
                            <label for="trabajo_padre_si">Sí</label>
                        </div>
                    </div>
                        
                    <div class="input_container">
                        <label for="lugar_trabajo_padre" class="form_label">Lugar de trabajo del padre:</label>
                        <input type="text" name="lugar_trabajo_padre" id="lugar_trabajo_padre" class="form-control">
                    </div>
                    <div class="input_container">
                        <label for="puesto_trabajo_padre" class="form_label">Puesto:</label>
                        <input type="text" name="puesto_trabajo_padre" id="puesto_trabajo_padre" class="form-control">
                    </div>
                    <div class="input_container">
                        <label for="telefono_trabajo_padre" class="form_label">Teléfono de trabajo del padre:</label>
                        <input type="tel" name="telefono_trabajo_padre" id="telefono_trabajo_padre" class="form-control">
                    </div>


                    <div class="input_container">
                        <label class="form_label">Servicio Médico con el que Cuenta:</label>
                        <div class="radio-group">
                            <input type="radio" name="servicio_medico" value="Particular" id="particular" class="form-check-input" required>
                            <label for="particular">Particular</label>
                            <input type="radio" name="servicio_medico" value="ISSSTE" id="issste" class="form-check-input" required>
                            <label for="issste">ISSSTE</label>
                            <input type="radio" name="servicio_medico" value="IMSS" id="imss" class="form-check-input" required>
                            <label for="imss">IMSS</label>
                            <input type="radio" name="servicio_medico" value="Seguro Popular" id="seguro_popular" class="form-check-input" required>
                            <label for="seguro_popular">Seguro Popular</label>
                            <input type="radio" name="servicio_medico" value="Otro" id="otro" class="form-check-input" required>
                            <label for="otro">Otro</label>
                        </div>
                    </div>



                    <div class="input_container">
                        <label for="apellido_paterno_madre" class="form_label">Apellido Paterno (Madre):</label>
                        <input type="text" name="apellido_paterno_madre" id="apellido_paterno_madre" class="form-control" required>
                    </div>
            
                    <div class="input_container">
                        <label for="apellido_materno_madre" class="form_label">Apellido Materno (Madre):</label>
                        <input type="text" name="apellido_materno_madre" id="apellido_materno_madre" class="form-control" required>
                    </div>
            
                    <div class="input_container">
                        <label for ="nombres_madre" class="form_label">Nombre(s) (Madre):</label>
                        <input type="text" name="nombres_madre" id="nombres_madre" class="form-control" required>
                    </div>
            
                    <div class="input_container">
                        <label for="calle_madre" class="form_label">Calle (Madre):</label>
                        <input type="text" name="calle_madre" id="calle_madre" class="form-control" required>
                    </div>
            
                    <div class="input_container">
                        <label for="numero_madre" class="form_label">Número (Madre):</label>
                        <input type="text" name="numero_madre" id="numero_madre" class="form-control" required>
                    </div>
            
                    <div class="input_container">
                        <label for="colonia_madre" class="form_label">Colonia (Madre):</label>
                        <input type="text" name="colonia_madre" id="colonia_madre" class="form-control" required>
                    </div>
            
                    <div class="input_container">
                        <label for ="ciudad_madre" class="form_label">Ciudad (Madre):</label>
                        <input type="text" name="ciudad_madre" id="ciudad_madre" class="form-control" required>
                    </div>
            
                    <div class="input_container">
                        <label for="estado_madre" class="form_label">Estado (Madre):</label>
                        <input type="text" name="estado_madre" id="estado_madre" class="form-control" required>
                    </div>
            
                    <div class="input_container">
                        <label for="telefono_madre" class="form_label">TELÉFONO (Madre):</label>
                        <input type="tel" name="telefono_madre" id="telefono_madre" class="form-control" required>
                    </div>
            
                    <div class="row mb-3">
                        <label for="nacimiento_madre" class="form_label">LUGAR Y FECHA DE NACIMIENTO DE LA MADRE:</label>
                        <div class="col-md-4">
                            <input type="text" name="ciudad_nacimiento_madre" id="ciudad_nacimiento_madre" class="form-control" required placeholder="Ciudad">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="estado_nacimiento_madre" id="estado_nacimiento_madre" class="form-control" required placeholder="Estado">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="fecha_nacimiento_madre" id="fecha_nacimiento_madre" class="form-control" required>
                        </div>
                    </div>

                    <div class="input_container">
                        <label for="grado_estudios_madre" class="form_label">ÚLTIMO GRADO DE ESTUDIOS (Madre):</label>
                        <div class="radio-group">
                            <input type="radio" name="grado_estudios_madre" value="Licenciatura" id="grado_estudios_madre_licenciatura" class="form-check-input" required>
                            <label for="grado_estudios_madre_licenciatura">Licenciatura</label>
                            <input type="radio" name="grado_estudios_madre" value="Bachillerato" id="grado_estudios_madre_bachillerato" class="form-check-input" required>
                            <label for="grado_estudios_madre_bachillerato">Bachillerato</label>
                            <input type="radio" name="grado_estudios_madre" value="Técnico ó comercio" id="grado_estudios_madre_tecnico" class="form-check-input" required>
                            <label for="grado_estudios_madre_tecnico">Técnico ó comercio</label>
                            <input type="radio" name="grado_estudios_madre" value="Secundaria" id="grado_estudios_madre_secundaria" class="form-check-input" required>
                            <label for="grado_estudios_madre_secundaria">Secundaria</label>
                            <input type="radio" name="grado_estudios_madre" value="Primaria" id="grado_estudios_madre_primaria" class="form-check-input" required>
                            <label for="grado_estudios_madre_primaria">Primaria</label>
                            <input type="radio" name="grado_estudios_madre" value="Sin estudios" id="grado_estudios_madre_sin_estudios" class="form-check-input" required>
                            <label for="grado_estudios_madre_sin_estudios">Sin estudios</label>
                        </div>
                    </div>
            
                    <div class="input_container">
                        <label for="trabajo_madre" class="form_label">TRABAJA (Madre):</label>
                        <div class="radio-group">
                            <input type="radio" name="trabajo_madre" value="No" id="trabajo_madre_no" class="form-check-input" required>
                            <label for="trabajo_madre_no">No</label>
                            <input type="radio" name="trabajo_madre" value="Sí" id="trabajo_madre_si" class="form-check-input" required>
                            <label for="trabajo_madre_si">Sí</label>
                        </div>
                    </div>
                        
                    <div class="input_container">
                        <label for="lugar_trabajo_madre" class="form_label">Lugar de trabajo (Madre):</label>
                        <input type="text" name="lugar_trabajo_madre" id="lugar_trabajo_madre" class="form-control">
                    </div>
            
                    <div class="input_container">
                        <label for="puesto_trabajo_madre" class="form_label">Puesto (Madre):</label>
                        <input type="text" name="puesto_trabajo_madre" id="puesto_trabajo_madre" class="form-control">
                    </div>
            
                    <div class="input_container">
                        <label for="telefono_trabajo_madre" class="form_label">Teléfono de trabajo (Madre):</label>
                        <input type="tel" name="telefono_trabajo_madre" id="telefono_trabajo_madre" class="form-control">
                    </div>

                    <div class="input_container">
                        <label class="form_label">Servicio Médico con el que Cuenta:</label>
                        <div class="radio-group">
                            <input type="radio" name="servicio_medico_madre" value="Particular" id="particular" class="form-check-input" required>
                            <label for="particular">Particular</label>
                            <input type="radio" name="servicio_medico_madre" value="ISSSTE" id="issste" class="form-check-input" required>
                            <label for="issste">ISSSTE</label>
                            <input type="radio" name="servicio_medico_madre" value="IMSS" id="imss" class="form-check-input" required>
                            <label for="imss">IMSS</label>
                            <input type="radio" name="servicio_medico_madre" value="Seguro Popular" id="seguro_popular" class="form-check-input" required>
                            <label for="seguro_popular">Seguro Popular</label>
                            <input type="radio" name="servicio_medico_madre" value="Otro" id="otro" class="form-check-input" required>
                            <label for="otro">Otro</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label for="apoyo_economico" class="form_label">¿CUENTAS CON APOYO ECONÓMICO DE ALGUNA INSTITUCIÓN?</label>
                        <div class="radio-group">
                            <input type="radio" name="apoyo_economico" value="Crédito educativo" id="apoyo_economico_credito" class="form-check-input" required>
                            <label for="apoyo_economico_credito">Crédito educativo</label>
                            <input type="radio" name="apoyo_economico" value="Beca" id="apoyo_economico_beca" class="form-check-input" required>
                            <label for="apoyo_economico_beca">Beca</label>
                            <input type="radio" name="apoyo_economico" value="De una empresa" id="apoyo_economico_empresa" class="form-check-input" required>
                            <label for="apoyo_economico_empresa">De una empresa</label>
                            <input type="radio" name="apoyo_economico" value="Ninguno" id="apoyo_economico_ninguno" class="form-check-input" required>
                            <label for="apoyo_economico_ninguno">Ninguno</label>
                            <input type="radio" name="apoyo_economico" value="Otro" id="apoyo_economico_otro" class="form-check-input" required>
                            <label for="apoyo_economico_otro">Otro</label>
                        </div>
                    </div>
                    
                    <div class="input_container">
                        <label for="institucion_apoyo" class="form_label">Institución que te apoya:</label>
                        <input type="text" name="institucion_apoyo" id="institucion_apoyo" class="form-control">
                    </div>
                    
                    <div class="input_container">
                        <label for="monto_apoyo_mensual" class="form_label">Monto mensual:</label>
                        <input type="text" name="monto_apoyo_mensual" id="monto_apoyo_mensual" class="form-control">
                    </div>

                    <div class="input_container">
                        <label for="motivos_programa_estudio" class="form_label">MOTIVOS POR LOS CUALES ELEGISTE EL PROGRAMA DE ESTUDIO:</label>
                        <div class="checkbox-group">
                            <input type="checkbox" name="motivos_programa_estudio[]" value="Padres" id="motivos_programa_estudio_padres" class="form-check-input">
                            <label for="motivos_programa_estudio_padres">Padres</label>
                            <input type="checkbox" name="motivos_programa_estudio[]" value="Amigos(as)" id="motivos_programa_estudio_amigos" class="form-check-input">
                            <label for="motivos_programa_estudio_amigos">Amigos(as)</label>
                            <input type="checkbox" name="motivos_programa_estudio[]" value="Vocación" id="motivos_programa_estudio_vocacion" class="form-check-input">
                            <label for="motivos_programa_estudio_vocacion">Vocación</label>
                            <input type="checkbox" name="motivos_programa_estudio[]" value="Otros" id="motivos_programa_estudio_otros" class="form-check-input">
                            <label for="motivos_programa_estudio_otros">Otros</label>
                        </div>
                    </div>

                    <div class="input_container">
                        <label for="metas_cinco_anos" class="form_label">¿CUALES SON TUS METAS PARA LOS PRÓXIMOS CINCO AÑOS?</label>
                        <label for="metas_cinco_anos_trabajo">1) De Trabajo:</label>
                        <input type="text" name="metas_cinco_anos_trabajo" id="metas_cinco_anos_trabajo" class="form-control" required>
                        <label for="metas_cinco_anos_familiares">2) Familiares:</label>
                        <input type="text" name="metas_cinco_anos_familiares" id="metas_cinco_anos_familiares" class="form-control" required>
                        <label for="metas_cinco_anos_personales">3) Personales:</label>
                        <input type="text" name="metas_cinco_anos_personales" id="metas_cinco_anos_personales" class="form-control" required>
                        <label for="metas_cinco_anos_academicas">4) Académicas:</label>
                        <input type="text" name="metas_cinco_anos_academicas" id="metas_cinco_anos_academicas" class="form-control" required>
                    </div>
                    
                    <div class="input_container">
                        <label for="herramientas_para_lograr_metas" class="form_label">¿CUÁLES CREES QUE SON LAS HERRAMIENTAS CON QUE CUENTAS PARA LOGRARLAS?</label>
                        <label for="herramientas_para_lograr_metas_trabajo">1) En el trabajo:</label>
                        <input type="text" name="herramientas_para_lograr_metas_trabajo" id="herramientas_para_lograr_metas_trabajo" class="form-control" required>
                        <label for="herramientas_para_lograr_metas_familia">2) En la familia:</label>
                        <input type="text" name="herramientas_para_lograr_metas_familia" id="herramientas_para_lograr_metas_familia" class="form-control" required>
                        <label for="herramientas_para_lograr_metas_personales">3) Personales:</label>
                        <input type="text" name="herramientas_para_lograr_metas_personales" id="herramientas_para_lograr_metas_personales" class="form-control" required>
                        <label for="herramientas_para_lograr_metas_academicas">4) Académicas:</label>
                        <input type="text" name="herramientas_para_lograr_metas_academicas" id="herramientas_para_lograr_metas_academicas" class="form-control" required>
                    </div>
                    
                    <div class="input_container">
                        <label for="obstaculos_para_lograr_metas" class="form_label">¿CUÁLES SERÁN LOS OBSTÁCULOS QUE TE FRENARAN EL LOGRO DE ESAS METAS?</label>
                        <label for="obstaculos_para_lograr_metas_trabajo">1) En el trabajo:</label>
                        <input type="text" name="obstaculos_para_lograr_metas_trabajo" id="obstaculos_para_lograr_metas_trabajo" class="form-control" required>
                        <label for="obstaculos_para_lograr_metas_familia">2) En la familia:</label>
                        <input type="text" name="obstaculos_para_lograr_metas_familia" id="obstaculos_para_lograr_metas_familia" class="form-control" required>
                        <label for="obstaculos_para_lograr_metas_personales">3) Personales:</label>
                        <input type="text" name="obstaculos_para_lograr_metas_personales" id="obstaculos_para_lograr_metas_personales" class="form-control" required>
                        <label for="obstaculos_para_lograr_metas_academicas">4) Académicas:</label>
                        <input type="text" name="obstaculos_para_lograr_metas_academicas" id="obstaculos_para_lograr_metas_academicas" class="form-control" required>
                    </div>

                    <div class="input_container">
                        <label for="fecha_aplicacion" class="form_label">FECHA DE APLICACIÓN O DE ACTUALIZACIÓN:</label>
                        <input type="date" name="fecha_aplicacion" id="fecha_aplicacion" class="form-control" required>
                        </div>
                        
                        <div class="input_container">
                            <label for="nombre_tutor" class="form_label">NOMBRE DEL TUTOR DE ATENCIÓN INDIVIDUAL:</label>
                            <input type="text" name="nombre_tutor" id="nombre_tutor" class="form-control" required
                                value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>">
                        </div>
                        
                        <div class="input_container">
                        <label for="cubiculo" class="form_label">CUBÍCULO:</label>
                        <input type="text" name="cubiculo" id="cubiculo" class="form-control" required>
                        </div>
                        
                        <div class="input_container">
                        <label for="telefono_tutor" class="form_label">TELÉFONO:</label>
                        <input type="tel" name="telefono_tutor" id="telefono_tutor" class="form-control" required>
                        </div>
                        
                        <div class="input_container">
                        <label for="observaciones_recomendaciones" class="form_label">OBSERVACIONES Y RECOMENDACIONES:</label>
                        <input type="text" name="observaciones_recomendaciones" id="observaciones_recomendaciones" class="form-control" required>
                    </div>

                        
                    <label for="imagen1">Firma del entrevistado(a):</label>
                    <input type="file" id="imagen1" name="imagen1" accept="image/*" required><br>

                    <label for="imagen2">Firma del tutor(a):</label>
                    <input type="file" id="imagen2" name="imagen2" accept="image/*" required><br>

                    <button type="submit" class="btn btn-primary mb-4">Generar PDF</button>
                </form> <!-- Cierre del formulario -->
            </div>
        </div>
    </div>

</body>
</html>
