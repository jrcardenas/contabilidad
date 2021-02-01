<?php

require_once ("./vendor/autoload.php");
require_once ("../Ejercicio4/tablaMpdf.php");


//metemos el css
$css=file_get_contents("../estilos.css");

$mpdf=new \Mpdf\Mpdf([


]);

$tabla=getplantilla();
$mpdf->writeHtml($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($tabla,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();
?>