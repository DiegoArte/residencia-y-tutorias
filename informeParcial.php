<?php
session_start();
require 'php/app.php';
require 'php/Materias.php';
require 'php/Alumno_materia.php';
require 'php/Calificaciones.php';
require 'php/Alumnosnormales.php';

$numero_control=$_SESSION['usuario'];
$grupo=mysqli_fetch_assoc(mysqli_query($db, "SELECT Grupo FROM tabla_tutorados WHERE Tutor='$numero_control'"));
$grupito=$grupo['Grupo'];
$cal=AlumnoMateria::countFills("idalumno IN(SELECT NumeroDeControl FROM alumnosnormales WHERE Numerocontrolgrupo='$grupito')");

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
    if(((intval($_POST['unidadI'])>=0 && intval($_POST['unidadI'])<=100) || $_POST['unidadI']=='NA' || $_POST['unidadI']=='') && ((intval($_POST['unidadII'])>=0 && intval($_POST['unidadII'])<=100) || $_POST['unidadII']=='NA' || $_POST['unidadII']=='') && ((intval($_POST['unidadIII'])>=0 && intval($_POST['unidadIII'])<=100) || $_POST['unidadIII']=='NA' || $_POST['unidadIII']=='') && ((intval($_POST['unidadIV'])>=0 && intval($_POST['unidadIV'])<=100) || $_POST['unidadIV']=='NA' || $_POST['unidadIV']=='') && ((intval($_POST['unidadV'])>=0 && intval($_POST['unidadV'])<=100) || $_POST['unidadV']=='NA' || $_POST['unidadV']=='') && ((intval($_POST['unidadVI'])>=0 && intval($_POST['unidadVI'])<=100) || $_POST['unidadVI']=='NA' || $_POST['unidadVI']=='')){
        $alumn=$_POST['alumno'];
        $asignatura=$_POST['materia'];
        $filas=Calificaciones::countFills("alumno='$alumn' and materia='$asignatura'");
        if($filas==0){
            $informe=new Calificaciones($_POST);
            $informe->crear();
        } else {
            $informe=new Calificaciones($_POST);
            $informe->actualizar("alumno='$alumn'");
        }
    } else {
        echo '<script>alert("Error: Al menos una de las calificaciones no está en un formato correcto");</script>';
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
    <?php
    $calSubidas=Calificaciones::countFills("grupo='$grupito' and docente='$numero_control'");
    ?>
    <a href="<?php if($calSubidas==$cal){echo "informe parcial/formato.php";}else{echo "informe parcial/error.html";} ?>" class="boton2">Generar formato</a>
    <a href="" class="boton3">Asignar materias</a>
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
            $materias=Materias::find("NumerodeControl IN(SELECT idmateria from alumno_materia WHERE idalumno IN(SELECT NumeroDeControl from alumnosnormales WHERE Numerocontrolgrupo='$grupito'))");
            foreach($materias as $materia) { 
                $materiaNum=$materia->NumerodeControl;
            ?>
            <h3><?php echo $materia->NombredelaMateria ?></h2>
            <table>
                <thead>
                    <tr>
                        <th class="al">Alumnos</th>
                        <th>Unidad I</th>
                        <th>Unidad II</th>
                        <th>Unidad III</th>
                        <th>Unidad IV</th>
                        <th>Unidad V</th>
                        <th>Unidad VI</th>
                        <th>Guardar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $alumnos=Alumnosnormales::find("NumeroDeControl IN(SELECT idalumno FROM alumno_materia WHERE idmateria='$materiaNum')");
                foreach($alumnos as $alumno) {
                    $cal++;
                ?>
                
                <form  method="POST" action="">
                    <input type="hidden" name="alumno" value="<?php echo $alumno->NumeroDeControl ?>">
                    <input type="hidden" name="materia" value="<?php echo $materiaNum ?>">
                    
                    <tr>
                        <td class="al"><?php echo $alumno->NombreDelEstudiante ?></td>
                        <?php
                        for($i=1; $i<=6; $i++){
                            $unidad=enteroARomano($i);
                            ?>
                            <td>
                                <input type="text" name="<?php echo "unidad".$unidad ?>">
                            </td>
                            <?php
                        }  
                        ?>
                        <input type="hidden" name="grupo" value="<?php echo $grupo['Grupo']; ?>">
                        <input type="hidden" name="docente" value="<?php echo $numero_control; ?>">
                        <td><input type="submit" value="Guardar"></td>
                    </tr>
                        
                </form>
                <?php
                }
                ?>
                </tbody>
                
            </table>
            <?php
            }
            ?>
        </div>
    </main>
    <script src="js/informe_parcial.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

