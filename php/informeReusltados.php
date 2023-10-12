<?php
    require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();


    use PhpOffice\PhpWord\TemplateProcessor;

    $plantillaInfResu=new TemplateProcessor('../Formatos/Informe_resultados.docx');

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
    $areApo=$_POST["areApop"];
    $numApro=$_POST["numApro"];
    $numRepro=$_POST["numRepro"];
    $infCom=$_POST["infCom"];

    $templateWord-> setValue('Nobre_Tutor',$Tutor);
    $templateWord-> setValue('Jefe_Div_Aca',$jefAca);
    $templateWord-> setValue('Per_Sem',$pedSem);
    $templateWord-> setValue('Grupo',$grupo);
    $templateWord-> setValue('Prog_Est',$proEstu);
    $templateWord-> setValue('Tus_Asig',$numTut);
    $templateWord-> setValue('Num_Ent',$numEntr);
    $templateWord-> setValue('Num_Ned',$numDec);
    $templateWord-> setValue('Lis_Dec',$lisNed);
    $templateWord-> setValue('Acc_Rec',$accRec);
    $templateWord-> setValue('Are_Apo',$areApo);
    $templateWord-> setValue('Num_Apro',$numApro);
    $templateWord-> setValue('Num_Repro',$numRepro);
    $templateWord-> setValue('Info_Comple',$infCom);

    $templateWord->saveAs('Informe de Resultados'.date('d-m-y').'.docx');

    header("Content-Disposition: attachment; filename=Informe de Resultados'.date('d-m-y').'.docx; charset=iso-8859-1");
    echo file_get_contents('Informe de Resultados'.date('d-m-y').'.docx');

?>