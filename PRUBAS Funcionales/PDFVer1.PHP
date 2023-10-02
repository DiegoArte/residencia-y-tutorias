<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Ruta absoluta al archivo PDF (asegúrate de que sea la ruta correcta)
$pdfFilePath ='\PDF_TUTORIAS\R-ITSZaS-8.5-18 Formato de Canalización.pdf';

// Verifica si el archivo PDF existe
if (file_exists($pdfFilePath)) {
    // Crea una instancia de mPDF
    $mpdf = new \Mpdf\Mpdf();

    // Establece el archivo PDF fuente
    $mpdf->setSourceFile($pdfFilePath);

    // Inicializa una variable para almacenar el texto extraído
    $pdfText = '';

    // Recorre cada página del PDF y extrae el texto
    for ($pageNum = 1; $pageNum <= $mpdf->setSourceFile($pdfFilePath); $pageNum++) {
        $page = $mpdf->importPage($pageNum);
        $pdfText .= $mpdf->runScript($page);
    }

    // Imprime el texto extraído
    echo $pdfText;
} else {
    echo "El archivo PDF no se encontró en la ruta especificada.";
}
?>
