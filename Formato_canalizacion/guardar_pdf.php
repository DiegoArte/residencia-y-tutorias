<?php
// Definir variables para los mensajes
$mensajeExitoPDF = "";
$mensajeErrorPDF = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejar la carga del archivo PDF
    $pdfFile = $_FILES['pdfFile'];
    $numeroControl = $_POST['campoOculto1'];
    $nombre = $_POST['campoOculto2'];
    $nombreTutor = $_POST['campoOculto3'];
    $problematica = $_POST['campoOculto4'];

    // Verificar si se cargó correctamente
    if ($pdfFile['error'] === UPLOAD_ERR_OK) {
        // Obtener datos del archivo
        $pdfData = file_get_contents($pdfFile['tmp_name']);

        // Incluir el archivo de conexión a la base de datos
        require '../php/db.php';

        // Crear una instancia de la conexión a la base de datos
        $mysqli = conectar();

        // Verificar la conexión
        if ($mysqli->connect_error) {
            die("Error de conexión: " . $mysqli->connect_error);
        }



        // Tu consulta SQL
        $sql11 = "SELECT reporte FROM tablavispsico ORDER BY reporte DESC LIMIT 1";

        // Ejecutar la consulta
        $result11 = $mysqli->query($sql11);

        // Verificar si la consulta fue exitosa
        if ($result11) {
            // Obtener el resultado como array asociativo
            $datos11 = $result11->fetch_assoc();

            // Verificar si se obtuvieron datos
            if ($datos11) {
                // Acceder al valor de la columna "reporte"
                $reporte = $datos11['reporte'];

                // Obtener el último carácter
                $ultimoCaracter = substr($reporte, -1);

                // Convertir el último carácter a un tipo numérico
                $numero = intval($ultimoCaracter);
            }
        }

        $numero = $numero +1;
        $reporte = "Reporte" . $numero;




        // Preparar la consulta para insertar en la base de datos
        $stmt = $mysqli->prepare("INSERT INTO tabla_pdf (nombre, archivo) VALUES (?, ?)");
        $stmt->bind_param("ss", $pdfFile['name'], $pdfData);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $mensajeExitoPDF = "PDF enviado exitosamente a la Psicologa.";
        } else {
            $mensajeErrorPDF = "Error al enviar PDF a la Psicologa: " . $stmt->error;
        }

        $stmt = $mysqli->prepare("INSERT INTO tablavispsico (reporte, nocontrol, nomAlu, nomMaes, motivo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $reporte, $numeroControl, $nombre, $nombreTutor, $problematica);

        $stmt->execute();

        // Cerrar la conexión y liberar recursos
        $stmt->close();
        $mysqli->close();
    } else {
        echo "Error al subir el archivo PDF: " . $pdfFile['error'];
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Tus encabezados aquí -->
    <style>
        #mensajes {
            margin-top: 20px;
        }

        .mensaje-exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
        }

        .mensaje-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <!-- Tus otros elementos HTML aquí -->

    <div id="mensajes">
        <?php
        // Mostrar mensajes en div
        if (!empty($mensajeExitoPDF)) {
            echo '<div class="mensaje-exito">' . $mensajeExitoPDF . '</div>';
        }

        if (!empty($mensajeErrorPDF)) {
            echo '<div class="mensaje-error">' . $mensajeErrorPDF . '</div>';
        }
        ?>
    </div>

    <!-- Resto de tu HTML aquí -->
</body>

</html>