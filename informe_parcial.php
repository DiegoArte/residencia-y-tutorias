<?php
session_start();
require 'php/app.php';
require 'php/Materias.php';
require 'php/Alumno_materia.php';
require 'php/Informe_parcial.php';

function enteroARomano($numero) {
    $valores = array(
        1000 => 'M',
        900  => 'CM',
        500  => 'D',
        400  => 'CD',
        100  => 'C',
        90   => 'XC',
        50   => 'L',
        40   => 'XL',
        10   => 'X',
        9    => 'IX',
        5    => 'V',
        4    => 'IV',
        1    => 'I'
    );

    $resultado = '';

    foreach ($valores as $valor => $romano) {
        while ($numero >= $valor) {
            $resultado .= $romano;
            $numero -= $valor;
        }
    }

    return $resultado;
}

if($_SERVER['REQUEST_METHOD']==='POST') {
    $asignatura=$_POST['asignatura'];
    $group=$_POST['grupo'];
    $filas=InformeParcial::countFills("asignatura='$asignatura' and grupo='$group'");
    if($filas==0){
        $informe=new InformeParcial($_POST);
        $informe->crear();
    } else {
        $informe=new InformeParcial($_POST);
        $informe->actualizar("asignatura='$asignatura' and grupo='$group'");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">      
    <title>Formulario informe parcial</title><!-- Agrega el estilo del modal -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <link rel="stylesheet" href="css/informe_parcial.css">
    <script src="js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <!-- RAYAS DE ARRIBA,IZ -->
    <header class="fixed w-100">
    <a href="formatos.php" class="back-arrow rounded-pill d-flex justify-content-start">
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
        <div class="barraLateral h-100"></div>
        <div class="tasks">
            <?php
            $numero_control=$_SESSION['usuario'];
            $grupo=mysqli_fetch_assoc(mysqli_query($db, "SELECT Grupo FROM tabla_tutorados WHERE Tutor='$numero_control'"));
            $grupito=$grupo['Grupo'];
            $materias=Materias::find("NumerodeControl IN(SELECT idmateria from alumno_materia WHERE idalumno IN(SELECT NumeroDeControl from alumnosnormales WHERE Numerocontrolgrupo='$grupito'))");
            foreach($materias as $materia) { 
            ?>
            <form  method="POST" action="">
                <?php
                $materiaNum=$materia->NumerodeControl;
                ?>
                <input type="hidden" name="asignatura" value="<?php echo $materiaNum ?>">
                <table>
                    <thead>
                        <tr>
                            <th><?php echo $materia->NombredelaMateria ?></th>
                            <?php
                            for($i=1; $i<=$materia->Unidades; $i++){
                                $unidad=enteroARomano($i);
                                ?>
                                <th colspan="2"><?php echo $unidad ?></th>
                                <?php
                            } 
                            for($i=$materia->Unidades; $i<6; $i++){
                                ?>
                                <th colspan="2"></th>
                                <?php
                            } 
                            ?>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Datos solicitados</th>
                            <?php
                            for($i=1; $i<=6; $i++){
                                ?>
                                <th colspan="2">No R</th>
                                <?php
                            } 
                            ?>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="<?php echo "tabla".$materia->NumerodeControl; ?>">
                        <tr>
                            <td>Datos</td>
                            <?php
                            for($i=1; $i<=6; $i++){
                                $unidad=enteroARomano($i);
                                ?>
                                <td colspan="2">
                                    <input type="text" name="<?php echo "numReprobados".$unidad ?>">
                                </td>
                                <?php
                            } 
                            ?>
                            <th>Núm. De Estudiantes</th>
                        </tr>
                        <tr>
                            <td>Promedio aprobados</td>
                            <?php
                            for($i=1; $i<=6; $i++){
                                $unidad=enteroARomano($i);
                                ?>
                                <td colspan="2">
                                    <input type="text" name="<?php echo "aprobados".$unidad ?>">
                                </td>
                                <?php
                            } 
                            ?>
                            <td colspan="2">
                                <?php
                                $estudiantes=AlumnoMateria::countFills("idmateria='$materiaNum' AND idalumno IN(SELECT NumeroDeControl FROM alumnosnormales WHERE Numerocontrolgrupo='$grupito')");
                                ?>
                                <input type="text" name="estudiantes" value="<?php echo $estudiantes; ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="14">Listado de estudiantes reprobados en el período</th>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th colspan="4">Número de control</th>
                            <th colspan="8">Nombre completo del estudiante</th>
                            <th>Unidad(es)</th>
                        </tr>
                        
                    </tbody>
                </table>
                <input type="hidden" name="grupo" value="<?php echo $grupo['Grupo']; ?>">
                <input type="hidden" name="docente" value="<?php echo $numero_control; ?>">
                <input type="submit" value="Enviar">
                <button class="agregar" onclick="agregarColumna('<?php echo "tabla".$materia->NumerodeControl; ?>', event)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </button>
                
            </form>
            <?php
            }
            ?>
            <a class="gen_boton" href="informe parcial/formato.php">Generar formato</a>
        </div>
    </main>
    <script src="js/informe_parcial.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

