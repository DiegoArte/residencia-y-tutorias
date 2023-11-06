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

           
                <button class="btn btn-primary enviar-otro" type="submit">Enviar</button>

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
                                <th>Agregar un asesor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "../includes/db.php";
                            $consulta = mysqli_query($conexion, "SELECT * FROM documento");
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
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </td>
                                    <td>
                                        <a href="../includes/files/<?php echo $fila['archivo']; ?>"
                                            class="btn btn-secondary" target="_blank">
                                            Ver PDF
                                        </a>
                                    </td>

                                    

                                    <td>
                                        <form class="form-edit-asesor" data-id="<?php echo $fila['id']; ?>">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nuevo-asesor"
                                                    value="<?php echo $fila['asesor']; ?>">
                                            </div>
                                            <button class="btn btn-primary guardar-asesor" type="button">
                                                Guardar Cambios
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                </div>
            </div>


            <script>
                $(document).ready(function () {
                    $(".guardar-asesor").click(function () {
                        var button = $(this);
                        var input = button.closest('.form-edit-asesor').find('input[name="nuevo-asesor"]');
                        var idProyecto = button.closest('.form-edit-asesor').data('id');
                        var nuevoAsesor = input.val();

                        // Realiza la solicitud AJAX para actualizar el asesor
                        $.ajax({
                            type: 'POST',
                            url: '../includes/asesor.php', // El archivo PHP que maneja la actualización
                            data: {
                                id: idProyecto,
                                asesor: nuevoAsesor
                            },
                            success: function (response) {
                                // Maneja la respuesta del servidor (puedes mostrar un mensaje de éxito)
                                if (response === "success") {
                                    // Oculta el input y el botón
                                    button.hide();
                                    input.prop('disabled', true);
                                }
                            }
                        });
                    });
                });
            </script>

</body>


</html>