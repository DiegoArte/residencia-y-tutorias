<?php
session_start();
require 'php/db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['carrera'])) {
    $carrera = $_GET['carrera'];

    // Realiza una consulta SQL para buscar registros en la tabla correspondiente (ajusta el nombre de la tabla según tu base de datos)
    $result_carreras = Alumnos::find("Carrera LIKE '%$carrera%'");

    // Muestra los resultados
    if (!empty($result_carreras)) {
        echo "<h4>Resultados de la búsqueda:</h4>";
        echo "<table>";
        echo "<thead><tr><th>Alumno</th><th>Carrera</th></tr></thead>";
        echo "<tbody>";
        foreach ($result_carreras as $row) {
            echo "<tr>";
            echo "<td>" . $row->NombredelEstudiante . "</td>";
            echo "<td>" . $row->Carrera . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No se encontraron resultados para la carrera '$carrera'.";
    }
}
?>
