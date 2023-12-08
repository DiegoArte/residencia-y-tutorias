<?php
session_start();
$carrera = $_GET['carrera'] ?? "";
?>
<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="indices/indices.css">
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Tabla de Índices</title>

    <style>
        header {
            z-index: 1;
        }

        .back-arrow {
            position: absolute !important;
            margin: 90px 70px;
            background-color: #4F648B;
            padding: 10px;
            top: 15px;
            font-size: 16px;
        }

        .back-arrow:hover .regresar {
            display: block !important;
        }

        img {
            width: 50px;
            /* Puedes ajustar el valor según tus necesidades */
            height: auto;
            /* Para mantener la proporción de la imagen */
        }
       
    </style>
</head>

<body>

   <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
    </main>
    <header class="fixed w-100">
            <a href="../asignar_Tutores.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
        </a>
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="" >
            <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>
        </div>
    </header>

    <main>
       
        <div class="container" style="margin-top: 80px;">
            <a class="eliminar" href='indices/anadir2.php?id=" . $row["id"] . "'>Añadir</a>
            </td>
            <a class="eliminar" href="indices/NUEVO2.PHP">Generar índice</a>
            <a class="eliminar" href="indices/NUEVO.php">Generar todos los índices</a>

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
                echo "<tr><th>Plan de estudio</th><th>Materia</th><th>Semestre</th><th>Número de control</th><th>Unidad</th><th>AlumnosAprobados</th><th>AlumnosReprobados</th><th>Acciones</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["carrera"] . "</td>";
                    echo "<td>" . $row["materia"] . "</td>";
                    echo "<td>" . $row["semestre"] . "</td>";
                    echo "<td>" . $row["grupo"] . "</td>";
                    echo "<td>" . $row["unidad"] . "</td>";
                    echo "<td>" . $row["alumnosA"] . "</td>";
                    echo "<td>" . $row["alumnosR"] . "</td>";
                    echo "<td>
                            <a href='indices/confirmacion_eliminar.php?id=" . $row["id"] . "'><img class='cak' src='indices/E1.png' alt='NM'></a>
                            <a href='indices/editar.php?id=" . $row["id"] . "'><img class='cak' src='indices/E2.png' alt='NM'></a>
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

    <br><br><br>
   

</body>

</html>