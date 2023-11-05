<?php
include 'databaseUPDATE.php';

$conn = conectarBaseDeDatos();

$conn->set_charset("utf8"); // Configura el juego de caracteres
$conn->query("SET lc_messages = 'es_ES'"); // Cambia la localización a español

$resultado = ''; // Inicializa la variable de resultado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tabla = $_POST['tabla'];

    // Crear una función para validar si un número de control ya existe en la tabla ALUMNOS NORMALES
    function numeroControlExiste($conn, $numeroControl, $tabla) {
        $sql = "SELECT * FROM $tabla WHERE NumeroDeControl = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $numeroControl);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Crear una función para validar si un número de control ya existe en la tabla TODOS LOS DEMAS
    function numeroControlExisteChido($conn, $numeroControl, $tabla) {
        $sql = "SELECT * FROM $tabla WHERE NumerodeControl = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $numeroControl);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    function nombreCarreraExiste($conn, $NombredeCarrera) {
        $sql = "SELECT * FROM carrera WHERE NombredeCarrera = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $NombredeCarrera);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    function ControlCarreraExiste($conn, $NuevoNumeroControlAcademia) {
        $sql = "SELECT * FROM carrera WHERE NumerodeControl = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $NuevoNumeroControlAcademia);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    if ($tabla === 'carrera') {
        $NumerodeControl = trim($_POST['NumerodeControl']);
        $NombredeCarrera = trim($_POST['NombredeCarrera']);
        $NumerodeSemestres = trim($_POST['NumerodeSemestres']);

        if (numeroControlExisteChido($conn, $NumerodeControl, $tabla)) {
            $resultado = "El número de control coincide con el del sistema.";

            if (nombreCarreraExiste($conn, $NombredeCarrera)) {
                $resultado = "El nombre de la carrera existe en el sistema.";

                $campos = [
                    'NumerodeControl' => $NumerodeControl,
                    'NombredeCarrera' => $NombredeCarrera,
                    'NumerodeSemestres' => $NumerodeSemestres
                ];
        
                $resultado = actualizarTabla($conn, $tabla, $id, $campos);

            }else{
                $resultado = "El nombre de la carrera no existe en el sistema.";
            }
            

            
        }else{
            $resultado = "El número de control no coincide con el del sistema.";
        }

        

        // Lógica específica para la tabla carrera
    } elseif ($tabla === 'grupos') {
        $NumerodeControl = trim($_POST['NumerodeControl']);
        $NombredeCarrera = trim($_POST['NombredeCarrera']);
        $Semestre = trim($_POST['Semestre']);
        $Edificio = trim($_POST['Edificio']);
        $Salon = trim($_POST['Salon']);

        $campos = [
            'NumerodeControl' => $NumerodeControl,
            'NombredeCarrera' => $NombredeCarrera,
            'Semestre' => $Semestre,
            'Edificio' => $Edificio,
            'Salon' => $Salon
        ];

        $resultado = actualizarTabla($conn, $tabla, $id, $campos);
        // Lógica específica para la tabla grupo

    } elseif ($tabla === 'docentes') {
        $NumerodeControl = trim($_POST['NumerodeControl']);
        $Academia = trim($_POST['Academia']);
        $NombredelDocente = trim($_POST['NombredelDocente']);

        $campos = [
            'NumerodeControl' => $NumerodeControl,
            'Academia' => $Academia,
            'NombredelDocente' => $NombredelDocente
        ];

        $resultado = actualizarTabla($conn, $tabla, $id, $campos);

    } elseif ($tabla === 'materias') {

        $NumerodeControlAcademia = trim($_POST['NumerodeControlAcademia']);
        $NumerodeControl = trim($_POST['NumerodeControl']);
        $NombredelaMateria = trim($_POST['NombredelaMateria']);
        $NumerodeControlDocente = trim($_POST['NumerodeControlDocente']);
        $Unidades = trim($_POST['Unidades']);

        $campos = [
            'NumerodeControlAcademia' => $NumerodeControlAcademia,
            'NumerodeControl' => $NumerodeControl,
            'NombredelaMateria' => $NombredelaMateria,
            'NumerodeControlDocente' => $NumerodeControlDocente,
            'Unidades' => $Unidades
        ];

        $resultado = actualizarTabla($conn, $tabla, $id, $campos);
        // ... lógica para la tabla materia

    } elseif ($tabla === 'alumnos') {

        $NumerodeControl = trim($_POST['NumerodeControl']);
        $Academia = trim($_POST['Academia']);
        $NombredelEstudiante = trim($_POST['NombredelEstudiante']);
        $NombredelAnteproyecto = trim($_POST['NombredelAnteproyecto']);
    
        $campos = [
            'NumerodeControl' => $NumerodeControl,
            'Academia' => $Academia,
            'NombredelEstudiante' => $NombredelEstudiante,
            'NombredelAnteproyecto' => $NombredelAnteproyecto,
        ];
    
        $resultado = actualizarTabla($conn, $tabla, $id, $campos);
   
    } elseif ($tabla === "alumnosnormales"){
        $NumerodeControlNormal = trim($_POST['NumerodeControlNormal']);
        $AcademiaNormal = trim($_POST['AcademiaNormal']);
        $NombredelEstudianteNormal = trim($_POST['NombredelEstudianteNormal']);
        
        $campos = [
            'NumeroDeControl' => $NumerodeControlNormal,
            'Academia' => $AcademiaNormal,
            'NombreDelEstudiante' => $NombredelEstudianteNormal,
        ];
        
        $resultado = actualizarTabla($conn, $tabla, $id, $campos);

    }

     // Recupera el nombre del archivo de origen
     $archivo_origen = $_POST['archivo_origen'];

     // Redirige al archivo de origen con el resultado en la URL
     header('Location: ' . $archivo_origen . '?resultado=' . urlencode($resultado));
     exit; // Asegúrate de que no se ejecuten más instrucciones después de la redirección

}

// Cierra la conexión
$conn->close();


//, \' ' . $row['NumerodeControl'] . ' \'



?>

