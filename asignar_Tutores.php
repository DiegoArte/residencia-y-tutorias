<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/asignar_Tutores.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">

    <title>Asignar tutores a grupos</title>

</head>

<body>

<main class="d-flex">
    <div class="barraLateral fixed h-100">
        <a href="#"></a>
    </div>
</main>


<header class="fixed w-100">
    <div class="usuarioOp d-flex justify-content-end">
        <img src="img/profile.png" alt="" >
        <p>Usuario</p>
        <a href="#">Cerrar sesión</a>
    </div>
    <h4 id="titulo">Asignar Tutores a Grupos:</h4>
</header>


<?php

require 'php/db.php';

$conn=conectar();



// Mostrar el formulario de selección de nombre
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql_alum = "SELECT DISTINCT NombredeCarrera, Semestre, NumerodeControl FROM grupos";
    $result_alum = $conn->query($sql_alum);
    $sql_doc = "SELECT DISTINCT NombredelDocente, NumerodeControl FROM docentes";
    $result_doc = $conn->query($sql_doc);

    if ($result_alum->num_rows > 0) {
        echo "<html>";
        echo "<body>";

        echo "<h4 id='alum'>Grupos</h4>";
        echo "<form action='php/guardar_asigado.php' method='POST'>";
        echo "<select id='alumnos' name='Lista1'>";
        while ($row = $result_alum->fetch_assoc()) {
            echo "<option value='" . $row["NumerodeControl"] . "'>" . $row["NombredeCarrera"] ." ". $row["Semestre"] ."</option>";
        }
        echo "</select>";

        echo "<h4 id='asig'>Asignar a:</h4>";
        
        echo "<h4 id='doc'>Docentes</h4>";
        echo "<select id='docentes' name='Lista2'>";

        while ($row = $result_doc->fetch_assoc()) {
            echo "<option value='" . $row["NumerodeControl"] . "'>" . $row["NombredelDocente"] ." ". "</option>";
        }
        echo "</select>";

        echo "<input type='submit' class='enviar' value='Asignar'>";
        echo "</form>";

        // Consulta SQL para obtener los datos de la tabla asesorados
        $sql_asesorados = "SELECT grupo, tutor FROM tabla_tutorados";
        $result_asesorados = $conn->query($sql_asesorados);

        echo "<table>";
        echo "    <thead>";
        echo "        <tr>";
        echo "            <th>Grupos</th>";
        echo "            <th>Tutores</th>";
        echo "            <th></th>";
        echo "        </tr>";
        echo "    </thead>";

        echo "    <tbody>";

        while ($row = $result_asesorados->fetch_assoc()) {
            echo "       <tr>";
            echo "            <td>" . $row["grupo"] . "</td>";
            echo "            <td>" . $row["tutor"] . "</td>";
            echo "            <td>";
            echo "            <form action='php/eliminar_registro.php' method='POST'>";
            echo "                <input type='hidden' name='alumno' value='" . $row["grupo"] . "'>";
            echo "                <input type='hidden' name='asesor' value='" . $row["tutor"] . "'>";
            echo "                <input type='submit' name='eliminar' value='Eliminar'>";
            echo "            </form>";
            echo "            </td>";
            echo "        </tr>";
        }

        echo "    </tbody>";
        echo "</table>";

        echo "</body>";
        echo "</html>";
    }
    
    else {
        // Consulta SQL para obtener los datos de la tabla asesorados
        $sql_asesorados = "SELECT grupo, tutor FROM tabla_tutorados";
        $result_asesorados = $conn->query($sql_asesorados);

        echo "<h4 id='alum'>Grupos</h4>";
        echo "<select id='alumnos' name='Lista1'>";
        echo "</select>";

        echo "<h4 id='asig'>Asignar a:</h4>";

        echo "<h4 id='doc'>Docentes</h4>";
            echo "<select id='docentes' name='Lista2'>";

            while ($row = $result_doc->fetch_assoc()) {
                echo "<option value='" . $row["grupo"] . "'>" . $row["grupo"] . "</option>";
            }
        echo "</select>";

        echo "<input type='submit' class='enviar' value='Asignar'>";
        echo "<h5 id='sinDatos'>No hay grupos para ser asignados</h5>";

        echo "<table>";
        echo "    <thead>";
        echo "        <tr>";
        echo "            <th>Grupos</th>";
        echo "            <th>Tutores</th>";
        echo "            <th></th>";
        echo "        </tr>";
        echo "    </thead>";

        echo "    <tbody>";

        while ($row = $result_asesorados->fetch_assoc()) {
            echo "       <tr>";
            echo "            <td>" . $row["grupo"] . "</td>";
            echo "            <td>" . $row["tutor"] . "</td>";
            echo "            <td>";
            echo "            <form action='php/eliminar_registro.php' method='POST'>";
            echo "                <input type='hidden' name='alumno' value='" . $row["grupo"] . "'>";
            echo "                <input type='hidden' name='asesor' value='" . $row["tutor"] . "'>";
            echo "                <input type='submit' name='eliminar' value='Eliminar'>";
            echo "            </form>";
            echo "            </td>";
            echo "        </tr>";
        }

        echo "    </tbody>";
        echo "</table>";

        echo "</body>";
        echo "</html>";
    }
}

$conn->close();
?>


</body>

</html>