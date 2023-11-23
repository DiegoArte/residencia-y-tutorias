<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto (Asesor)</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/estilo01_botones.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Anteproyecto.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <br>

    <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
            <img src="profile.png" alt="">
            <?php
            session_start();
            $id = $_SESSION['usuario'];
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="../../logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <?php
require_once '../../php/db.php';
$conn = conectar();

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

// Consultar las fechas de las tablas
$consulta1 = "SELECT fechaini, fechafin FROM fecharepo1";
$consulta2 = "SELECT fechaini, fechafin FROM fecharepo2";
$consulta3 = "SELECT fechaini, fechafin FROM fecharepo3";

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
<div class="barraLateral fixed h-100">
<div style="padding-top: 80px;">
    <?php
    if ($mostrar_reporte1) {
        ?>
        <form style="padding-bottom: 70px;" action="../../Envio_fechasT_A.php" method="post">
            <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec">Reporte 1</button></form>';
    }
    if ($mostrar_reporte2) {
        ?>
        <form style="padding-bottom: 70px;" action="../../Envio_fechasT_A2.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec"">Reporte 2</button></form>';
    }
    if ($mostrar_reporte3) {
        ?>
        <form style="padding-bottom: 70px;" action="../../Envio_fechasT_A3.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $id; ?>">
        <?php
        echo '<button class="botonFec"">Reporte 3</button></form>';
    }
    ?>
</div>
</div>

    <section style="margin-top: 70px;">


        <div class="container">
            <div class="col-sm-12">
                <h2 class="text-center">Anteproyecto</h2>



                <div class="container">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id Alumno</th>
                                <th>Nombre</th>
                                <th>Nombre del proyecto</th>
                                <th>Empresa</th>
                                <th>Archivo</th>
                                <th>Descargar</th>
                                <th>Ver PDF</th>
                                <th>Responder</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "../includes/db.php";
                            $consulta = mysqli_query($conexion, "SELECT * FROM documento WHERE idalumno IN(SELECT Alumno FROM asesorados WHERE Asesor='$id')");
                            while ($fila = mysqli_fetch_assoc($consulta)):
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $fila['idalumno']; ?>
                                    </td>
                                    <td>
                                        <?php echo $fila['nombrealumno']; ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $fila['nombreproyecto']; ?>
                                    </td>
                                    <td>
                                        <?php echo $fila['empresa']; ?>
                                    </td>
                                    <td>
                                        <?php echo $fila['archivo']; ?>
                                    </td>
                                    <td>
                                        <a href="../includes/download.php?id=<?php echo $fila['idalumno']; ?>"
                                            class="btn btn-primary">
                                            <i class="fas fa-download"></i> Descargar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="../includes/files/<?php echo $fila['archivo']; ?>"
                                            class="btn btn-secondary" target="_blank">
                                            Ver PDF
                                        </a>
                                    </td>
                                    <td>
                                        <a href="../../comunicacionDocenteAlumno.php?id=<?php echo $fila['idalumno']; ?>" class="btn btn-danger">
                                            <i class="fas fa-message"></i> Responder
                                        </a>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                </div>
            </div>

</body>


</html>