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
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="../../../logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>


    <div class="barraLateral fixed h-100">
        <a href="#"></a>
    </div>
    <section style="margin-top: 70px;">


        <div class="container">
            <div class="col-sm-12">
                <h2 class="text-center">Anteproyecto</h2>

                <?php
                if (isset($_POST['enviar'])) {
                    require_once "../includes/db.php"; // Incluye el archivo de conexión a la base de datos
                    

                    // Recupera los datos del formulario
                    $idalumno = $_POST['idalumno'];
                    $nombrealumno = $_POST['nombrealumno'];

                    // Inserta los datos en la base de datos
                    $sql = "INSERT INTO asesorados (id, Alumno) 
            VALUES ('$idalumno', '$nombrealumno')";
                    $resultado = mysqli_query($conexion, $sql);

                    if ($resultado) {
                        echo "<script language='JavaScript'>
            alert('Registro Guardado');
            window.location.href = '../../../asignar_Asesores.php'; 
            </script>";
                    } else {
                        echo "<script language='JavaScript'>
            alert('Error al guardar el registro: " . mysqli_error($conexion) . "');
            </script>";
                    }
                }
                ?>

                <form method="post" action="">
                    <input type="text" name="idalumno" placeholder="ID del alumno">
                    <input type="text" name="nombrealumno" placeholder="Nombre del alumno">

                    

                    <div class="btn_enviar">
                        <button class="btn btn-primary enviar-otro" type="submit" name="enviar">Enviar</button>
                    </div>
                </form>

                <?php
                require_once "../includes/db.php";

                $carreras = array(); // Un arreglo para almacenar las carreras

<<<<<<< HEAD
                $query = "SELECT NombredeCarrera FROM carrera";
=======
                $query = "SELECT carrera FROM documento";
>>>>>>> 372474ca3d0cd5351b6c5f42f68d69dfdd883b69
                $result = mysqli_query($conexion, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
<<<<<<< HEAD
                        $carreras[] = $row['NombredeCarrera'];
=======
                        $carreras[] = $row['carrera'];
>>>>>>> 372474ca3d0cd5351b6c5f42f68d69dfdd883b69
                    }
                }
                ?>

                <label for="carrera">Carrera:</label>
<<<<<<< HEAD
                    <select name="carrera" id="carrera">
=======
                    <select name="carrera" id="carreraSelect">
>>>>>>> 372474ca3d0cd5351b6c5f42f68d69dfdd883b69
                        <?php
                        foreach ($carreras as $carrera) {
                            echo '<option value="' . $carrera . '">' . $carrera . '</option>';
                        }
                        ?>
                    </select>

<<<<<<< HEAD
                    
=======
                    <script>
                    document.getElementById('carreraSelect').onchange = function () {
                        filtrarRegistros();
                    };
                    </script>


>>>>>>> 372474ca3d0cd5351b6c5f42f68d69dfdd883b69

                <div class="container">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id Alumno</th>
                                <th>Nombre</th>
                                <th>Carrera</th>
                                <th>Nombre del proyecto</th>
                                <th>Empresa</th>
                                <th>Asesor</th>
                                <th>Archivo</th>
                                <th>Descargar</th>
                                <th>Ver PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "../includes/db.php";
                            $consulta = mysqli_query($conexion, "SELECT * FROM documento");

                            while ($fila = mysqli_fetch_assoc($consulta)):
                                if (!empty($fila['archivo'])) {
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
                                            <?php echo $fila['carrera']; ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $fila['nombreproyecto']; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['empresa']; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['asesor']; ?>
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
                                    </tr>
                                    <?php
                                }
                            endwhile;
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <script>
function filtrarRegistros() {
    var selectedCarrera = document.getElementById('carreraSelect').value;
    var tableRows = document.querySelectorAll('#dataTable tbody tr');

    for (var i = 0; i < tableRows.length; i++) {
        var carreraCell = tableRows[i].querySelector('td:nth-child(3)'); // La tercera columna contiene la carrera
        if (selectedCarrera === 'Todas' || carreraCell.textContent === selectedCarrera) {
            tableRows[i].style.display = 'table-row'; // Muestra la fila
        } else {
            tableRows[i].style.display = 'none'; // Oculta la fila
        }
    }
}
</script>

</body >


</html >