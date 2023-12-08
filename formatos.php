<?php
    session_start();
    $carrera=$_GET['carrera']??"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <title>Creación de formatos</title>
    <link rel="stylesheet" href="css/estilo5.css">
    <link rel="stylesheet" href="css/estilofromatos.css">
    <link rel="stylesheet" href="css/estiloBoton.css">
    <link rel="stylesheet" href="css/estiloModal.css"> <!-- Agrega el estilo del modal -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <link rel="stylesheet" href="css/estilo01_botones.css"
    <script src="js/scriptCarrera.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
require_once 'php/db.php';
$conn = conectar();

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

// Consultar las fechas de las tablas
$consulta1 = "SELECT fechaini, fechafin FROM fecharepotu1";
$consulta2 = "SELECT fechaini, fechafin FROM fecharepotu2";
$consulta3 = "SELECT fechaini, fechafin FROM fecharepotu3";

$resultado1 = mysqli_query($conn, $consulta1);
$resultado2 = mysqli_query($conn, $consulta2);
$resultado3 = mysqli_query($conn, $consulta3);

// Comprobar si la fecha actual está dentro del rango para cada botón
$mostrar_reporte1 = false;
$mostrar_reporte2 = false;
$mostrar_reporte3 = false;

if ($row1 = mysqli_fetch_assoc($resultado1)) {
    if ($fecha_actual >= $row1['fechaini'] && $fecha_actual <= $row1['fechafin']) {
        $mostrar_reporte1 = true;
    }
}

if ($row2 = mysqli_fetch_assoc($resultado2)) {
    if ($fecha_actual >= $row2['fechaini'] && $fecha_actual <= $row2['fechafin']) {
        $mostrar_reporte2 = true;
    }
}

if ($row3 = mysqli_fetch_assoc($resultado3)) {
    if ($fecha_actual >= $row3['fechaini'] && $fecha_actual <= $row3['fechafin']) {
        $mostrar_reporte3 = true;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
// Mostrar los botones en el div "barraLateral" si corresponde
?>
   
    <main class="d-flex">
    <div class="barraLateral fixed h-100">
<div style="padding-top: 80px;">
    <?php
    if ($mostrar_reporte1) {
        ?>
        <form style="padding-bottom: 70px;" action="Envio_fechasTutoras_A1.php" method="post">
            <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec">Reporte 1</button></form>';
    }
    if ($mostrar_reporte2) {
        ?>
        <form style="padding-bottom: 70px;" action="Envio_fechasTutoras_A2.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec"">Reporte 2</button></form>';
    }
    if ($mostrar_reporte3) {
        ?>
        <form style="padding-bottom: 70px;" action="Envio_fechasTutoras_A3.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec"">Reporte 3</button></form>';
    }
    ?>
</div>
</div>
    </main>

    <header class="fixed w-100">
    <div class="usuarioOp d-flex justify-content-end">
        <img src="img/profile.png" alt="" >
        <?php
                $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
                echo '<p>' . $nombre . '</p>';
                ?>
                <div class="dropdown-content">
                    <a href="/loginTutorias.php">Cerrar sesión</a>
        </div>
    </header>
        <a class="beautiful-button7" href="FichaTecnica.php">Ficha técnica</a>
        <a href="Formato_canalizacion/FormatoEncuestaIni.php" class="beautiful-button8">Diagnóstico original</a>
        <!--<a class="beautiful-button9">Evaluacion al docente</a>-->
        <a class="beautiful-button9" href="AsistenciasTut.php">Lista de asistencia</a>
        <a  class="beautiful-button10" href="pagInfoRes.php">Informe de resultados</a>
        <a href="Formato_canalizacion/F_Canal.php" class="beautiful-button3">Formato de canalización</a>
        <a class="beautiful-button4" href="pagEvaAl.php">Evaluación al alumno</a>
        <a class="beautiful-button5" href="informeParcial.php">Informe parcial</a>        
        <a href="hoja de vida/hv2.php"class="beautiful-button6">Hoja de vida</a>
        <a href="FormularioCopia.php" class="beautiful-button">Plan de acción</a>
        <!--<a class="beautiful-button2">Retícula</a>-->

    </main>
</body>
</html>