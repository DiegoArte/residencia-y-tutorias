<?php
include 'databaseUPDATE.php';

$conn = conectarBaseDeDatos();

$resultado = ''; // Inicializa la variable de resultado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    function nombreCarreraExiste($conn, $NuevoNombreCarrera) {
        $sql = "SELECT * FROM carrera WHERE NombredeCarrera = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $NuevoNombreCarrera);
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
        $NuevoNumeroControlAcademia = trim($_POST['NuevoNumeroControlAcademia']);
        $NuevoNombreCarrera = trim($_POST['NuevoNombreCarrera']);
        $NuevoSemestres = trim($_POST['NuevoSemestres']);

            // Verificar si el número de control ya existe
        if (numeroControlExisteChido($conn, $NuevoNumeroControlAcademia, $tabla)) {
            $resultado = "El número de control ya existe en el sistema.";
            
        } else {

            $campos = array(
                'NumerodeControl' => $NuevoNumeroControlAcademia,
                'NombredeCarrera' => $NuevoNombreCarrera,
                'NumerodeSemestres' => $NuevoSemestres
            );

            $resultado = agregarRegistro($conn, $tabla, $campos);
        }
        // Lógica específica para la tabla carrera
    } elseif ($tabla === 'grupos') {
        $NuevoNumeroControl = trim($_POST['NuevoNumeroControl']);
        $NuevoNombreCarrera = trim($_POST['NuevoNombreCarrera']);
        $NuevoSemestres = trim($_POST['NuevoSemestres']);
        $NuevoEdificio = trim($_POST['NuevoEdificio']);
        $NuevoSalon = trim($_POST['NuevoSalon']);

        // Verificar si el número de control ya existe
        if (numeroControlExisteChido($conn, $NuevoNumeroControl, $tabla)) {
            $resultado = "El número de control ya existe en el sistema.";
        } else {
            if (!nombreCarreraExiste($conn, $NuevoNombreCarrera)) {
                $resultado = "El nombre de la carrera no existe en el sistema.";
            } else {
                // Si el número de control no existe y el nombre de la carrera existe, entonces agrega el registro.S
                $campos = array(
                    'NumerodeControl' => $NuevoNumeroControl,
                    'NombredeCarrera' => $NuevoNombreCarrera,
                    'Semestre' => $NuevoSemestres,
                    'Edificio' => $NuevoEdificio,
                    'Salon' => $NuevoSalon
                );
        
                $resultado = agregarRegistro($conn, $tabla, $campos);
            }
        }
        // Lógica específica para la tabla grupo

    } elseif ($tabla === 'docentes') {
        $NuevoNumeroControl = trim($_POST['NuevoNumeroControl']);
        $NuevoNombreCarrera = trim($_POST['NuevoNombreCarrera']);
        $NuevoNombreDocente = trim($_POST['NuevoNombreDocente']);
        $NuevoCorreo = trim($_POST['NuevoCorreo']);


        // Verificar si el número de control ya existe
        if (numeroControlExisteChido($conn, $NuevoNumeroControl, $tabla)) {
            $resultado = "El número de control ya existe en el sistema.";
            
        } else {
            if (!nombreCarreraExiste($conn, $NuevoNombreCarrera)) {
                $resultado = "El nombre de la carrera no existe en el sistema.";
            } else {
                $campos = array(
                    'NumerodeControl' => $NuevoNumeroControl,
                    'Academia' => $NuevoNombreCarrera,
                    'NombredelDocente' => $NuevoNombreDocente,
                    'Asesor'=>0,
                    'Presidente'=>0,
                    'Secretaria'=>0,
                    'correo' => $NuevoCorreo

                );

                $resultado = agregarRegistro($conn, $tabla, $campos);
            }
        }

    } elseif ($tabla === 'materias') {

        $NuevoNumeroControlAcademia = trim($_POST['NuevoNumeroControlAcademia']);
        $NuevoNumeroControl = trim($_POST['NuevoNumeroControl']);
        $NuevoNombreMateria = trim($_POST['NuevoNombreMateria']);
        $NuevoNumeroControlDocente = trim($_POST['NuevoNumeroControlDocente']);
        $NuevoUnidades = trim($_POST['NuevoUnidades']);
        
        // Verificar si el número de control ya existe
        if (numeroControlExisteChido($conn, $NuevoNumeroControl, $tabla)) {
            $resultado = "El número de control ya existe en el sistema.";
            
        } else {
            if (ControlCarreraExiste($conn, $NuevoNumeroControlAcademia)) {
                $resultado = "El numero de de la carrera no existe en el sistemaA.";
            } else {

                $campos = array(
                    'NumerodeControlAcademia' => $NuevoNumeroControlAcademia,
                    'NumerodeControl' => $NuevoNumeroControl,
                    'NombredelaMateria' => $NuevoNombreMateria,
                    'NumerodeControlDocente' => $NuevoNumeroControlDocente,
                    'Unidades' => $NuevoUnidades
                );

                $resultado = agregarRegistro($conn, $tabla, $campos);
            }
        }

    } elseif ($tabla === 'alumnos') {

        $NuevoNumeroControl = trim($_POST['NuevoNumeroControl']);
        $NuevoNombreCarrera = trim($_POST['NuevoNombreCarrera']);
        $NuevoNombreAlumno = trim($_POST['NuevoNombreAlumno']);
        $NuevoNombreAnteproyecto = trim($_POST['NuevoNombreAnteproyecto']);
        $NuevoCorreo = trim($_POST['NuevoCorreo']);


        // Verificar si el número de control ya existe
        if (numeroControlExisteChido($conn, $NuevoNumeroControl, $tabla)) {
            $resultado = "El número de control ya existe en el sistema.";
            
        } else {
            if (!nombreCarreraExiste($conn, $NuevoNombreCarrera)) {
                $resultado = "El nombre de la carrera no existe en el sistema.";
            } else {
                $campos = array(
                    'NumerodeControl' => $NuevoNumeroControl,
                    'Academia' => $NuevoNombreCarrera,
                    'NombredelEstudiante' => $NuevoNombreAlumno,
                    'NombredelAnteproyecto' => $NuevoNombreAnteproyecto,
                    'correo' => $NuevoCorreo,
                );
                
                $resultado = agregarRegistro($conn, $tabla, $campos);
            
                }
            }

    } elseif ($tabla === "alumnosnormales"){
        $NuevoNumeroControlNormal = trim($_POST['NuevoNumeroControlNormal']);
        $NuevoNombreCarreraNormal = trim($_POST['NuevoNombreCarreraNormal']);
        $NuevoNombreAlumnoNormal = trim($_POST['NuevoNombreAlumnoNormal']);
        
    // Verificar si el número de control ya existe
    if (numeroControlExiste($conn, $NuevoNumeroControlNormal, $tabla)) {
        $resultado = "El número de control ya existe en el sistema.";
        
    } else {

        if (!nombreCarreraExiste($conn, $NuevoNombreCarrera)) {
            $resultado = "El nombre de la carrera no existe en el sistema.";
        } else {

            $campos = array(
                'NumeroDeControl' => $NuevoNumeroControlNormal,
                'Academia' => $NuevoNombreCarreraNormal,
                'NombreDelEstudiante' => $NuevoNombreAlumnoNormal,
            );

            $resultado = agregarRegistro($conn, $tabla, $campos);
        }
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