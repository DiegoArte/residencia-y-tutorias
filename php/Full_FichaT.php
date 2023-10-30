<?php
require_once '../phpoffice/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$temlateProcesor = new \PhpOffice\PhpWord\TemplateProcessor('../Formatos/FichaTec.docx');


$Periodo = $_POST["Periodo"];
$Feca = $_POST["Fecha"];
$nombreE = $_POST["NE"];
$semestre = $_POST["Semestre"];
$planE = $_POST["PE"];
$Actiidades = $_POST["ASR"];
$Dercicion = $_POST["Desercion"];
$Observaciones = $_POST["Observasiones"];
$NombreT = $_POST["NP"];
$Firma = $_POST["Firma"];


$temlateProcesor->setValue('Periodo_FT',$Periodo);
$temlateProcesor->setValue('Fecha_FT', $Feca);
$temlateProcesor->setValue('NombreE_FT', $nombreE);
$temlateProcesor->setValue('Semestre_FT', $semestre);
$temlateProcesor->setValue('plan_Estudio', $planE);
$temlateProcesor->setValue('ActividadesSR_FT', $Actiidades);
$temlateProcesor->setValue('Desercion', $Dercicion);
$temlateProcesor->setValue('Observaciones', $Observaciones);
$temlateProcesor->setValue('NombreT_FT', $NombreT);
$temlateProcesor->setValue('Firma_FT', $Firma);

$temlateProcesor->saveAs('FichaTecnica.docx');
header("Content-Disposition: attachment; filename=FichaTecnica.docx; charset=iso-8859-1");
echo file_get_contents('FichaTecnica.docx.docx');

unlink('FichaTecnica.docx.docx');




?>
<script type="text/javascript">
swal("Correcto", "Los datos fueron enviados correctamente", "success");
</script>