<?php
session_start();
$carrera = $_GET['carrera'] ?? "";

// Conexión a la base de datos (debes modificar los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los nombres y estudios de la tabla hv
$sql = "SELECT nombre, estudio FROM hv";
$result = $conn->query($sql);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formato Hoja de vida</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="jspdf.min.js"></script>
    <script src="hv2.js"></script>
    <STYle>
          .boton {
            font-size: 16px;
            position: relative;
            margin: auto;
            padding: 1em 2.5em 1em 2.5em;
            border: none;
            background: #3498DB;
            color: #FFF;
            transition: all 0.1s linear;
            box-shadow: 0 0.4em 1em rgba(0, 0, 0, 0.1);
            border-radius: 2em;
            }

        .boton:hover {
            background: linear-gradient(to bottom, #2c2f63, #5b67b7);
            animation: button-particles 1s ease-in-out infinite;
            transform: translateY(-2px);
        

        }

        .boton1 {
            font-size: 16px;
            margin: auto;
            text-decoration: none; 
            width: 20%;
            height: 10%;
            text-align: center;
            top: 30%;
            right:0%;
          
            border: none;
            background: #3498DB;
            color: #FFF;
            transition: all 0.1s linear;
            box-shadow: 0 0.4em 1em rgba(0, 0, 0, 0.1);
            border-radius: 2em;
            }

        .boton1:hover {
            background: linear-gradient(to bottom, #2c2f63, #5b67b7);
            animation: button-particles 1s ease-in-out infinite;
            transform: translateY(-2px);
        }
        h2{
            text-align: center;
            background-color: #2c2f63;
            color: #FFF;
        }
        hr{
            color: #2c2f63;
        
        }
        label{
            font-size: 16px;
        }
        h4{
            color:#3498DB;
            font-size: 25px;
        }
        h5{
            font-size: 18px;
        }
        h6{
            font-size: 20px;
            color: #1e3188;

        }
        header {
            height: 70px;
        }

        body {
            display: flex;
            flex-direction: column;
            
            background-color: #D9D9D9;
            font-family: 'Open Sans', sans-serif;
            margin: 0; /* Elimina los márgenes predeterminados del cuerpo */
            padding: 0; /* Elimina el espacio interior predeterminado del cuerpo */
        }


        .usuarioOp {
            gap: 15px;
            padding: 10px 40px;
        }

        .usuarioOp a{
            padding: 10px 0;
            color: rgb(37, 74, 236);
        }
        .usuarioOp a:hover{
            color:#FFF;
        }
        .usuarioOp p{
            padding: 10px 0;
            color: #Fff;

        }
        .usuarioOp img {
            padding: 40px;
            border-radius: 1.5rem;
        }
       

        .barraLateral {
            top: 0;
            left: 0; 
            width: 100px; 
        }

        .fixed {
            background-color:  #1E3C6C;
            position: fixed;
        }
        
    </STYle>
</head>
<body>
    <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="">
            <?php
                $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
                echo '<p>' . $nombre . '</p>';
            ?>
            <a href="/formatos.php">Regresar</a>
        </div>
    </header>
    <main>
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
        <div class="container" style="margin-top: 80px;">
    
    <!--<a class="boton1" href="/formatos.php">Regresar</a>-->

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2>Hoja de vida</h2>
                    <hr>
                    <form id="form"> <!-- Inicio del formulario -->
                        <div class="row mb-5">
                        

                            <div class="col-md-5">
                                <label for="estudio" class="form-label" >Plan de estudio</label>
                                <select class="form-select" id="estudio" onchange="updateNames()">
                                    <option value="">Seleccione</option>
                                    <?php
                                    $result->data_seek(0); // Reinicia el puntero del conjunto de resultados al principio
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['estudio']}'>{$row['estudio']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label for="nombre" class="form-label">Nombre del estudiante</label>
                                <select class="form-select" id="nombre">
                                     <!--La lista de nombres se llenará dinámicamente mediante JavaScript -->
                                </select>
                            </div>
                        

                            <script>
                               
                                function updateNames() {
                                    var estudioSelect = document.getElementById('estudio');
                                    var nombreSelect = document.getElementById('nombre');
                                    var selectedEstudio = estudioSelect.options[estudioSelect.selectedIndex].value;

                                    console.log('Selected estudio:', selectedEstudio);

                                    // Realizar una solicitud AJAX usando Fetch API
                                    fetch('hv.php?estudio=' + selectedEstudio)
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log('Response from server:', data);

                                            // Llenar el menú desplegable de nombres con los resultados de la solicitud
                                            nombreSelect.innerHTML = '<option value="">Seleccione</option>'; // Limpiar opciones existentes
                                            data.forEach(item => {
                                                var option = document.createElement('option');
                                                option.value = item.nombre;
                                                option.text = item.nombre;
                                                nombreSelect.appendChild(option);
                                            });
                                        })
                                        .catch(error => console.error('Error:', error));
                                }
                            </script>

                            <br>
                            <br>
                            <br>
                            <br>
                            <hr>
                            <h5>Seleccione los campos en base al avance el alumno.</h5>
                            <br>
                            
                            <br>
                            <h4>Semestre 1</h4>
                            <div class="col-md-12 mt-4">
                                <h6>Carga académica</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion1" id="opcion1">
                                            <label class="form-check-label" for="opcion1">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion2" id="opcion2">
                                            <label class="form-check-label" for="opcion2">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion3" id="opcion3">
                                            <label class="form-check-label" for="opcion3">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion4" id="opcion4">
                                            <label class="form-check-label" for="opcion4">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                        
                                <h6>Inglés nivel 1</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion5" id="opcion5">
                                            <label class="form-check-label" for="opcion5">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion6" id="opcion6">
                                            <label class="form-check-label" for="opcion6">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion7" id="opcion7">
                                            <label class="form-check-label" for="opcion7">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion8" id="opcion8">
                                            <label class="form-check-label" for="opcion8">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <h6>Actividades extraescolares</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion9" id="opcion9">
                                            <label class="form-check-label" for="opcion9">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion10" id="opcion10">
                                            <label class="form-check-label" for="opcion10">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion11" id="opcion11">
                                            <label class="form-check-label" for="opcion11">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion12" id="opcion12">
                                            <label class="form-check-label" for="opcion12">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                        


                                <h6>Tutoría grupal</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion13" id="opcion13">
                                            <label class="form-check-label" for="opcion13">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion14" id="opcion14">
                                            <label class="form-check-label" for="opcion14">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion15" id="opcion15">
                                            <label class="form-check-label" for="opcion15">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion16" id="opcion16">
                                            <label class="form-check-label" for="opcion16">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <br>
                            
                            <h4>Semestre 2</h4>
                            
                            <div class="col-md-12 mt-4">
                                <h6>Carga académica</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion17" id="opcion17">
                                            <label class="form-check-label" for="opcion17">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion18" id="opcion18">
                                            <label class="form-check-label" for="opcion18">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion19" id="opcion19">
                                            <label class="form-check-label" for="opcion19">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion20" id="opcion20">
                                            <label class="form-check-label" for="opcion20">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Inglés nivel 2</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion21" id="opcion21">
                                            <label class="form-check-label" for="opcion21">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion22" id="opcion22">
                                            <label class="form-check-label" for="opcion22">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion23" id="opcion23">
                                            <label class="form-check-label" for="opcion23">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion24" id="opcion24">
                                            <label class="form-check-label" for="opcion24">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Actividades extraescolares</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion25" id="opcion25">
                                            <label class="form-check-label" for="opcion25">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion26" id="opcion26">
                                            <label class="form-check-label" for="opcion26">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion27" id="opcion27">
                                            <label class="form-check-label" for="opcion27">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion28" id="opcion28">
                                            <label class="form-check-label" for="opcion28">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Tutoría grupal</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion29" id="opcion29">
                                            <label class="form-check-label" for="opcion29">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion30" id="opcion30">
                                            <label class="form-check-label" for="opcion30">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion31" id="opcion31">
                                            <label class="form-check-label" for="opcion31">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion32" id="opcion32">
                                            <label class="form-check-label" for="opcion32">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <hr>
                            <h4>Semestre 3</h4>
                            <div class="col-md-12 mt-4">
                                <h6>Carga académica</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion33" id="opcion33">
                                            <label class="form-check-label" for="opcion33">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion34" id="opcion34">
                                            <label class="form-check-label" for="opcion34">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion35" id="opcion35">
                                            <label class="form-check-label" for="opcion35">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion36" id="opcion36">
                                            <label class="form-check-label" for="opcion36">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Inglés nivel 3</h6>
                                <br>
                        
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion37" id="opcion37">
                                            <label class="form-check-label" for="opcion37">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion38" id="opcion38">
                                            <label class="form-check-label" for="opcion38">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion39" id="opcion39">
                                            <label class="form-check-label" for="opcion39">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion40" id="opcion40">
                                            <label class="form-check-label" for="opcion40">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Actividades extraescolares</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion41" id="opcion41">
                                            <label class="form-check-label" for="opcion41">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion42" id="opcion42">
                                            <label class="form-check-label" for="opcion42">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion43" id="opcion43">
                                            <label class="form-check-label" for="opcion43">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion44" id="opcion44">
                                            <label class="form-check-label" for="opcion44">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Tutoría grupal</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion45" id="opcion45">
                                            <label class="form-check-label" for="opcion45">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion46" id="opcion46">
                                            <label class="form-check-label" for="opcion46">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion47" id="opcion47">
                                            <label class="form-check-label" for="opcion47">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion48" id="opcion48">
                                            <label class="form-check-label" for="opcion48">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                            <h4>Semestre 4</h4>
                            <div class="col-md-12 mt-4">
                                <h6>Carga académica</h6>
                                <br>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion49" id="opcion49">
                                            <label class="form-check-label" for="opcion49">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion50" id="opcion50">
                                            <label class="form-check-label" for="opcion50">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion51" id="opcion51">
                                            <label class="form-check-label" for="opcion51">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion52" id="opcion52">
                                            <label class="form-check-label" for="opcion52">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Inglés nivel 4</h6>
                                <br>
                        
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion53" id="opcion53">
                                            <label class="form-check-label" for="opcion53">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion54" id="opcion54">
                                            <label class="form-check-label" for="opcion54">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion55" id="opcion55">
                                            <label class="form-check-label" for="opcion55">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion56" id="opcion56">
                                            <label class="form-check-label" for="opcion56">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Actividades extraescolares</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion57" id="opcion57">
                                            <label class="form-check-label" for="opcion57">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion58" id="opcion58">
                                            <label class="form-check-label" for="opcion58">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion59" id="opcion59">
                                            <label class="form-check-label" for="opcion59">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion60" id="opcion60">
                                            <label class="form-check-label" for="opcion60">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Tutoría grupal</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion61" id="opcion61">
                                            <label class="form-check-label" for="opcion61">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion62" id="opcion62">
                                            <label class="form-check-label" for="opcion62">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion63" id="opcion63">
                                            <label class="form-check-label" for="opcion63">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion64" id="opcion64">
                                            <label class="form-check-label" for="opcion64">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <h6>Crédito ecológico</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion65" id="opcion65">
                                            <label class="form-check-label" for="opcion65">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion66" id="opcion66">
                                            <label class="form-check-label" for="opcion66">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion67" id="opcion67">
                                            <label class="form-check-label" for="opcion67">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion68" id="opcion68">
                                            <label class="form-check-label" for="opcion68">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                            <h4>Semestre 5</h4>
                            <div class="col-md-12 mt-4">
                                <h6>Carga académica</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion69" id="opcion69">
                                            <label class="form-check-label" for="opcion69">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion70" id="opcion70">
                                            <label class="form-check-label" for="opcion70">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion71" id="opcion71">
                                            <label class="form-check-label" for="opcion71">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion72" id="opcion72">
                                            <label class="form-check-label" for="opcion72">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Inglés nivel 5</h6>
                                <br>

                        
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion73" id="opcion73">
                                            <label class="form-check-label" for="opcion73">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion74" id="opcion74">
                                            <label class="form-check-label" for="opcion74">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion75" id="opcion75">
                                            <label class="form-check-label" for="opcion75">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion76" id="opcion76">
                                            <label class="form-check-label" for="opcion76">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                
                                <h6>Tutoría grupal e individual</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion77" id="opcion77">
                                            <label class="form-check-label" for="opcion77">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion78" id="opcion78">
                                            <label class="form-check-label" for="opcion78">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion79" id="opcion79">
                                            <label class="form-check-label" for="opcion79">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion80" id="opcion80">
                                            <label class="form-check-label" for="opcion80">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                            <h4>Semestre 6</h4>
                            <div class="col-md-12 mt-4">
                                <h6>Carga académica</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion81" id="opcion81">
                                            <label class="form-check-label" for="opcion81">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion82" id="opcion82">
                                            <label class="form-check-label" for="opcion82">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion83" id="opcion83">
                                            <label class="form-check-label" for="opcion83">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion84" id="opcion84">
                                            <label class="form-check-label" for="opcion84">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Inglés nivel 6</h6>
                                <br>
                        
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion85" id="opcion85">
                                            <label class="form-check-label" for="opcion85">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion86" id="opcion86">
                                            <label class="form-check-label" for="opcion86">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion87" id="opcion87">
                                            <label class="form-check-label" for="opcion87">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion88" id="opcion88">
                                            <label class="form-check-label" for="opcion88">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                
                                <h6>Tutoría grupal e individual</h6>
                                <br>
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion89" id="opcion89">
                                            <label class="form-check-label" for="opcion89">Campo 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion90" id="opcion90">
                                            <label class="form-check-label" for="opcion90">Campo 2</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion91" id="opcion91">
                                            <label class="form-check-label" for="opcion91">Campo 3</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="opcion92" id="opcion92">
                                            <label class="form-check-label" for="opcion92">Campo 4</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                            <h4>Semestre 7</h4>
                                <div class="col-md-12 mt-4">
                                    <h6>Carga académica</h6>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion93" id="opcion93">
                                                <label class="form-check-label" for="opcion93">Campo 1</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion94" id="opcion94">
                                                <label class="form-check-label" for="opcion94">Campo 2</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion95" id="opcion95">
                                                <label class="form-check-label" for="opcion95">Campo 3</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion96" id="opcion96">
                                                <label class="form-check-label" for="opcion96">Campo 4</label>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <br>
                                    <h6>Certificación</h6>
                                    <br>
                            
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion97" id="opcion97">
                                                <label class="form-check-label" for="opcion97">Campo 1</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion98" id="opcion98">
                                                <label class="form-check-label" for="opcion98">Campo 2</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion99" id="opcion99">
                                                <label class="form-check-label" for="opcion99">Campo 3</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion100" id="opcion100">
                                                <label class="form-check-label" for="opcion100">Campo 4</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h6>Tutoría grupal e individual</h6>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion101" id="opcion101">
                                                <label class="form-check-label" for="opcion101">Campo 1</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion102" id="opcion102">
                                                <label class="form-check-label" for="opcion102">Campo 2</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion103" id="opcion103">
                                                <label class="form-check-label" for="opcion103">Campo 3</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion104" id="opcion104">
                                                <label class="form-check-label" for="opcion104">Campo 4</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h6>Servicio social</h6>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion105" id="opcion105">
                                                <label class="form-check-label" for="opcion105">Campo 1</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion106" id="opcion106">
                                                <label class="form-check-label" for="opcion106">Campo 2</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion107" id="opcion107">
                                                <label class="form-check-label" for="opcion107">Campo 3</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion108" id="opcion108">
                                                <label class="form-check-label" for="opcion108">Campo 4</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <h4>Semestre 8</h4>
                                <div class="col-md-12 mt-4">
                                    <h6>Carga académica</h6>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion109" id="opcion109">
                                                <label class="form-check-label" for="opcion109">Campo 1</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion110" id="opcion110">
                                                <label class="form-check-label" for="opcion110">Campo 2</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion111" id="opcion111">
                                                <label class="form-check-label" for="opcion111">Campo 3</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion112" id="opcion112">
                                                <label class="form-check-label" for="opcion112">Campo 4</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h6>Tutoría grupal e individual</h6>
                                    <br>
                                
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion113" id="opcion113">
                                                <label class="form-check-label" for="opcion113">Campo 1</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion114" id="opcion114">
                                                <label class="form-check-label" for="opcion114">Campo 2</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion115" id="opcion115">
                                                <label class="form-check-label" for="opcion115">Campo 3</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion116" id="opcion116">
                                                <label class="form-check-label" for="opcion116">Campo 4</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <h4>Semestre 9</h4>
                                <div class="col-md-12 mt-4">
                                    <h6>Residencia profesional</h6>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion117" id="opcion117">
                                                <label class="form-check-label" for="opcion117">Campo 1</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion118" id="opcion118">
                                                <label class="form-check-label" for="opcion118">Campo 2</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion119" id="opcion119">
                                                <label class="form-check-label" for="opcion119">Campo 3</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="opcion120" id="opcion120">
                                                <label class="form-check-label" for="opcion120">Campo 4</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <button type="submit" class="boton">Generar PDF</button>
                    </form> <!-- Cierre del formulario -->
                </div>
            </div>
        </div>
    </main>
    
</body>
</html> 