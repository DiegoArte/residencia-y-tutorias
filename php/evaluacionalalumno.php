<?php
    require_once '../phpoffice/vendor/autoload.php';
    use \ConvertApi\ConvertApi;

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../Formatos/EvaluacionAl.docx');

    ConvertApi::setApiSecret('tu_clave_de_API');

    // Ruta al archivo Word
    $inputFilePath = 'archivos/EvaluacionAl.docx';

    // Configurar opciones, incluyendo el tiempo de espera
    $options = [
        'timeout' => 30000, // Establecer el tiempo de espera en milisegundos (por ejemplo, 10000 milisegundos = 10 segundos)
    ];


    $Nomb=$_POST["Nombre"];
    $Actividad=$_POST["actividad"];
    $Periodo=$_POST["periodo"];

    $I1=$_POST["I1"];
    $S1=$_POST["S1"];
    $B1=$_POST["B1"];
    $N1=$_POST["N1"];
    $E1=$_POST["E1"];
    
    $I2=$_POST["I2"];
    $S2=$_POST["S2"];
    $B2=$_POST["B2"];
    $N2=$_POST["N2"];
    $E2=$_POST["E2"];
    
    $I3=$_POST["I3"];
    $S3=$_POST["S3"];
    $B3=$_POST["B3"];
    $N3=$_POST["N3"];
    $E3=$_POST["E3"];
    
    $I4=$_POST["I4"];
    $S4=$_POST["S4"];
    $B4=$_POST["B4"];
    $N4=$_POST["N4"];
    $E4=$_POST["E4"];
    
    $I5=$_POST["I5"];
    $S5=$_POST["S5"];
    $B5=$_POST["B5"];
    $N5=$_POST["N5"];
    $E5=$_POST["E5"];
    
    $I6=$_POST["I6"];
    $S6=$_POST["S6"];
    $B6=$_POST["B6"];
    $N6=$_POST["N6"];
    $E6=$_POST["E6"];
    
    $I7=$_POST["I7"];
    $S7=$_POST["S7"];
    $B7=$_POST["B7"];
    $N7=$_POST["N7"];
    $E7=$_POST["E7"];   
    
    $Observaciones=$_POST["Observaciones"];
    $Valor=$_POST["Valor"];
    $Nivel=$_POST["Nivel"];
    

    $templateProcessor-> setValue('Nomb',$Nomb);
    $templateProcessor-> setValue('Actividad',$Actividad);
    $templateProcessor-> setValue('Periodo',$Periodo);
    
    $templateProcessor-> setValue('I1',$I1);
    $templateProcessor-> setValue('S1',$S1);
    $templateProcessor-> setValue('B1',$B1);
    $templateProcessor-> setValue('N1',$N1);
    $templateProcessor-> setValue('E1',$E1);


    $templateProcessor-> setValue('I2',$I2);
    $templateProcessor-> setValue('S2',$S2);
    $templateProcessor-> setValue('B2',$B2);
    $templateProcessor-> setValue('N2',$N2);
    $templateProcessor-> setValue('E2',$E2);
    
    $templateProcessor-> setValue('I3',$I3);
    $templateProcessor-> setValue('S3',$S3);
    $templateProcessor-> setValue('B3',$B3);
    $templateProcessor-> setValue('N3',$N3);
    $templateProcessor-> setValue('S3',$E3);
    
    $templateProcessor-> setValue('I4',$I4);
    $templateProcessor-> setValue('S4',$S4);
    $templateProcessor-> setValue('B4',$B4);
    $templateProcessor-> setValue('N4',$N4);
    $templateProcessor-> setValue('S4',$E4);
    
    $templateProcessor-> setValue('I5',$I5);
    $templateProcessor-> setValue('S5',$S5);
    $templateProcessor-> setValue('B5',$B5);
    $templateProcessor-> setValue('N5',$N5);
    $templateProcessor-> setValue('S5',$E5);
    
    $templateProcessor-> setValue('I6',$I6);
    $templateProcessor-> setValue('S6',$S6);
    $templateProcessor-> setValue('B6',$B6);
    $templateProcessor-> setValue('N6',$N6);
    $templateProcessor-> setValue('S6',$E6);

    $templateProcessor-> setValue('I7',$I7);
    $templateProcessor-> setValue('S7',$S7);
    $templateProcessor-> setValue('B7',$B7);
    $templateProcessor-> setValue('N7',$N7);
    $templateProcessor-> setValue('E7',$E7);
    

    $templateProcessor-> setValue('Observaciones',$Observaciones);
    $templateProcessor-> setValue('Valor',$Valor);
    $templateProcessor-> setValue('Nivel',$Nivel);
    
    $templateProcessor->saveAs('archivos/EvaluacionAl.docx');

  
    $outputDir = 'archivos/';
    
    
    // Configurar la clave de API
    ConvertApi::setApiSecret('eK14Lc7mJ5IuOzlA');

    // Ruta al archivo Word
    $inputFilePath = 'archivos/EvaluacionAl.docx';

    // Realizar la conversión
    $result = ConvertApi::convert('pdf', ['File' => $inputFilePath], 'doc');

    // Ruta al directorio para guardar los archivos resultantes


    // Guardar los archivos resultantes
    $result->saveFiles($outputDir);

    $currentDate = date('d-m-y');
    $filename = "Evaluacion al alumno {$currentDate}.pdf";
    header("Content-Disposition: attachment; filename={$filename}");
    echo file_get_contents('archivos/EvaluacionAl.pdf');

    unlink('archivos/EvaluacionAl.pdf');
    unlink('archivos/EvaluacionAl.docx');
?>  