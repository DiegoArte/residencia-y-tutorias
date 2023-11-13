<?php
    require_once '../phpoffice/vendor/autoload.php';
    use \ConvertApi\ConvertApi;

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../Formatos/Informe_resultados.docx');

    ConvertApi::setApiSecret('tu_clave_de_API');

    // Ruta al archivo Word
    $inputFilePath = 'archivos/FichaTecnica.docx';

    // Configurar opciones, incluyendo el tiempo de espera
    $options = [
        'timeout' => 30000, // Establecer el tiempo de espera en milisegundos (por ejemplo, 10000 milisegundos = 10 segundos)
    ];


    $Tutor=$_POST["Tutor"];
    $jefAca=$_POST["jefAca"];
    $pedSem=$_POST["pedSem"];
    $grupo=$_POST["grupo"];
    $proEstu=$_POST["proEstu"];
    $numTut=$_POST["numTut"];
    $numEntr=$_POST["numEntr"];
    $numDec=$_POST["numDec"];
    $lisNed=str_replace("\n", "<w:br/>", $_POST["lisNed"]);
    $accRec=str_replace("\n", "<w:br/>", $_POST["accRec"]);
    $areApo=str_replace("\n", "<w:br/>", $_POST["areApo"]);
    $numApro=$_POST["numApro"];
    $numRepro=$_POST["numRepro"];
    $infCom=str_replace("\n", "<w:br/>",$_POST["infCom"]);

    $templateProcessor-> setValue('Nobre_Tutor',$Tutor);
    $templateProcessor-> setValue('Jefe_Div_Aca',$jefAca);
    $templateProcessor-> setValue('Per_Sem',$pedSem);
    $templateProcessor-> setValue('Grupo',$grupo);
    $templateProcessor-> setValue('Prog_Est',$proEstu);
    $templateProcessor-> setValue('Tus_Asig',$numTut);
    $templateProcessor-> setValue('Num_Ent',$numEntr);
    $templateProcessor-> setValue('Num_Ned',$numDec);
    $templateProcessor-> setValue('Lis_Dec',$lisNed);
    $templateProcessor-> setValue('Acc_Rec',$accRec);
    $templateProcessor-> setValue('Are_Apo',$areApo);
    $templateProcessor-> setValue('Num_Apro',$numApro);
    $templateProcessor-> setValue('Num_Repro',$numRepro);
    $templateProcessor-> setValue('Info_Comple',$infCom);

    $templateProcessor->saveAs('archivos/InformedeResultados.docx');

  
    $outputDir = 'archivos/';
    
    
    // Configurar la clave de API
    ConvertApi::setApiSecret('eK14Lc7mJ5IuOzlA');

    // Ruta al archivo Word
    $inputFilePath = 'archivos/InformedeResultados.docx';

    // Realizar la conversión
    $result = ConvertApi::convert('pdf', ['File' => $inputFilePath], 'doc');

    // Ruta al directorio para guardar los archivos resultantes


    // Guardar los archivos resultantes
    $result->saveFiles($outputDir);

    $currentDate = date('d-m-y');
    $filename = "Informe de Resultados {$currentDate}.pdf";
    header("Content-Disposition: attachment; filename={$filename}");
    echo file_get_contents('archivos/InformedeResultados.pdf');

    unlink('archivos/InformedeResultados.pdf');
    unlink('archivos/InformedeResultados.docx');
?>  