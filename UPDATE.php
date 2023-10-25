<?php
include 'databaseUPDATE.php';

$conn = conectarBaseDeDatos();

$resultado = ''; // Inicializa la variable de resultado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tabla = $_POST['tabla'];
    $tipo = $_POST["tipo"];
    

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

        if ($tipo === "residente") {
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
        
        } elseif ($tipo === "normal") {
            $NumerodeControl_Especial = trim($_POST['NumerodeControl_Especial']);
            $Academia_Especial = trim($_POST['Academia_Especial']);
            $NombredelEstudiante_Especial = trim($_POST['NombredelEstudiante_Especial']);
            $NombredelAnteproyecto_Especial = null;
              
            // Prepara una consulta SQL segura
            $sql = "UPDATE alumnos SET NumerodeControl=?, Academia=?, NombredelEstudiante=?, NombredelAnteproyecto=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $NumerodeControl_Especial, $Academia_Especial, $NombredelEstudiante_Especial, $NombredelAnteproyecto_Especial, $id);

            if ($stmt->execute()) {

                error_log("ID: " . $id); // Agregar esto para depurar
                error_log("NumerodeControl: " . $NumerodeControl); // Agregar esto para depurar
                error_log("Academia: " . $Academia); // Agregar esto para depurar
                error_log("NombredelEstudiante: " . $NombredelEstudiante); // Agregar esto para depurar

                $resultado = "La actualización se realizó con éxito.";

            } else {
                $resultado = "Error en la actualización: " . $stmt->error;
            }

            $stmt->close();
        }
        
        

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

