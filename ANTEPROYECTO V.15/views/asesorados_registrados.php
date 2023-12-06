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
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/comunicacionDocenteAlumno.css">


    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
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

        #searchInput {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button#guardarDatos {
            display: block;
            margin: 20px auto;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button#guardarDatos:hover {
            background-color: #45a049;
        }
    </style>

</head>

<body>
    <br>

    <header class="fixed w-100">
        <a href="index(VISTA ADMIN).php" class="back-arrow rounded-pill d-flex justify-content-start">
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


    <div class="barraLateral fixed h-100">
        <a href="#"></a>
    </div>
    <section style="margin-top: 70px;">

        

</body>
<section>
        <h2 class="text-center">Asesorados registrados</h2>

        <form id="carreraForm">
        <label for="carrera">Selecciona una carrera:</label>
        <select name="carrera" id="carrera">
            <option value="">Todas las carreras</option>
            <!-- Aquí se cargarán dinámicamente las opciones de carrera -->
        </select>
        <button type="submit">Filtrar</button>
    </form>

        <table id="dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Carrera</th>
                <th>Anteproyecto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tutorias_residencia";

            // Crea la conexión
            $conexion = new mysqli($servername, $username, $password, $dbname);
        
            $search = $_GET['search'] ?? '';
            $sql = "SELECT idalumno, nombrealumno, carrera, archivo FROM documento WHERE liberado = 0";

            // Si se proporciona una cadena de búsqueda, agregarla a la consulta
            if(!empty($search)) {
                $sql .= " AND carrera LIKE '%$search%'";
            }

            $result = $conexion->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["idalumno"]."</td><td>".$row["nombrealumno"]."</td><td>".$row["carrera"]."</td><td>".$row["archivo"]."</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay asesorados registrados</td></tr>";
            }
            ?>
            <tbody>
        </table>
    </section>
<button id="guardarDatos">Guardar Datos</button> <!-- Botón fuera de la tabla -->

<script>
    $(document).ready(function () {
        $('#guardarDatos').click(function () {
            // Realizar una petición AJAX al script PHP para guardar los datos en la base de datos
            $.ajax({
                type: 'POST',
                url: 'guardar_asesorados.php', // Reemplaza 'guardar_datos.php' con la ruta a tu script PHP
                success: function (response) {
                    alert('Datos guardados correctamente.');
                    // Puedes agregar aquí cualquier lógica adicional después de guardar los datos
                },
                error: function (xhr, status, error) {
                    alert('Error al guardar los datos. Inténtalo de nuevo.');
                    console.error(error);
                }
            });
        });
    });
</script>


</html>