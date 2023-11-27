<?php
    session_start();
    $carrera=$_GET['carrera']??"";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="indices.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Tabla de Índices</title>
</head>
<body>

    <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
            <img src="profile.png" alt="">
            <?php
            $nombre = $_SESSION['nombre'];
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>
        </div>
    </header>
    <main>
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
        <div class="container" style="margin-top: 80px;">
            <a class="eliminar" href='anadir.php?id=" . $row["id"] . "'>Añadir</a>
            </td>
            <a class="eliminar" href="NUEVO2.PHP">Generar índice</a>
            <a class="eliminar" href="NUEVO.php">Generar todos los índices</a>
           
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tutorias_residencia";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Obtener datos de la tabla 'indices'
            $sql = "SELECT * FROM indices";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Plan de estudio</th><th>Materia</th><th>Semestre</th><th>Unidad</th><th>AlumnosA</th><th>AlumnosR</th><th>Acciones</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["carrera"] . "</td>";
                    echo "<td>" . $row["materia"] . "</td>";
                    echo "<td>" . $row["semestre"] . "</td>";
                    echo "<td>" . $row["unidad"] . "</td>";
                    echo "<td>" . $row["alumnosA"] . "</td>";
                    echo "<td>" . $row["alumnosR"] . "</td>";
                    echo "<td>
                            <a href='eliminar.php?id=" . $row["id"] . "'><img src='E1.png' alt='NM'></a>
                            <a href='editar.php?id=" . $row["id"] . "'><img src='E2.png' alt='NM'></a>
                        </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 resultados encontrados";
            }
            ?>
        </div>
    </main>
    <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este elemento?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger" id="eliminarEnlace" href="#">Eliminar</a>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
