<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
require_once '../phpoffice/vendor/autoload.php';

use \ConvertApi\ConvertApi;
use PhpOffice\PhpSpreadsheet\IOFactory;

$temlateProcesor = new \PhpOffice\PhpWord\TemplateProcessor('../Formatos/FichaTec.docx');




$outputDir = 'archivos/';

$Periodo = $_POST["Periodo"];
$Feca = $_POST["Fecha"];
$nombreE = $_POST["NE"];
$semestre = $_POST["Semestre"];
$planE = $_POST["PE"];
$Actiidades = $_POST["ASR"];
$Dercicion = $_POST["Desercion"];
$Observaciones = $_POST["Observasiones"];
$NombreT = $_POST["NP"];

$extension = pathinfo($_FILES['Firma']['name'], PATHINFO_EXTENSION);
    $nombrefinal = "";
    $nombrefinal = trim ($_FILES['Firma']['name']);
    $nombrefinal2 = mb_ereg_replace (" ", "", $nombrefinal);
    //echo $_FILES['fichero']['name'][$key]."---".$nombrefinal2;
    $upload = $outputDir.$nombrefinal2;

//$Firma = $_POST["Firma"];
if(move_uploaded_file($_FILES['Firma']['tmp_name'],$upload))
{
    
}




$temlateProcesor->setValue('Periodo_FT',$Periodo);
$temlateProcesor->setValue('Fecha_FT', $Feca);
$temlateProcesor->setValue('NombreE_FT', $nombreE);
$temlateProcesor->setValue('Semestre_FT', $semestre);
$temlateProcesor->setValue('plan_Estudio', $planE);
$temlateProcesor->setValue('ActividadesSR_FT', $Actiidades);
$temlateProcesor->setValue('Desercion', $Dercicion);
$temlateProcesor->setValue('Observaciones', $Observaciones);
$temlateProcesor->setValue('NombreT_FT', $NombreT);

$temlateProcesor->setImageValue('Firma_FT', array('path' => $upload, 'width' => 100, 'height' => 400));

$temlateProcesor->saveAs('archivos/FichaTecnica.docx');



// Configurar la clave de API
ConvertApi::setApiSecret('qgZqzA3KYLmClT47');

// Ruta al archivo Word
$inputFilePath = 'archivos/FichaTecnica.docx';

// Realizar la conversión
$result = ConvertApi::convert('pdf', ['File' => $inputFilePath], 'doc');

// Ruta al directorio para guardar los archivos resultantes


// Guardar los archivos resultantes
$result->saveFiles($outputDir);



$pdfFilePath = $outputDir. "FichaTecnica.pdf";
/*
// Configurar encabezados para sugerir la descarga
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="FichaTecnica.pdf"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($pdfFilePath));
readfile($pdfFilePath);
*/

unlink($upload)

?>
<style>
    .custom-button-visualizar {
        background-color: #4CAF50; /* Verde */
        color: white;
    }

    .custom-button-descargar {
        background-color: #008CBA; /* Azul */
        color: white;
    }
</style>

<script type="text/javascript">
    // Mostrar SweetAlert con botones "Visualizar" y "Descargar"
    document.addEventListener('DOMContentLoaded', function() {// Mostrar SweetAlert con botones "Visualizar" y "Descargar"
    swal({
        title: "Éxito",
        text: "Los datos fueron enviados correctamente.",
        icon: "success",
        buttons: {
            visualizar: {
                text: "Visualizar",
                value: "visualizar",
                className: "custom-button-visualizar",
            },
            descargar: {
                text: "Descargar",
                value: "descargar",
                className: "custom-button-descargar",
            },
        },
    })
    .then((value) => {
        // Redirigir según la opción seleccionada por el usuario
        if (value === "visualizar") {
            var pdfFilePath = 'archivos/FichaTecnica.pdf';
            // Redirigir a una página que muestre el PDF en línea
            window.open(pdfFilePath, "_blank");
        } else if (value === "descargar") {
            var pdfFilePath = 'archivos/FichaTecnica.pdf';
            // Redirigir para descargar el PDF
            var link = document.createElement('a');
            link.href = pdfFilePath;
            link.download = 'FichaTecnica.pdf';
            link.click();
        }
    });})
</script>

<?php
