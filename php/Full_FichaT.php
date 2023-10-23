<?php
require_once '../phpoffice/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$temlateProcesor = new \PhpOffice\PhpWord\TemplateProcessor('../Formatos/FichaTec.docx');


$Periodo = 'Per';
$Feca = '31/04/2087';
$nombreE = "Carlos Nolasco Hernandez";
$semestre = "6to";
$planE = "Sistemas Computacionales";
$Actiidades = "Nada";
$Dercicion = "Nada2";
$Observaciones = 'Nada3';
$NombreT = 'Raudel';
$Firma = 'Nada8';


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

use PhpOffice\PhpWord\TemplateProcessor;



?>