<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto (Asesorados registrados)</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Anteproyecto.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style>
        table {
            margin: 0 auto;
            /* Para centrar la tabla */
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            margin-top: 20px;
        }
    </style>

</head>

<body>
    <br>

    <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
            <img src="profile.png" alt="">
            <?php
            $nombrealumno = $_SESSION['nombrealumno']; // Asigna el valor a $nombrealumno
            echo '<p>' . $nombrealumno . '</p>';
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

        <h2 class="text-center">Asesorados registrados</h2>

        <input type="text" id="searchInput" placeholder="Buscar por nombre...">

        <table id="dataTable">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tutorias_residencia";

            // Crea la conexión
            $conexion = new mysqli($servername, $username, $password, $dbname);

            // Verifica la conexión
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            $sql = "SELECT idalumno, nombrealumno, archivo FROM documento";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                // Mostrar los datos de cada fila
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["idalumno"] . "</td><td>" . $row["nombrealumno"] . "</td><td>" . $row["archivo"] ;
                }
            } else {
                echo "<tr><td colspan='4'>No hay asesorados registrados</td></tr>";
            }

            
            ?>
        </table>
    </section>
</body>
<button id="guardarDatos">Guardar Datos</button> <!-- Botón fuera de la tabla -->
    
    <script>
        $(document).ready(function() {
            $('#guardarDatos').click(function() {
                // Realizar una petición AJAX al script PHP para guardar los datos en la base de datos
                $.ajax({
                    type: 'POST',
                    url: 'guardar_asesorados.php', // Reemplaza 'guardar_datos.php' con la ruta a tu script PHP
                    success: function(response) {
                        alert('Datos guardados correctamente.');
                        // Puedes agregar aquí cualquier lógica adicional después de guardar los datos
                    },
                    error: function(xhr, status, error) {
                        alert('Error al guardar los datos. Inténtalo de nuevo.');
                        console.error(error);
                    }
                });
            });
        });
    </script>


</html>
