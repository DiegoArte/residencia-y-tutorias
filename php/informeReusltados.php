<?php
    require_once dirname(__FILE__).'../PHPWord-master/src/PhpWord/Autoloader.php';
    \PhpOffice\PhpWord\Autoloader::register();

    use PhpOffice\PhpWord\TemplateProcessor;

    $plantillaInfResu=new TemplateProcessor('../Formatos/Informe_resultados.docx');

    
?>