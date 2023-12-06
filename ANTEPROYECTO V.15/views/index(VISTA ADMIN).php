<?php
session_start();
$carrera = $_GET['carrera'] ?? "";

require_once "../includes/db.php";
if(isset($_GET['carrera']) && !empty($_GET['carrera'])) {
    $carreraSeleccionada = $_GET['carrera'];
    // Agrega el filtro por carrera a la consulta
    $consulta = mysqli_query($conexion, "SELECT * FROM documento WHERE carrera = '$carreraSeleccionada'");
} else {
    // Si no se selecciona ninguna carrera, muestra todos los resultados
    $consulta = mysqli_query($conexion, "SELECT * FROM documento");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto (Admin)</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Anteproyecto.css"><!-- Agrega el estilo del modal -->
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/comunicacionDocenteAlumno.css">



    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <style>
        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Estilos para el botón "Asesorados Registrados" */
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <br>

    <header class="fixed w-100">
        <a href="../../princi_Super_Admin.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="../../img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
        </a>
        <div class="usuarioOp d-flex justify-content-end">
            <img src="profile.png" alt="">
            <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombrealumno
            echo '<p>'.$nombre.'</p>';
            ?>
            <div class="dropdown-content">
                <a href="../../../logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
        <section style="margin-top: 70px;">


            <?php
            require_once "../includes/db.php";

            // Realiza la consulta para obtener las carreras disponibles
            $carrerasConsulta = mysqli_query($conexion, "SELECT DISTINCT carrera FROM documento");

            // Almacena las carreras en un array
            $carreras = array();
            while($fila = mysqli_fetch_assoc($carrerasConsulta)) {
                $carreras[] = $fila['carrera'];
            }
            ?>


            <div class="container">
                <div class="col-sm-12">
                    <h2 class="text-center">Anteproyecto</h2>
                    <form method="GET">
                        <label for="carrera">Selecciona una carrera:</label>
                        <select name="carrera" id="carrera">
                            <option value="">Todas las carreras</option>
                            <?php
                            // Itera sobre las carreras para crear las opciones del menú desplegable
                            foreach($carreras as $carrera) {
                                echo "<option value='".$carrera."'>".$carrera."</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" value="Filtrar">
                    </form>


                    <button onclick="window.location.href = 'asesorados_registrados.php'">Asesorados
                        Registrados</button>


                    <div class="container">
                        <table class="table table-bordered" idalumno="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id Alumno</th>
                                    <th>Nombre</th>
                                    <th>Nombre del proyecto</th>
                                    <th>Empresa</th>
                                    <th>Archivo</th>
                                    <th>Descargar</th>
                                    <th>Ver PDF</th>
                                    <th>Liberado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once "../includes/db.php";
                                $consulta = mysqli_query($conexion, "SELECT * FROM documento");

                                while($fila = mysqli_fetch_assoc($consulta)):
                                    if(!empty($fila['archivo'])) {
                                        // Solo mostrar la fila si el campo 'archivo' no está vacío
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
                                                <a href="../includes/download.php?idalumno=<?php echo $fila['idalumno']; ?>"
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
                                                <?php
                                                if($fila['liberado'] == 1) {
                                                    ?>
                                                    <div class="cuadro-verde">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                                                            class="bi bi-check" viewBox="0 0 16 16">
                                                            <path
                                                                d="M13.862 4.153a1.177 1.177 0 0 0-1.651.062l-6.699 7.17-2.573-2.862a1.2 1.2 0 0 0-1.762-.03 1.119 1.119 0 0 0-.032 1.514l3.333 3.666a1.177 1.177 0 0 0 1.648.031l7.83-8.375a1.118 1.118 0 0 0 .056-1.166z" />
                                                        </svg>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="cuadro-rojo">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1 0 .708L9.707 8l2.647 2.646a.5.5 0 0 1 0 .708l-1 1a.5.5 0 0 1-.708 0L8 8.707 5.354 11.354a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 0-.708L6.293 8 3.646 5.354a.5.5 0 0 1 0-.708l1-1z" />
                                                        </svg>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

</body>

</html>