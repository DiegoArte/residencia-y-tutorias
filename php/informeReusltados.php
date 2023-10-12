<?php
    require_once '../phpoffice/vendor/autoload.php';

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../Formatos/Informe_resultados.docx');

    $Tutor=$_POST["Tutor"];
    $jefAca=$_POST["jefAca"];
    $pedSem=$_POST["pedSem"];
    $grupo=$_POST["grupo"];
    $proEstu=$_POST["proEstu"];
    $numTut=$_POST["numTut"];
    $numEntr=$_POST["numEntr"];
    $numDec=$_POST["numDec"];
    $lisNed=$_POST["lisNed"];
    $accRec=$_POST["accRec"];
    $areApo=$_POST["areApo"];
    $numApro=$_POST["numApro"];
    $numRepro=$_POST["numRepro"];
    $infCom=$_POST["infCom"];

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

    $templateProcessor->saveAs('Informe de Resultados '.date('d-m-y').'.docx');
  
    header("Content-Disposition: attachment; filename=Informe de Resultados ".date('d-m-y').".docx; charset=iso-8859-1");
    echo file_get_contents('Informe de Resultados '.date('d-m-y').'.docx');

    unlink('Informe de Resultados'.date('d-m-y').'.docx');

?>