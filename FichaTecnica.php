<?php
    session_start();
    $carrera=$_GET['carrera']??"";
    echo $carrera;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">  
    <link rel="stylesheet" href="css/normalize.css">  

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/FichaTEc.css">
    <link rel="stylesheet" href="js/app.js">
    <script type="text/javascript" src="R-ITSZaS-8.5-20Formato Ficha Técnica/jspdf.min.js"></script>
    
    <title>Ficha técnica</title>
</head>
<body>
<?php
    require 'php/db.php';
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
    <br>
    <header class="fixed w-100">
        <a href="formatos.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
    </a>
    <div class="usuarioOp d-flex justify-content-end">
        <img src="img/profile.png" alt="" >
        <?php
                $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
                echo '<p>' . $nombre . '</p>';
                ?>
                <div class="dropdown-content">
                    <a href="/loginTutorias.php">Cerrar sesión</a>
        </div>
    </header>

    <main>
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
            </div>
            <section style="margin-top: 70px;
            text-align: center;">
            <h2 style="text-align: center;">
                Ficha técnica parcial tutorial
            </h2>
        



        </section>
        <section>
            <form action="php/Full_FichaT.php" class="Tabla_contenido" method="post" enctype="multipart/form-data"><div>
                <div class="row">
                <div class="col-md-6">
                <label for="">Periodo:</label><input type="text" name="Periodo" id="Periodo" readonly>
                <br>
                
                <label for="">Fecha:</label><input type="date" name="Fecha" id="Fecha" readonly>
                <br>
                <label for="">Nombre del estudiante:</label>
                <select class="form-select" name="nombre" id="nombre" required>
                                <?php
                                while ($filaAlumnos = $resultadoAlumnos->fetch_assoc()) {
                                    echo '<option value="' . $filaAlumnos['NombreDelEstudiante'] . '">' . $filaAlumnos['NombreDelEstudiante'] . '</option>';
                                }
                                ?>
                            </select>
                <br>
                <label for="">Semestre:</label><input type="text" name="Semestre" id="Semestre" required value="<?php echo $semestre; ?>">
                <br>
                <label for="">Plan de estudio</label>
                <?php
                            // Resetear el puntero del resultado
                            mysqli_data_seek($resultadoAlumnos, 0);

                            // Obtener la Academia del primer estudiante (puedes ajustar esto según tus necesidades)
                            $filaAlumnos = $resultadoAlumnos->fetch_assoc();
                            $academia = $filaAlumnos['Academia'];
                            echo '<input type="text" name="PE" id="PE" class="form-control" value="' . $academia . '" required>';
                            ?>
                
                <br>
                <label for="">Actividades de seguimiento realizadas:</label><textarea type="text" name="ASR" id="ASR" class="G" height="5" width="80" required></textarea>
                    
                <br>
            </div>
                <br>
                <br>
                <div class="col-md-6">
                    <label for="">Deserción:</label><textarea type="text" name="Desercion" id="Desercion" class="G" height="" width="80" required></textarea>
                        
                <br>
                <label for="">Observaciones:</label>
                <textarea type="text" name="Observasiones" id="Observasiones" class="G" rows="" cols="80" required></textarea>
                    
            
                <h4>Tutor(A)</h4>
                <br>
                <label for="">Nombre</label><input type="text" name="NP" id="NP" readonly value="<?php echo $nombre?>">
                <br>
                <br>
                <label for="">Firma</label>
                <br>
                <input type="file" name="Firma" id=""  required onchange="validarArchivo()">
                
                <br>
                <br></div>
            </div>
                
                
                
                
            
        </section>
        
        <section>
        <button type="submit" onclick="" >
            <div class="svg-wrapper-1">
              <div class="svg-wrapper">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                </svg>
              </div>
            </div>
            <span>Enviar</span>
            <script type="text/javascript">
                function mostrar(){
                    
                    swal("Correcto", "Los datos fueron enviados correctamente", "success");
            

                }
            </script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
            </script>
 
            
            <script>
                function validarArchivo() {
                    var input = document.getElementById('Firma');
                    var archivo = input.files[0];
            
                    if (archivo) {
                        var tipoArchivo = archivo.type;
                        var extension = tipoArchivo.split('/')[1].toLowerCase();
            
                        // Lista de extensiones permitidas (puedes ajustarla según tus necesidades)
                        var extensionesPermitidas = ['jpeg', 'jpg', 'png', 'gif'];
            
                        if (extensionesPermitidas.indexOf(extension) === -1) {
                            // Mostrar mensaje de error
                            input.value = ''; // Limpiar el valor del campo de archivo
                            alert('Solo se permiten archivos de imagen (jpeg, jpg, png, gif)');
                        }
                    }
                }
            </script>
            <script>
                // Obtener la fecha actual
                const fechaActual = new Date();

                // Obtener el mes actual (1-12)
                const mesActual = fechaActual.getMonth() + 1;

                // Establecer el valor del campo según el rango de meses
                if (mesActual >= 1 && mesActual <= 6) {
                document.getElementById("Periodo").value = "Enero-Junio";
                } else {
                document.getElementById("Periodo").value = "Agosto-Diciembre";
                }

                // Deshabilitar el campo solo si no estamos en los meses de agosto a diciembre
                if (mesActual < 8 || mesActual > 12) {
                document.getElementById("Periodo").disabled = true;
                }
                const fechaActual2 = new Date().toISOString().split('T')[0];

                // Establecer la fecha actual como valor por defecto
                document.getElementById("Fecha").value = fechaActual2;

            </script>

          </button>
          </section>
          </form>
    </main>
    <script src="js/envia_FECH.js"></script>
    <style>
        #imagenPrevisualizacion img {
            max-height: 200px; /* Establece la altura máxima de la imagen */
            width: auto; /* Hace que el ancho se ajuste automáticamente para mantener la proporción */
        }
    </style>
    

    
    

    
</body>
</html>