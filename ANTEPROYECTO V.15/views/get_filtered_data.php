<?php
// get_filtered_data.php

// Incluye tu archivo de conexión a la base de datos y otras configuraciones necesarias
require_once "../includes/db.php";

if (isset($_POST['carrera'])) {
    $selectedCarrera = $_POST['carrera'];

    // Realiza la consulta filtrando por la carrera seleccionada
    $consultaFiltrada = mysqli_query($conexion, "SELECT * FROM documento WHERE carrera = '$selectedCarrera'");

    // Genera el HTML de las filas de la tabla con los datos filtrados
    $html = '';
    while ($fila = mysqli_fetch_assoc($consultaFiltrada)) {
        $html .= '<tr>';
        $html .= '<td>' . $fila['idalumno'] . '</td>';
        $html .= '<td>' . $fila['nombrealumno'] . '</td>';
        $html .= '<td>' . $fila['nombreproyecto'] . '</td>';
        $html .= '<td>' . $fila['empresa'] . '</td>';
        $html .= '<td>' . $fila['archivo'] . '</td>';
        $html .= '<td><a href="../includes/download.php?idalumno=' . $fila['idalumno'] . '" class="btn btn-primary"><i class="fas fa-download"></i> Descargar</a></td>';
        $html .= '<td><a href="../includes/files/' . $fila['archivo'] . '" class="btn btn-secondary" target="_blank">Ver PDF</a></td>';
        $html .= '<td>';

        if ($fila['liberado'] == 1) {
            $html .= '<div class="cuadro-verde">';
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-check" viewBox="0 0 16 16">';
            $html .= '<path d="M13.862 4.153a1.177 1.177 0 0 0-1.651.062l-6.699 7.17-2.573-2.862a1.2 1.2 0 0 0-1.762-.03 1.119 1.119 0 0 0-.032 1.514l3.333 3.666a1.177 1.177 0 0 0 1.648.031l7.83-8.375a1.118 1.118 0 0 0 .056-1.166z" />';
            $html .= '</svg>';
            $html .= '</div>';
        } else {
            $html .= '<div class="cuadro-rojo">';
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">';
            $html .= '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1 0 .708L9.707 8l2.647 2.646a.5.5 0 0 1 0 .708l-1 1a.5.5 0 0 1-.708 0L8 8.707 5.354 11.354a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 0-.708L6.293 8 3.646 5.354a.5.5 0 0 1 0-.708l1-1z" />';
            $html .= '</svg>';
            $html .= '</div>';
        }

        $html .= '</td>';
        $html .= '</tr>';
    }

    echo $html;
}
?>
