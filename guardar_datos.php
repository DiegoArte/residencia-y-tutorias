<?php

$outputDir="Imagenes/";

require_once 'vendor\autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

use \ConvertApi\ConvertApi;

$temlateProcesor = new \PhpOffice\PhpWord\TemplateProcessor('..\Formatos\Periodo.docx'); 


// Botones de radio
$periodo = $_POST["periodo"];//isset($_POST["periodo"]) ? $_POST["periodo"] : '';

// Asignación en el documento de Word
//$temlateProcesor->setValue('periodo_enero_julio', ($periodo === 'Enero-Julio') ? 'X' : '');
//$temlateProcesor->setValue('periodo_agosto_diciembre', ($periodo === 'Agosto-Diciembre') ? 'X' : '');


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
//$firma_tutor=$_POST["firma_tutor"];
//$nombre_coordinador=$_POST["nombre_coordinador"];
//$nombre_academico=$_POST["nombre_academico"];


$extension = pathinfo($_FILES['firma_tutor']['name'], PATHINFO_EXTENSION);
    $nombrefinal = "";
    $nombrefinal = trim ($_FILES['firma_tutor']['name']);
    $nombrefinal2 = mb_ereg_replace (" ", "", $nombrefinal);
    //echo $_FILES['fichero']['name'][$key]."---".$nombrefinal2;
    $upload = $outputDir.$nombrefinal2;

//$Firma = $_POST["Firma"];
if(move_uploaded_file($_FILES['firma_tutor']['tmp_name'],$upload))
{
    
}
$temlateProcesor->setImageValue('firma_tutor',array('path' => $upload, 'width' => 150, 'height' => 400));
$outputDir="Imagenes/";

unlink($upload);
$upload = "";
$extension = pathinfo($_FILES['nombre_coordinador']['name'], PATHINFO_EXTENSION);
    $nombrefinal = "";
    $nombrefinal = trim ($_FILES['nombre_coordinador']['name']);
    $nombrefinal2 = mb_ereg_replace (" ", "", $nombrefinal);
    //echo $_FILES['fichero']['name'][$key]."---".$nombrefinal2;
    $upload = $outputDir.$nombrefinal2;

//$Firma = $_POST["Firma"];
if(move_uploaded_file($_FILES['nombre_coordinador']['tmp_name'],$upload))
{
    
}
$temlateProcesor->setImageValue('nombre_coordinador',array('path' => $upload, 'width' => 150, 'height' => 400));
$outputDir="Imagenes/";
unlink($upload);
$upload = "";
$extension = pathinfo($_FILES['nombre_academico']['name'], PATHINFO_EXTENSION);
    $nombrefinal = "";
    $nombrefinal = trim ($_FILES['nombre_academico']['name']);
    $nombrefinal2 = mb_ereg_replace (" ", "", $nombrefinal);
    //echo $_FILES['fichero']['name'][$key]."---".$nombrefinal2;
    $upload = $outputDir.$nombrefinal2;

//$Firma = $_POST["Firma"];
if(move_uploaded_file($_FILES['nombre_academico']['tmp_name'],$upload))
{
    
}
$temlateProcesor->setImageValue('nombre_academico',array('path' => $upload, 'width' => 150, 'height' => 400));
unlink($upload);
//require_once 'FormularioCopia.php';  // Si lo necesitas


//$infCom=str_replace("\n", "<w:br />", $_POST["infCom"]);
if ($periodo == "Enero-Julio"){
    $temlateProcesor->setValue('periodo', "X");
    $temlateProcesor->setValue('periodo2', " ");
}

if ($periodo == "Agosto-Diciembre"){
    $temlateProcesor->setValue('periodo2', "X");
    $temlateProcesor->setValue('periodo', " ");
}

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


//resto del código anterior 
$pathToSave='resultados.docx';
$temlateProcesor->saveAs("resultados.docx");

// Configurar la clave de API
ConvertApi::setApiSecret('eK14Lc7mJ5IuOzlA');

// Ruta al archivo Word
$inputFilePath = 'resultados.docx';

try {
    // Realizar la conversión
    $result = ConvertApi::convert('pdf', ['File' => $inputFilePath], 'doc');

    // Ruta al directorio para guardar los archivos resultantes

    // Guardar los archivos resultantes
    $result->saveFiles("Imagenes/");
} catch (Exception $e) {
    echo 'Error en la conversión: ',  $e->getMessage(), "\n";
}

// ... (código existente) ...

// Realizar la conversión
$result = ConvertApi::convert('pdf', ['File' => $inputFilePath], 'doc');

// Ruta al directorio para guardar los archivos resultantes


// Guardar los archivos resultantes
$result->saveFiles("Imagenes/");

?>
