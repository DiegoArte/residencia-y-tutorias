<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto (Vista Admin)</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <br>

    <div class="container">
        <div class="col-sm-12">
            <h2 style="text-align: center;">Anteproyecto</h2>
            <br>
            <div class="mb-3">
                <input type="text" id="searchId" class="form-control" placeholder="Buscar por ID">
            </div>
            <br>
            <br>
            <br>

            <div class="container" id="tableContainer" style="display: none;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre del alumno</th>
                            <th>Nombre del proyecto</th>
                            <th>Empresa</th>
                            <th>Archivo</th>
                            <th>Descargar</th>
                            <th>Ver PDF</th>
                            <?php
                                session_start();
                                if($_SESSION['tipo_usuario'] === 'docente'):               
                            ?>
                                <th>Responder</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../includes/db.php";
                        $consulta = mysqli_query($conexion, "SELECT * FROM documento");
                        while ($fila = mysqli_fetch_assoc($consulta)) :
                        ?>
                            <tr class="data-row" data-id="<?php echo $fila['idalumno']; ?>">
                                <td><?php echo $fila['idalumno']; ?></td>
                                <td><?php echo $fila['nombrealumno']; ?></td>
                                <td><?php echo $fila['nombreproyecto']; ?></td>
                                <td><?php echo $fila['empresa']; ?></td>
                                <td><?php echo $fila['archivo']; ?></td>
                                <td>
                                    <a href="../includes/download.php?id=<?php echo $fila['idalumno']; ?>" class="btn btn-primary">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                </td>
                                <td>
                                    <input type="hidden" class="id-hidden" value="<?php echo $fila['idalumno']; ?>">
                                    <a href="../includes/visualizar_pdf.php?idalumno=<?php echo $fila['idalumno']; ?>" class="btn btn-success btn-view-pdf" style="display: none;">
                                        <i class="fas fa-eye"></i> Ver PDF
                                    </a>
                                </td>
                                <?php
                                    if($_SESSION['tipo_usuario'] === 'docente'):               
                                ?>
                                    <td>
                                        <a href="../../../comunicacionDocenteAlumno.php?id=<?php echo $fila['idalumno']; ?>" class="btn btn-danger">
                                            <i class="fas fa-message"></i> Responder
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        a {
            text-decoration: none;
        }

        .s {
            padding-top: 50px;
            text-align: center;
        }
    </style>


    <script>
        $(document).ready(function () {
            // Limpiar los campos al cargar la página
            $('#searchId').val('');

            // Arreglo de IDs disponibles
            var availableIds = [
                <?php
                $consulta = mysqli_query($conexion, "SELECT idalumno FROM documento");
                $ids = array();
                while ($fila = mysqli_fetch_assoc($consulta)) {
                    $ids[] = $fila['idalumno'];
                }
                echo '"' . implode('","', $ids) . '"';
                ?>
            ];

            // Aplicar autocompletado
            $("#searchId").autocomplete({
                source: availableIds
            });

            // Manejar el evento de búsqueda por ID
            $('#searchId').on('autocompleteselect', function (event, ui) {
                var searchId = ui.item.value;
                $('.btn-view-pdf').hide(); // Ocultar todos los botones al empezar la búsqueda

                // Ocultar todas las filas
                $('.data-row').hide();

                // Mostrar solo la fila correspondiente al ID buscado
                $('.data-row[data-id="' + searchId + '"]').show();
                $('.data-row[data-id="' + searchId + '"] .btn-view-pdf').show();

                // Mostrar la tabla después de la búsqueda
                $('#tableContainer').show();
            });
        });
    </script>

</body>

</html>

