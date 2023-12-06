<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto (Vista Alumno)</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../css/estilo01_botones.css">
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
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            $id = $_SESSION['usuario'];
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
        <form style="padding-bottom: 70px;" action="../../Envio_fechas.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $_SESSION['usuario'] ?>">
        <?php
        echo '<button class="botonFec" >Reporte 1</button></form>';

    }
    if ($mostrar_reporte2) {
        ?>
        <form style="padding-bottom: 70px;" action="../../Envio_fechas2.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $_SESSION['usuario'] ?>">
        <?php
        echo '<button class="botonFec" >Reporte 2</button></form>';
    }
    if ($mostrar_reporte3) {
        ?>
        <form style="padding-bottom: 70px;" action="../../Envio_fechas3.php" method="post">
        <input type="hidden" name="ses" id="ses" value="<?php echo $_SESSION['usuario'] ?>">
        <?php
        echo '<button class="botonFec">Reporte 3</button></form>';
    }
    ?>
</div>
</div>

    <section style="margin-top: 70px;">
        <div class="container">
            <div class="col-sm-12">
                <h2 class="text-center">Anteproyecto </h2>
        
                <div class="btn_agregar">
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#agregar">Agregar</button>
                </div>

                <div class="container">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id alumno</th>
                                <th>Nombre</th>
                                <th>Nombre del proyecto</th>
                                <th>Empresa</th>
                                <th>Carrera</th>
                                <th>Archivo</th>
                                <th>Descargar</th>
                                <th>Ver PDF</th>
                                <th>Eliminar</th>
                                <th>Editar</th>
                                
                                
                                <?php
                                require_once "../../php/db.php";
                                $conexion = conectar();
                                        if(mysqli_query($conexion, "SELECT Alumno FROM asesorados WHERE Alumno='$id'")->num_rows>0){
                                    ?>
                                    <th>Ver Revisión</th>
                                    <?php
                                        }
                                    ?>
                                <th>Liberado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
            
                            $consulta = mysqli_query($conexion, "SELECT * FROM documento WHERE idalumno='$id' GROUP BY nombrealumno");

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
                                        <?php echo $fila['carrera']; ?>
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
                                    <button class="btn btn-danger btn-eliminar" data-id="<?php echo $fila['idalumno']; ?>">
                                        Eliminar
                                    </button>
                                    </td>
                                    <td>
                                    <a href="editar_registro.php">
                                        <button class="btn btn-warning btn-editar" data-id="<?php echo $fila['idalumno']; ?>">
                                            Editar
                                        </button>
                                    </td>
                                    <?php
                                        if(mysqli_query($conexion, "SELECT Alumno FROM asesorados WHERE Alumno='$id'")->num_rows>0){
                                    ?>
                                    <td>
                                        <?php
                                            $asesor = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT Asesor FROM asesorados WHERE Alumno='$id'"));
                                        ?>
                                        <a href="../../comunicacionDocenteAlumno.php?id=<?php echo $asesor['Asesor']; ?>" class="btn btn-danger">
                                            <i class="fas fa-message"></i> Ver revisión
                                        </a>
                                    </td>
                                    <?php
                                        }
                                    ?>
                                    <td>
                                        <?php
                                        if($fila['liberado']==1){
                                        ?>
                                        <div class="cuadro-verde">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-check" viewBox="0 0 16 16">
                                                <path d="M13.862 4.153a1.177 1.177 0 0 0-1.651.062l-6.699 7.17-2.573-2.862a1.2 1.2 0 0 0-1.762-.03 1.119 1.119 0 0 0-.032 1.514l3.333 3.666a1.177 1.177 0 0 0 1.648.031l7.83-8.375a1.118 1.118 0 0 0 .056-1.166z"/>
                                            </svg>
                                        </div>
                                        <?php
                                        } else {
                                        ?>
                                        <div class="cuadro-rojo">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1 0 .708L9.707 8l2.647 2.646a.5.5 0 0 1 0 .708l-1 1a.5.5 0 0 1-.708 0L8 8.707 5.354 11.354a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 0-.708L6.293 8 3.646 5.354a.5.5 0 0 1 0-.708l1-1z"/>
                                            </svg>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </td>


                                </tr>

                            <?php endwhile; ?>

                           
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <script>
    // Obtén todos los botones con la clase 'btn-eliminar'
    const botonesEliminar = document.querySelectorAll(".btn-eliminar");

    // Agrega un controlador de eventos clic a cada botón
    botonesEliminar.forEach(function (boton) {
        boton.addEventListener("click", function () {
            // Obtiene el valor del atributo 'data-id' del botón
            const idAlumno = boton.getAttribute("data-id");

            // Envía una solicitud al servidor para eliminar el registro
            fetch("eliminar_registro.php", {
                method: "POST",
                body: JSON.stringify({ id: idAlumno }),
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => {
                if (response.ok) {
                    // Registro eliminado exitosamente
                    // Puedes actualizar la interfaz o hacer lo que necesites
                    window.close();
                    const nuevaVentana = window.open("index(VISTA ALUMNO).php");
                    console.log("Registro eliminado correctamente");
                } else {
                    // Hubo un error al eliminar el registro
                    console.error("Error al eliminar el registro");
                }
            })
            .catch(error => {
                console.error("Error al realizar la solicitud: " + error);
            });
        });
    });
</script>


<?php include "agregar.php"; ?>

</html>