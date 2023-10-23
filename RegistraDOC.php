<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <title>Cargar y Procesar Excel</title>
    <link rel="stylesheet" href="css/estilo5.css">
    <link rel="stylesheet" href="css/estiloBoton.css">
    <link rel="stylesheet" href="css/estiloModal.css"> <!-- Agrega el estilo del modal -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <script src="js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <!-- RAYAS DE ARRIBA,IZ -->
    <header class="fixed w-100">
    <a href="princi_Super_Admin.php" class="back-arrow rounded-pill d-flex justify-content-start">
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

    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
        <div class="tasks d-flex">
        </div>
    </main>

    <!-- Formulario para cargar el archivo Excel -->
    <form method="post" action="" enctype="multipart/form-data" id="form_excel">
        <label for="archivo" class="button-name" title="Seleccionar un archivo Excel">
            <span>Seleccionar Archivo</span>
            <input type="file" name="archivo" accept=".xlsx" id="archivo" style="display: none;" onchange="mostrarArchivoSeleccionado(this)">
        </label>
        <input type="hidden" name="reemplazar" id="reemplazar" value="no">
        <input type="button" class="button-name2" value="Cargar y Procesar" onclick="confirmarReemplazo()" title="Cargar y procesar el archivo Excel">
        <input type="hidden" name="guardar" value="Guardar"> <!-- Agrega un campo oculto para identificar el envío del formulario -->
        <input type="hidden" name="guardar" value="Guardar">
        <input type="hidden" name="asesor" id="asesorInput">
        <input type="hidden" name="presidente" id="presidenteInput">
        <input type="hidden" name="secretaria" id="secretariaInput">
        <input type="hidden" name="seleccionados" id="seleccionados">
        <input type="submit" class="button-name2" value="Guardar Cambios" onclick="obtenerSeleccionados()" title="Guardar los cambios en la base de datos">
    </form>

    <!-- Modal -->
    <div id="eliminarModal" class="modal">
        <div class="modal-content">
            <p>¿Seguro que deseas eliminar esta fila?</p>
            <button class="modal-button" onclick="confirmarEliminar()">Eliminar</button>
            <button class="modal-cancel-button" onclick="cancelarEliminar()">Cancelar</button>
        </div>
    </div>

    <!-- Modal de error -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarErrorModal()">&times;</span>
            <p id="errorMensaje"></p>
            <button class="modal-button" onclick="cerrarErrorModal()">Aceptar</button>
        </div>
    </div>

    <!-- Modal de edicion -->
    <div id="editar-modal" class="editar-modal modal" style="display: none;">
        <div class="editar-modal-content modal-content">
            <span class="editar-close close" onclick="cerrarFormularioEdicion()">&times;</span>
            <form action="UPDATE.php" method="post" onsubmit="return validarFormulario();">
                <input type="hidden" name="tabla" value="docentes"> <!-- Campo oculto para el nombre de la tabla -->
                <input type="hidden" name="archivo_origen" id="archivo_origen" value="RegistraDOC.php"> <!-- Campo oculto para el nombre del archivo -->
                <input type="hidden" name="id" id="editar-id" value="">
                <div class="editar-form-group form-group">
                    <label for="Academia">Academia:</label>
                    <input type="text" name="Academia" id="Academia">
                </div>
                <div class="editar-form-group form-group">
                    <label for="NumerodeControl">Número de Control:</label>
                    <input type="text" name="NumerodeControl" id="NumerodeControl">
                </div>
                <div class="editar-form-group form-group">
                    <label for="NombredelDocente">Nombre del Docente:</label>
                    <input type="text" name="NombredelDocente" id="NombredelDocente">
                </div>
                <button type="submit" class="editar-guardar-btn guardar-btn">Guardar</button>
            </form>
        </div>
    </div>

    </div>

    <button id="nuevoRegistroButton"  onclick="abrirFormularioRegistro()" >Nuevo Registro</button>

    <!-- Modal de registro -->
    <div id="registro-modal" class="registro-modal modal" style="display: none;">
        <div class="registro-modal-content modal-content">
            <span class="registro-close close" onclick="cerrarFormularioRegistro()">&times;</span>
            <form action="INSERT.php" method="post" onsubmit="return validarFormularioRegistro();">
                <input type="hidden" name="tabla" value="docentes"> <!-- Campo oculto para el nombre de la tabla -->
                <input type="hidden" name="archivo_origen" id="archivo_origen" value="RegistraDOC.php"> <!-- Campo oculto para el nombre del archivo -->
                <div class="registro-form-group form-group">
                    <label for="NuevoNombreCarrera">Nuevo Nombre de la Carrera:</label>
                    <input type="text" name="NuevoNombreCarrera" id="NuevoNombreCarrera">
                </div>
                <div class="registro-form-group form-group">
                    <label for="NuevoNumeroControl">Nuevo Número de Control:</label>
                    <input type="text" name="NuevoNumeroControl" id="NuevoNumeroControl">
                </div>

                <div class="registro-form-group form-group">
                    <label for="NuevoNombreDocente">Nuevo Nombre de Docente:</label>
                    <input type="text" name="NuevoNombreDocente" id="NuevoNombreDocente">
                </div>
                <button type="submit" class="registro-guardar-btn guardar-btn">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Barra Serch -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Buscar por Número de Control, Nombre de Carrera o Número de Semestre">
        <button onclick="search()">Buscar</button>
    </div>


    
    <?php
    require 'php/db.php';

    $mysqli=conectar();
    // Cambia la localización de MySQL a español
    $mysqli->set_charset("utf8"); // Configura el juego de caracteres
    $mysqli->query("SET lc_messages = 'es_ES'"); // Cambia la localización a español
    // Utilizar PhpSpreadsheet en lugar de PHPExcel
    require 'vendor/autoload.php'; // Asegúrate de que autoload.php apunte al directorio correcto

    use PhpOffice\PhpSpreadsheet\IOFactory;


    

    // Verificar si $_POST['seleccionados'] está definido antes de intentar acceder a él
    if (isset($_POST['seleccionados'])) {
        // Obtener los datos enviados desde JavaScript
        $elementosSeleccionados = json_decode($_POST['seleccionados'], true);

        // Verificar si $elementosSeleccionados es un array válido
        if (is_array($elementosSeleccionados)) {

            // Antes de actualizar, establecer los valores existentes en FALSE
            $resetQuery = "UPDATE docentes SET Asesor = FALSE, Presidente = FALSE, Secretaria = FALSE";
            if ($mysqli->query($resetQuery) !== TRUE) {
                echo "Error al restablecer valores existentes: " . $mysqli->error;
            }

            // Iterar a través de los elementos seleccionados y actualizar la base de datos
            foreach ($elementosSeleccionados as $elemento) {
                $tipo = $elemento['tipo'];
                $id = $elemento['id'];

                // Actualizar la fila correspondiente en la base de datos
                $sql = "UPDATE docentes SET $tipo = TRUE WHERE id = $id";

                if ($mysqli->query($sql) !== TRUE) {
                    echo "Error al actualizar la base de datos: " . $mysqli->error;
                }
            }

        } else {
           // echo "Error: Datos de selección no válidos.";
        }
    } else {
       // echo "Error: No se han recibido datos de selección.";
    }

    // Verificar si se ha enviado un archivo
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo']['tmp_name'];
        
        if (empty($archivo)) {
            //echo "Por favor, selecciona un archivo Excel.<br>";
        } else {
            //Variable con el nombre del archivo
            $nombreArchivo = $_FILES['archivo']['name'];
            move_uploaded_file($archivo, $nombreArchivo);
            
            // Verificar si el usuario desea reemplazar los datos existentes
            if (isset($_POST['reemplazar']) && $_POST['reemplazar'] === 'si') {
                // Eliminar los datos existentes de la tabla
                $deleteQuery = "DELETE FROM docentes";
                if ($mysqli->query($deleteQuery)) {
                   // echo "Datos existentes eliminados correctamente.<br>";
                } else {
                    echo "Error al eliminar datos existentes: " . $mysqli->error . "<br>";
                }
                $deleteQuery = "DELETE FROM usuarios WHERE tipo_usuario = 'docente'";
                if ($mysqli->query($deleteQuery)) {
                   // echo "Datos existentes eliminados correctamente.<br>";
                } else {
                    echo "Error al eliminar datos existentes: " . $mysqli->error . "<br>";
                }
            }
        }
            
            // Cargar la hoja de cálculo
            $objPHPExcel = IOFactory::load($nombreArchivo);

            // Asignar la hoja de cálculo activa
            $objPHPExcel->setActiveSheetIndex(0);

            // Obtener el número de filas del archivo
            $numRows = $objPHPExcel->getActiveSheet()->getHighestRow();

            // Variables para realizar la validación
            $valid = true;
            $errorMsg = "";

            // Define un array de columnas que deben estar completas
            $requiredColumns = array('A', 'B', 'C'); // Ejemplo: las columnas A, B y C son requeridas

            // Arrays para hacer un seguimiento de valores duplicados en cada columna
            $academiasVistas = array();
            $numerosDeControlVistos = array();
            $nombresDelDocenteVistos = array();

            $elementosDuplicados = false;

            for ($i = 2; $i <= $numRows; $i++) { // Comenzar desde la segunda fila (fila 2)
                $rowData = array();
                $filaVacia = true; // Inicializamos la bandera para verificar si la fila está vacía

                foreach ($requiredColumns as $column) {
                    $cellValue = $objPHPExcel->getActiveSheet()->getCell($column . $i)->getValue();
                    $rowData[] = $cellValue;

                    // Verificar si la columna tiene algún dato para considerar la fila como no vacía
                    if (!empty($cellValue) && in_array($column, $requiredColumns)) {
                        $filaVacia = false;
                    }
                }

                // Si la fila está vacía, sal del bucle
                if ($filaVacia) {
                    continue;
                }

                foreach ($requiredColumns as $column) {
                    $cellValue = $objPHPExcel->getActiveSheet()->getCell($column . $i)->getValue();
                    $rowData[] = $cellValue;

                    // Verificar si el campo está vacío o contiene datos no válidos
                    if (in_array($column, $requiredColumns) && (empty($cellValue) || !esValido($cellValue))) {
                        $valid = false;
                        $errorMsg = "Error en la fila $i: Los datos de la columna $column son inválidos.";

                        // Llama a una función JavaScript para mostrar el modal de error
                        echo '<script>';
                        echo 'mostrarErrorModal("' . addslashes($errorMsg) . '");';
                        echo '</script>';

                        break; // Sal del bucle si hay un error en esta columna (excepto si es columna A)
                    }

                    // Verificar si la columna tiene algún dato para considerar la fila como no vacía
                    if (!empty($cellValue)) {
                        $filaVacia = false;
                    }
                }

                // Si la fila está vacía y no es la última fila, sal del bucle
                if ($filaVacia && $i < $numRows) {
                    break;
                }

                // Verificar si ya se ha visto el valor en cada columna
                if (in_array($rowData[1], $numerosDeControlVistos) || in_array($rowData[2], $nombresDelDocenteVistos)) {
                    $elementosDuplicados = true;
                    $errorMsg = "Se encontraron elementos duplicados en el archivo Excel: ";
                
                    if (in_array($rowData[1], $numerosDeControlVistos)) {
                        $errorMsg .= " NumerodeControl: " . $rowData[1];
                    }
                    
                    if (in_array($rowData[2], $nombresDelDocenteVistos)) {
                        $errorMsg .= " NombredelDocente: " . $rowData[2];
                    }
                
                    // Llama a una función JavaScript para mostrar el modal de error
                    echo '<script>';
                    echo 'mostrarErrorModal("' . addslashes($errorMsg) . '");';
                    echo '</script>';
                } else {
                    // Agregar el valor actual a los arrays de seguimiento
                    $academiasVistas[] = $rowData[0];
                    $numerosDeControlVistos[] = $rowData[1];
                    $nombresDelDocenteVistos[] = $rowData[2];

                    // El resto de tu código de inserción
                    $Asesor = 0;
                    $Presidente = 0;
                    $Secretaria = 0;
                    $insertQuery = "INSERT INTO docentes (Academia, NumerodeControl, NombredelDocente, Asesor, Presidente, Secretaria) 
                                    VALUES ('$rowData[0]', '$rowData[1]', '$rowData[2]', '$Asesor', '$Presidente', '$Secretaria')";

                    if ($mysqli->query($insertQuery)) {
                        // Insertar usuario de docente en la tabla "usuarios"
                        $usuario = $rowData[1];
                        $contrasena = $rowData[1]; // Puedes establecer una contraseña predeterminada aquí
                        $sqlInsertDocente = "INSERT INTO usuarios (usuario, contrasena, tipo_usuario) VALUES ('$usuario', '$contrasena', 'docente')";

                        if ($mysqli->query($sqlInsertDocente) === TRUE) {
                            //echo "Usuario $usuario agregado correctamente.<br>";
                        } else {
                            $valid = false;
                            $errorMsg = "Error al agregar docente $usuario: " . $mysqli->error;
                            // Llama a una función JavaScript para mostrar el modal de error
                            echo '<script>';
                            echo 'mostrarErrorModal("' . addslashes($errorMsg) . '");';
                            echo '</script>';
                        }
                    } else {
                        $valid = false;
                        $errorMsg = "Error al insertar datos en la tabla docente: " . $mysqli->error;

                        // Llama a una función JavaScript para mostrar el modal de error
                        echo '<script>';
                        echo 'mostrarErrorModal("' . addslashes($errorMsg) . '");';
                        echo '</script>';
                    }
                }
            }

        }

     // Función para verificar si un valor es válido (puedes personalizar esta función según tus requisitos)
     function esValido($valor) {
        // Aquí puedes agregar lógica para verificar si el valor es válido.
        // Por ejemplo, verificar si es una cadena no vacía y no contiene caracteres especiales.
        // Puedes implementar tus propias reglas de validación.
        return !empty($valor) && !contieneCaracteresEspeciales($valor);
    }

    function contieneCaracteresEspeciales($cadena) {
        // Esta función verifica si una cadena contiene caracteres especiales.
        // Puedes personalizarla según tus necesidades.
        $caracteresEspeciales = array("#", "$", "@", "+", "%", "&");
        foreach ($caracteresEspeciales as $caracter) {
            if (strpos($cadena, $caracter) !== false) {
                return true;
            }
        }
        return false;
    }

    // Verificar si se ha enviado una solicitud para eliminar una fila
    if (isset($_POST['eliminar'])) {
        $idEliminar = $_POST['eliminar'];
        $deleteRowQuery = "DELETE FROM docentes WHERE id = $idEliminar";
        if ($mysqli->query($deleteRowQuery)) {
            //echo "Fila eliminada correctamente.<br>";
        } else {
            echo "Error al eliminar fila: " . $mysqli->error . "<br>";
        }
    }



    if($_SESSION['pagina']=='tutorias'){
                // Consulta SQL para seleccionar todos los registros de la tabla    
                $selectQuery = "SELECT * FROM docentes";

                // Ejecutar la consulta
                $result = $mysqli->query($selectQuery);
        
                if ($result) {
                    echo '<table border=2><tr><td>Academia</td><td>NumerodeControl</td><td>NombredelDocente</td><td>Acción</td></tr>'; // Cambio de "Estudiante" a "Docente"
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr id="fila-' . $row['id'] . '">';
                        echo '<td>'. $row['Academia'].'</td>';
                        echo '<td>'. $row['NumerodeControl'].'</td>';
                        echo '<td>'. $row['NombredelDocente'].'</td>';
                
                        // Botón para eliminar la fila
                        echo '<td><button class="btn" onclick="eliminarFilaDOC(' . $row['id'] . ')">
                            <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                                <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
                            </svg>
                        </button></td>';
                    
                        echo '</tr>';
                    }
                    
                    echo '</table>';
                    $result->free(); // Liberar el resultado
                } else {
                    echo "Error al consultar datos: " . $mysqli->error . "<br>";
                }

    }else{
                // Consulta SQL para seleccionar todos los registros de la tabla    
                $selectQuery = "SELECT * FROM docentes";

                // Ejecutar la consulta
                $result = $mysqli->query($selectQuery);
        
                if ($result) {
                    echo '<table border=2><tr><td>Academia</td><td>NumerodeControl</td><td>NombredelDocente</td><td>Asesor</td><td>Presidente</td><td>Secretaria</td><td>Acción</td></tr>'; // Cambio de "Estudiante" a "Docente"
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr id="fila-' . $row['id'] . '">';
                        echo '<td>'. $row['Academia'].'</td>';
                        echo '<td>'. $row['NumerodeControl'].'</td>';
                        echo '<td>'. $row['NombredelDocente'].'</td>';
                    
                        // Casilla de verificación para Asesor
                        echo '<td><input type="checkbox" id="asesor-' . $row['id'] . '" name="asesor[]" value="' . $row['id'] . '"';
                        if ($row['Asesor'] == 1) {
                            echo ' checked';
                        }
                        echo '></td>';
                    
                        // Casilla de verificación para Presidente (usar radio)
                        echo '<td><input type="radio" id="presidente-' . $row['id'] . '" name="presidente" value="' . $row['id'] . '"';
                        if ($row['Presidente'] == 1) {
                            echo ' checked';
                        }
                        echo '></td>';
                    
                        // Casilla de verificación para Secretaria (usar radio)
                        echo '<td><input type="radio" id="secretaria-' . $row['id'] . '" name="secretaria" value="' . $row['id'] . '"';
                        if ($row['Secretaria'] == 1) {
                            echo ' checked';
                        }
                        echo '></td>';
                    
                        // Botón para eliminar la fila
                        echo '<td><button class="btn" onclick="eliminarFilaDOC(' . $row['id'] . ')">
                            <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                                <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
                            </svg>
                        </button>
                        
                        <button class="btn" onclick="abrirFormularioEdicion(' . $row['id'] . ' , \' ' . $row['Academia'] . ' \', \' ' . $row['NumerodeControl'] . ' \', \' ' . $row['NombredelDocente'] . ' \')">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                        </button>

                        </td>';
                    
                        echo '</tr>';
                    }
                    
                    echo '</table>';
                    $result->free(); // Liberar el resultado
                } else {
                    echo "Error al consultar datos: " . $mysqli->error . "<br>";
                }
    }

    
?>

</body>
</html>

