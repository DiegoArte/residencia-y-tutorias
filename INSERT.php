<?php
include 'databaseUPDATE.php';

$conn = conectarBaseDeDatos();

$resultado = ''; // Inicializa la variable de resultado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tabla = $_POST['tabla'];
 

    if ($tabla === 'carrera') {
        $NuevoNumeroControlAcademia = $_POST['NuevoNumeroControlAcademia'];
        $NuevoNombreCarrera = $_POST['NuevoNombreCarrera'];
        $NuevoSemestres = $_POST['NuevoSemestres'];

        $campos = array(
            'NumerodeControl' => $NuevoNumeroControlAcademia,
            'NombredeCarrera' => $NuevoNombreCarrera,
            'NumerodeSemestres' => $NuevoSemestres
        );

        $resultado = agregarRegistro($conn, $tabla, $campos);

        // Lógica específica para la tabla carrera
    } elseif ($tabla === 'grupos') {
        $NuevoNumeroControl = $_POST['NuevoNumeroControl'];
        $NuevoNombreCarrera = $_POST['NuevoNombreCarrera'];
        $NuevoSemestres = $_POST['NuevoSemestres'];
        $NuevoEdificio = $_POST['NuevoEdificio'];
        $NuevoSalon = $_POST['NuevoSalon'];

        $campos = [
            'NumerodeControl' => $NuevoNumeroControl,
            'NombredeCarrera' => $NuevoNombreCarrera,
            'Semestre' => $NuevoSemestres,
            'Edificio' => $NuevoEdificio,
            'Salon' => $NuevoSalon
        ];

        $resultado = agregarRegistro($conn, $tabla, $campos);
        // Lógica específica para la tabla grupo

    } elseif ($tabla === 'docentes') {
        $NuevoNumeroControl = $_POST['NuevoNumeroControl'];
        $NuevoNombreCarrera = $_POST['NuevoNombreCarrera'];
        $NuevoNombreDocente = $_POST['NuevoNombreDocente'];

        $campos = array(
            'NumerodeControl' => $NuevoNumeroControl,
            'Academia' => $NuevoNombreCarrera,
            'NombredelDocente' => $NuevoNombreDocente
        );

        $resultado = agregarRegistro($conn, $tabla, $campos);

    } elseif ($tabla === 'materias') {

        $NuevoNumeroControlAcademia = $_POST['NuevoNumeroControlAcademia'];
        $NuevoNumeroControl = $_POST['NuevoNumeroControl'];
        $NuevoNombreMateria = $_POST['NuevoNombreMateria'];
        $NuevoNumeroControlDocente = $_POST['NuevoNumeroControlDocente'];
        $NuevoUnidades = $_POST['NuevoUnidades'];
        
        $campos = array(
            'NumerodeControlAcademia' => $NuevoNumeroControlAcademia,
            'NumerodeControl' => $NuevoNumeroControl,
            'NombredelaMateria' => $NuevoNombreMateria,
            'NumerodeControlDocente' => $NuevoNumeroControlDocente,
            'Unidades' => $NuevoUnidades
        );

        $resultado = agregarRegistro($conn, $tabla, $campos);

    } elseif ($tabla === 'alumnos') {

        $tipo = $_POST["tipo"];

        $NuevoNumeroControl = $_POST['NuevoNumeroControl'];
        $NuevoNombreCarrera = $_POST['NuevoNombreCarrera'];
        $NuevoNombreAlumno = $_POST['NuevoNombreAlumno'];
        $NuevoNombreAnteproyecto = ($tipo === 'normal') ? null : $_POST['NuevoNombreAnteproyecto'];
        
        $campos = array(
            'NumerodeControl' => $NuevoNumeroControl,
            'Academia' => $NuevoNombreCarrera,
            'NombredelEstudiante' => $NuevoNombreAlumno,
            'NombredelAnteproyecto' => $NuevoNombreAnteproyecto,
        );
        
        $resultado = agregarRegistro($conn, $tabla, $campos);


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

