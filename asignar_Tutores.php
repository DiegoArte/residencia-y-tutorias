<?php

use Svg\Tag\Group;

session_start();
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/asignar_Tutores.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/estilo01_botones.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">


    <title>Asignar tutores</title>

</head>

<body>

<?php
require 'php/app.php';
$conn = $db;

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

// Mostrar los botones en el div "barraLateral" si corresponde
?>
<div class="barraLateral fixed h-100">
<div style="padding-top: 80px;">
    <?php
    if ($mostrar_reporte1) {
        ?>
        <form style="padding-bottom: 70px;" action="Envio_fechasT_AEncargado_tutorias.php" method="post">
            <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec">Reporte 1</button></form>';
    }
    if ($mostrar_reporte2) {
        ?>
        <form style="padding-bottom: 70px;" action="Envio_fechasT_AEncargado_tutorias2.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec"">Reporte 2</button></form>';
    }
    if ($mostrar_reporte3) {
        ?>
        <form style="padding-bottom: 70px;" action="Envio_fechasT_AEncargado_tutorias3.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec"">Reporte 3</button></form>';
    }
    ?>
     <a style="padding: top 80px;" class="botonFec" href="indices/Tabla_mostrar.php">Generar indices</a>
    
</div>
</div>

<header class="fixed w-100">
<div class="usuarioOp d-flex justify-content-end">
    <img src="img/profile.png" alt="" >
    <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>
    </div>
</header>


<?php

require 'php/Grupos.php';
require 'php/Docentes.php';
require 'php/Tutorados.php';

// Mostrar el formulario de selección de nombre
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result_alum = Grupos::find("NumerodeControl NOT IN (SELECT Grupo FROM tabla_tutorados)");
    $result_doc = Docentes::all();
    ?>

    <h4 id='alum'>Grupos</h4>
    <form action='php/guardar_asigado.php' method='POST'>
    <select id='alumnos' name='Lista1'>
    <?php
    foreach($result_alum as $row) {
    ?>
        <option value='<?php echo $row->NumerodeControl; ?>'> <?php echo $row->NombredeCarrera." ".$row->Semestre; ?></option>
    <?php
    }?>
    </select>

    <h4 id='asig'>Asignar a:</h4>
    
    <h4 id='doc'>Docentes</h4>
    <select id='docentes' name='Lista2'>
    <?php
    foreach($result_doc as $row) {
        ?>
        <option value='<?php echo $row->NumerodeControl; ?>'> <?php echo $row->NombredelDocente; ?></option>
    <?php
    }?>
    </select>

    <input type='submit' class='enviar' value='Asignar'>
    "</form>
    <?php
    // Consulta SQL para obtener los datos de la tabla asesorados
    $result_asesorados = Tutorados::all();
    ?>
    <table>
        <thead>
            <tr>
                <th>Grupos</th>
                <th>Tutores</th>
                <th></th>
            </tr>   
        </thead>

        <tbody> 
    <?php
    foreach($result_asesorados as $row) {
        ?>
            <tr>
                <?php
                $rowgru = Grupos::find("NumerodeControl='$row->Grupo'");
                $rowdoc = Docentes::find("NumerodeControl='$row->Tutor'");
                ?>
                <td><?php echo $rowgru[0]->NombredeCarrera." ".$rowgru[0]->Semestre; ?></td>
                <td><?php echo $rowdoc[0]->NombredelDocente; ?></td>
                <td>
                    <form action='php/eliminar_registro.php' method='POST'>
                        <input type='hidden' name='alumno' value='<?php echo $row->Grupo; ?>'>
                        <input type='hidden' name='asesor' value='<?php echo $row->Tutor; ?>'>
                        <input type='submit' name='eliminar' value='Eliminar'>
                    </form>
                </td>
            </tr>
        <?php
    }
        ?>

        </tbody>
    </table>
    <?php
}

?>


</body>

</html>