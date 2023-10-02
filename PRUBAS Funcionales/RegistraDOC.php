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
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="" >
            <p>Usuario</p>
            <a href="#">Cerrar sesión</a>
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

    
    <?php
    $mysqli = new mysqli("localhost", "root", "", "Tutorias_Residencia");

    if (mysqli_connect_errno()) {
        echo 'Conexion Fallida: ' . mysqli_connect_error();
        exit();
    }
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
            echo "Error: Datos de selección no válidos.";
        }
    } else {
        echo "Error: No se han recibido datos de selección.";
    }

    // Verificar si se ha enviado un archivo
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo']['tmp_name'];
        
        if (empty($archivo)) {
            echo "Por favor, selecciona un archivo Excel.<br>";
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
            }
            
            // Cargo la hoja de cálculo
            $objPHPExcel = IOFactory::load($nombreArchivo);

            //Asigno la hoja de calculo activa
            $objPHPExcel->setActiveSheetIndex(0);
            //Obtengo el numero de filas del archivo
            $numRows = $objPHPExcel->getActiveSheet()->getHighestRow();

            // Variables para realizar la validación
            $valid = true;
            $errorMsg = "";

            // Define un array de columnas que deben estar completas
            $requiredColumns = array('A', 'B', 'C'); // Ejemplo: las columnas A, B, C y D son requeridas

            $valid = true; // Inicializamos la bandera como verdadera

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

                if (!$valid) {
                    break; // No es necesario continuar la validación si ya hay un error
                }

                $Academia = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
                $NumerodeControl = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
                $NombredelDocente = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
                // Eliminamos la columna relacionada con "ANTEPROYECTO"

                // Valores por defecto para las columnas Asesor, Presidente y Secretaria
                $Asesor = false;
                $Presidente = false;
                $Secretaria = false;

                // Verificar si los datos no están vacíos antes de procesarlos
                if (!empty($Academia) && !empty($NumerodeControl) && !empty($NombredelDocente)) {
                    // Insertar los datos en la tabla
                    $insertQuery = "INSERT INTO docentes (Academia, NumerodeControl, NombredelDocente, Asesor, Presidente, Secretaria) 
                                    VALUES ('$Academia', '$NumerodeControl', '$NombredelDocente', '$Asesor', '$Presidente', '$Secretaria')";
                    if ($mysqli->query($insertQuery)) {
                        //echo "Datos insertados correctamente.<br>";
                    } else {
                        echo "Error al insertar datos: " . $mysqli->error . "<br>";
                    }
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
        </button></td>';
    
        echo '</tr>';
    }
    
    echo '</table>';
    $result->free(); // Liberar el resultado
} else {
    echo "Error al consultar datos: " . $mysqli->error . "<br>";
}
?>

</body>
</html>

