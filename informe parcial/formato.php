<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        
    </header>
    
</body>
</html>

<?php
$html=ob_get_clean();
require_once('../dompdf_2-0-3/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf=new Dompdf();

$options=$dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream("informe_parcial.pdf", array("Attachment"=>false));
?>