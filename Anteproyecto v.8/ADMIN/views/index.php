<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Anteproyecto.css">
    <title>Anteproyecto (Vista Admin)</title>


</head>

<body>
 <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
            <img src="profile.png" alt="" >
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


<script>
    $(document).ready(function () {
        // Function to display all data
        function displayAllData() {
            $('.data-row').show(); // Show all rows
            $('.btn-view-pdf').show(); // Show all PDF buttons
        }

        // Limpiar los campos al cargar la página
        $('#searchId').val('');

        // Aplicar autocompletado
        var availableIds = <?php
                            $consulta = mysqli_query($conexion, "SELECT idalumno FROM documento");
                            $ids = array();
                            while ($fila = mysqli_fetch_assoc($consulta)) {
                                $ids[] = $fila['idalumno'];
                            }
                            echo json_encode($ids);
                            ?>;

        $("#searchId").autocomplete({
            source: availableIds
        });

        // Handle the event when an ID is selected from autocomplete
        $('#searchId').on('autocompleteselect', function (event, ui) {
            var searchId = ui.item.value;
            $('.btn-view-pdf').hide(); // Hide all PDF buttons

            // Hide all rows
            $('.data-row').hide();

            // Show the row with the specified ID and its corresponding PDF button
            $('.data-row[data-id="' + searchId + '"]').show();
            $('.data-row[data-id="' + searchId + '"] .btn-view-pdf').show();

            // Show the table after the search
            $('#tableContainer').show();
        });

        // Handle Enter key press in the search input
        $('#searchId').on('keypress', function (event) {
            if (event.keyCode === 13) {
                var searchId = $(this).val();
                $('.btn-view-pdf').hide(); // Hide all PDF buttons

                // If no ID provided, display all data
                if (!searchId || searchId === '') {
                    displayAllData();
                    // Show the table after the search
                    $('#tableContainer').show();
                    return;
                }

                // Hide all rows
                $('.data-row').hide();

                // Show the row with the specified ID and its corresponding PDF button
                $('.data-row[data-id="' + searchId + '"]').show();
                $('.data-row[data-id="' + searchId + '"] .btn-view-pdf').show();

                // Show the table after the search
                $('#tableContainer').show();
            }
        });

        // Handle clearing the search input
        $('#searchId').on('input', function () {
            var searchId = $(this).val();

            // If the search input is cleared, display all data
            if (!searchId || searchId === '') {
                displayAllData();
                // Show the table after clearing the search input
                $('#tableContainer').show();
            }
        });

        // Display all data on page load
        displayAllData();
        $('#tableContainer').show(); // Show the table after the page loads
    });
</script>


</body>

</html>

