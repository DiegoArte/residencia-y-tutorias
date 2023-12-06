<?php
    $grupo = $_POST['acade'];
    $fecha = $_POST['fecha'];
    
    require_once "db.php";
    $conexion = conectar();

    $consulta = "SELECT NumeroControl, Nombre FROM `asistut` WHERE `Fecha`= '$fecha' AND `carrera`= '$grupo'";
    $consulta2 = "SELECT Actividad, Grupo, Fecha FROM `asisactivi` WHERE Fecha='$fecha' AND Grupo='$grupo';";
    $resultado = $conexion->query($consulta);
    $resultado2 = $conexion->query($consulta2);

    // Incluir la biblioteca TCPDF
    require_once('../TCPDF-main/tcpdf.php');

    ob_start(); // Iniciar el buffer de salida

    // Crear nuevo objeto PDF con orientación horizontal
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Autor');
    $pdf->SetTitle('Datos Consulta');

    // Agregar página
    $pdf->AddPage();

    // Mostrar datos de la consulta 2 en la parte superior como texto con saltos de línea y centrado
    $datosConsulta2 = '';
    while ($fila2 = $resultado2->fetch_assoc()) {
        $datosConsulta2 .= "Actividad: " . $fila2['Actividad'] . "\nGrupo: " . $fila2['Grupo'] . "\nFecha: " . $fila2['Fecha'] . "\n";
    }
    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetXY(15, 15); // Establecer posición para los datos de la consulta 2

    // Mostrar texto centrado
    $pdf->MultiCell(0, 10, $datosConsulta2, 0, 'C');



    // Mostrar datos de la consulta 1 en una tabla
    $html = '<table border="1">
                <tr>
                    <th>Número de Control</th>
                    <th>Nombre</th>
                    <th>Firmas</th>
                </tr>';

    while ($fila = $resultado->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $fila['NumeroControl'] . '</td>
                    <td>' . $fila['Nombre'] . '</td>
                    <td></td>
                </tr>';
    }
    $html .= '</table>';

    // Establecer posición para la tabla de datos de la consulta 1
    $pdf->SetXY(15, 40); // Puedes ajustar las coordenadas para posicionar la tabla

    // Agregar la tabla al PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Nombre del archivo PDF
    $nombreArchivo = 'Lista de asistencia.pdf';

    // Finalizar y limpiar el buffer de salida
    ob_end_clean();

    // Salida del PDF (descarga o visualización)
    $pdf->Output($nombreArchivo, 'D'); // 'D' para descargar, 'I' para visualizar en el navegador

    $conexion->close();
?>
