<?php
require_once "../includes/db.php";

if (isset($_GET['carrera'])) {
    $carrera = $_GET['carrera'];

    $query = "SELECT * FROM documento WHERE carrera = '$carrera'";
    $result = mysqli_query($conexion, $query);

    $tableData = ''; // Variable para almacenar el HTML de las filas de la tabla

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Genera el HTML para cada fila de la tabla
            $tableData .= '<tr>';
            $tableData .= '<td>' . $row['idalumno'] . '</td>';
            $tableData .= '<td>' . $row['nombrealumno'] . '</td>';
            $tableData .= '<td>' . $row['carrera'] . '</td>';
            // ... Continúa con el resto de las columnas
            $tableData .= '</tr>';
        }
    }

    echo $tableData;
}
?>
