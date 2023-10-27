<?php
include 'databaseUPDATE.php';

$conn = conectarBaseDeDatos();

$conn->set_charset("utf8"); // Configura el juego de caracteres
$conn->query("SET lc_messages = 'es_ES'"); // Cambia la localización a español

$resultado = ''; // Inicializa la variable de resultado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tabla = $_POST['tabla'];

    

    if ($tabla === 'carrera') {
        $NumerodeControl = $_POST['NumerodeControl'];
        $NombredeCarrera = $_POST['NombredeCarrera'];
        $NumerodeSemestres = $_POST['NumerodeSemestres'];

        $campos = [
            'NumerodeControl' => $NumerodeControl,
            'NombredeCarrera' => $NombredeCarrera,
            'NumerodeSemestres' => $NumerodeSemestres
        ];

        $resultado = actualizarTabla($conn, $tabla, $id, $campos);

        // Lógica específica para la tabla carrera
    } elseif ($tabla === 'grupos') {
        $NumerodeControl = $_POST['NumerodeControl'];
        $NombredeCarrera = $_POST['NombredeCarrera'];
        $Semestre = $_POST['Semestre'];
        $Edificio = $_POST['Edificio'];
        $Salon = $_POST['Salon'];

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
        $NumerodeControl = $_POST['NumerodeControl'];
        $Academia = $_POST['Academia'];
        $NombredelDocente = $_POST['NombredelDocente'];

        $campos = [
            'NumerodeControl' => $NumerodeControl,
            'Academia' => $Academia,
            'NombredelDocente' => $NombredelDocente
        ];

        $resultado = actualizarTabla($conn, $tabla, $id, $campos);

    } elseif ($tabla === 'materias') {

        $NumerodeControlAcademia = $_POST['NumerodeControlAcademia'];
        $NumerodeControl = $_POST['NumerodeControl'];
        $NombredelaMateria = $_POST['NombredelaMateria'];
        $NumerodeControlDocente = $_POST['NumerodeControlDocente'];
        $Unidades = $_POST['Unidades'];

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

