<?php

require_once '../phpoffice\vendor\autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$temlateProcesor = new \PhpOffice\PhpWord\TemplateProcessor('../Formatos/Periodo.docx');


$fecha_actual=$_POST["fecha_actual"];
$plan_estudios=$_POST["plan_estudios"];
$grupo=$_POST["grupo"];
$num_estudiantes=$_POST["num_estudiantes"];
$nombre_tutor=$_POST["nombre_tutor"];
$num_actividad1=$_POST["num_actividad1"];
$num_actividad2=$_POST["num_actividad2"];
$num_actividad3=$_POST["num_actividad3"];
$actividad1=$_POST["actividad1"];
$actividad2=$_POST["actividad2"];
$actividad3=$_POST["actividad3"];
$horas1=$_POST["horas1"];
$horas2=$_POST["horas2"];
$horas3=$_POST["horas3"];
$fecha_inicio1=$_POST["fecha_inicio1"];
$fecha_final1=$_POST["fecha_final1"];
$fecha_inicio2=$_POST["fecha_inicio2"];
$fecha_final2=$_POST["fecha_final2"];
$fecha_inicio3=$_POST["fecha_inicio3"];
$fecha_final3=$_POST["fecha_final3"];
$info_adicional1=$_POST["info_adicional1"];
$info_adicional2=$_POST["info_adicional2"];
$info_adicional3=$_POST["info_adicional3"];
$firma_tutor=$_POST["firma_tutor"];
$nombre_coordinador=$_POST["nombre_coordinador"];
$nombre_academico=$_POST["nombre_academico"];

//require_once 'FormularioCopia.php';  // Si lo necesitas


//$infCom=str_replace("\n", "<w:br />", $_POST["infCom"]);

$temlateProcesor->setValue('fecha_actual', $fecha_actual);
$temlateProcesor->setValue('plan_estudios', $plan_estudios);
$temlateProcesor->setValue('grupo', $grupo);
$temlateProcesor->setValue('num_estudiantes', $_POST['num_estudiantes']);
$temlateProcesor->setValue('nombre_tutor', $_POST['nombre_tutor']);
$temlateProcesor->setValue('num_actividad1', $_POST['num_actividad1']);
$temlateProcesor->setValue('num_actividad2', $_POST['num_actividad2']);
$temlateProcesor->setValue('num_actividad3', $_POST['num_actividad3']);
$temlateProcesor->setValue('actividad1', $_POST['actividad1']);
$temlateProcesor->setValue('actividad2', $_POST['actividad2']);
$temlateProcesor->setValue('actividad3', $_POST['actividad3']);
$temlateProcesor->setValue('horas1', $_POST['horas1']);
$temlateProcesor->setValue('horas2', $_POST['horas2']);
$temlateProcesor->setValue('horas3', $_POST['horas3']);
$temlateProcesor->setValue('fecha_inicio1', $_POST['fecha_inicio1']);
$temlateProcesor->setValue('fecha_final1', $_POST['fecha_final1']);
$temlateProcesor->setValue('fecha_inicio2', $_POST['fecha_inicio2']);
$temlateProcesor->setValue('fecha_final2', $_POST['fecha_final2']);
$temlateProcesor->setValue('fecha_inicio3', $_POST['fecha_inicio3']);
$temlateProcesor->setValue('fecha_final3', $_POST['fecha_final3']);
$temlateProcesor->setValue('info_adicional1', $_POST['info_adicional1']);
$temlateProcesor->setValue('info_adicional2', $_POST['info_adicional2']);
$temlateProcesor->setValue('info_adicional3', $_POST['info_adicional3']);
$temlateProcesor->setValue('firma_tutor', $_POST['firma_tutor']);
$temlateProcesor->setValue('nombre_coordinador', $_POST['nombre_coordinador']);
$temlateProcesor->setValue('nombre_academico', $_POST['nombre_academico']);

$pathToSave='resultados.docx';
$temlateProcesor->saveAs("resultados.docx");

//$templateProcessor->saveAs('Periodo ' . date('d-m-y') . '.docx');

header("Content-Disposition: attachment; filename=Informe de Resultados " . date('d-m-y') . ".docx; charset=iso-8859-1");
echo file_get_contents('Informe de Resultados ' . date('d-m-y') . '.docx');

unlink('Informe de Resultados ' . date('d-m-y') . '.docx');
?>
