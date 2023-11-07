<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
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
        
                <div class="btn_agregar">
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#agregar">Agregar</button>
                </div>

                <div class="container">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>Id Alumno</th>
                                <th>Nombre</th>
                                <th>Nombre del proyecto</th>
                                <th>Empresa</th>
                                <th>Asesor</th>
                                <th>Archivo</th>
                                <th>Descargar</th>
                                <th>Ver PDF</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "../includes/db.php";
                            $consulta = mysqli_query($conexion, "SELECT * FROM documento GROUP BY nombrealumno");

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
                                    <td>
                                        <button class="btn btn-danger btn-eliminar" data-id="<?php echo $fila['idalumno']; ?>">
                                            Eliminar
                                        </button>
                                    </td>

                                </tr>

                            <?php endwhile; ?>

                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <script>
    // Escuchar el clic en los botones de eliminar
    document.querySelectorAll('.btn-eliminar').forEach(function (button) {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            if (confirm('¿Seguro que deseas eliminar este registro?')) {
                // Realizar una solicitud al servidor para eliminar el registro
                fetch('eliminar.php', {
                    method: 'POST',
                    body: JSON.stringify({ id: id }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Actualizar la tabla o realizar otras acciones necesarias
                        // Puedes recargar la página o actualizar la tabla sin recargarla
                        // Aquí puedes personalizar el comportamiento según tus necesidades
                        location.reload(); // Esto recargará la página
                    } else {
                        console.error('Error al eliminar el registro.');
                    }
                })
                .catch(error => {
                    console.error('Error de red:', error);
                });
            }
        });
    });
</script>

</body>


<?php include "agregar.php"; ?>

</html>