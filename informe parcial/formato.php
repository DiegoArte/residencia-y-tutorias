<?php
session_start();
ob_start();
require '../php/app.php';
require '../php/Materias.php';
require '../php/Alumno_materia.php';
require '../php/Calificaciones.php';
require '../php/Alumnosnormales.php';
require '../php/Docentes.php';

$numero_control=$_SESSION['usuario'];
$grupo=mysqli_fetch_assoc(mysqli_query($db, "SELECT Grupo FROM tabla_tutorados WHERE Tutor='$numero_control'"));
$grupito=$grupo['Grupo'];
$nombre = $_SESSION['nombre'];
$academia = $_SESSION['academia'];
$noEstudiantes=Alumnosnormales::countFills("Numerocontrolgrupo='$grupito'");

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html {
            box-sizing: border-box;
        }
        *, *:before, *:after {
            box-sizing: inherit;
        }

        body {
            font-family: 'Open Sans', sans-serif;
        }


        h1 {
            font-size: 5.5rem;
        }

        h2 {
            font-size: 3.5rem;
        }

        h3 {
            font-size: 2.5rem;
        }

        h4 {
            font-size: 0.8rem;
            white-space: pre-wrap;
        }

        p, table {
            font-size: 0.7rem;
        }

        span {
            font-weight: normal;
        }

        .contenedor {
            max-width: 80rem;
            margin: 0 auto;
        }

        .header {
            height: 130px;
        }

        .datos {
            margin-left: 10px;
        }

        .seg {
            text-align: center;
            margin-top: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid black; /* Puedes ajustar el ancho y color del borde según tus preferencias */
            padding: 8px; /* Añade un espacio interno para mejorar la apariencia */
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <header>
    <?php
        // Leer la imagen como datos binarios
        $imagePath = 'img/header.png';
        $imageData = file_get_contents($imagePath);

        // Convertir los datos binarios a formato base64
        $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
        ?>
        <img src="<?php echo $base64Image; ?>" alt="" class="header">
    </header>
    <main>
        <div class="datos">
            <h4>TUTOR(A): <span><?php echo $nombre; ?></span> <?php echo "                                                                                   "; ?> FECHA: <span><?php echo date("Y-m-d"); ?></span></h4>
        </div>
        <div class="datos">
            <h4>PLAN DE ESTUDIO: <span><?php echo $academia; ?></span> <?php echo "                           "; ?> NO. DE ESTUDIANTES: <span><?php echo $noEstudiantes; ?></span></h4>
        </div>
        <h4 class="seg">SEGUIMIENTO ACADÉMICO</h4>
        <p>Reprobación</p>
        <?php
        $materias=Materias::find("NumerodeControl IN(SELECT idmateria from alumno_materia WHERE idalumno IN(SELECT NumeroDeControl from alumnosnormales WHERE Numerocontrolgrupo='$grupito'))");
        foreach($materias as $materia) { 
        ?>
        <?php
        $materiaNum=$materia->NumerodeControl;
        ?>
        <table>
            <thead>
                <tr>
                    <th colspan="2"><?php echo $materia->NombredelaMateria; ?></th>
                    <th colspan="2">I</th>
                    <th colspan="2">II</th>
                    <th colspan="2">III</th>
                    <th colspan="2">IV</th>
                    <th colspan="2">V</th>
                    <th colspan="2">VI</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th colspan="2">Datos solicitados</th>
                    <th>No R</th>
                    <th>% R</th>
                    <th>No R</th>
                    <th>% R</th>
                    <th>No R</th>
                    <th>% R</th>
                    <th>No R</th>
                    <th>% R</th>
                    <th>No R</th>
                    <th>% R</th>
                    <th>No R</th>
                    <th>% R</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <td colspan="2">Datos</td>
                    <?php
                    $estudiantes=AlumnoMateria::countFills("idmateria='$materiaNum' AND idalumno IN(SELECT NumeroDeControl FROM alumnosnormales WHERE Numerocontrolgrupo='$grupito')");
                    for($i=1; $i<=6; $i++){
                        $unidad=enteroARomano($i);
                        $reprobados=Calificaciones::countFills("materia='$materiaNum' and grupo='$grupito' and unidad".$unidad."='NA'");
                        $porcentaje=$reprobados/$estudiantes*100;
                        ?>
                        <td><?php echo $reprobados; ?></td>
                        <td><?php echo round($porcentaje, 2)."%"; ?></td>|
                        <?php
                    } 
                    ?>
                    <th colspan="2">Núm. De Estudiantes</th>
                </tr>
                <tr>
                    <td colspan="2">Promedio aprobados</td>
                    <?php
                    for($i=1; $i<=6; $i++){
                        $unidad=enteroARomano($i);
                        $reprobados=Calificaciones::countFills("materia='$materiaNum' and grupo='$grupito' and unidad".$unidad."='NA'");
                        $porcentaje=$reprobados/$estudiantes*100;
                        $aprobados=100-$porcentaje;
                        ?>
                        <td colspan="2"><?php echo round($aprobados, 2)."%"; ?></td>
                        <?php
                    } 
                    ?>
                    <td colspan="2"><?php echo $estudiantes; ?></td>
                </tr>
                <tr>
                    <th colspan="16">Listado de estudiantes reprobados en el período</th>
                </tr>
                <tr>
                    <th colspan="2">No.</th>
                    <th colspan="4">Número de control</th>
                    <th colspan="8">Nombre completo del estudiante</th>
                    <th colspan="2">Unidad(es)</th>
                </tr>
                <?php
                $claRebrobadas=Calificaciones::find("materia='$materiaNum' and grupo='$grupito' and (unidadI='NA' or unidadII='NA' or unidadIII='NA' or unidadIV='NA' or unidadV='NA' or unidadVI='NA')");
                $no=1;
                foreach($claRebrobadas as $cal) {
                    $alumnoCal=$cal->alumno;
                    $alumno=Alumnosnormales::find("NumeroDeControl='$alumnoCal'");
                    $alumno=$alumno[0];
                    $unidades='';
                    for($i=1; $i<=6; $i++){
                        $unidad=enteroARomano($i);
                        $unity = 'unidad' . $unidad;
                        if($cal->$unity=='NA'){
                            $unidades=$unidades.$unidad.', ';
                        }
                    } 
                    ?>
                    <tr>
                        <td colspan="2"><?php echo $no; ?></td>
                        <td colspan="4"><?php echo $alumno->NumeroDeControl; ?></td>
                        <td colspan="8"><?php echo $alumno->NombreDelEstudiante; ?></td>
                        <td colspan="2"><?php echo $unidades; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
    <table>
        <tbody>
            <tr>
                <td>Acciones Grupales para disminuir reprobación.</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <h4>NOTA: <span>No R: Número de estudiantes Reprobados; % R: Porcentaje de estudiantes reprobados(as).</span></h4>
    <h4>Deserción</h4>
    <table>
        <tbody>
            <tr>
                <td>Deserción</td>
                <td>No. De estudiantes
                _______
                Porcentaje
                _________
                </td>
                <td>Causas de deserción:</td>
            </tr>
        </tbody>
    </table>
    <h4 class="seg">TUTOR(A):</h4>
    <table>
        <tbody>
            <tr>
                <th>NOMBRE</th>
                <th>FIRMA</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<?php
$html=ob_get_clean();
require_once('../dompdf_2-0-3/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf=new Dompdf();

$options=$dompdf->getOptions();
$options->set(array('isHtml5ParserEnabled' => true, 'isPhpEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('letter');

$dompdf->render();

$dompdf->stream("informe_parcial.pdf", array("Attachment"=>false));
?>