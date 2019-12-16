<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';

$name = htmlspecialchars($_GET["nombre"]);
$localidad = htmlspecialchars($_GET["localidad"]);
$dni = htmlspecialchars($_GET["dni"]);

/*$name = 'jonatan olmedo';
$localidad = 'tigre';
$dni = '333333';*/

$nameline = 'Nombre y apellido: '.$name;
$localidadline = 'Localidad: '.$localidad;
$dniline = 'DNI: '.$dni;



$pdf = new \setasign\Fpdi\Fpdi;

$pdf->AddPage();
$pdf->setSourceFile('./modelo-v2.pdf');

// We import only page 1
$tpl = $pdf->importPage(1);

// Let's use it as a template from top-left corner to full width and height
$pdf->useTemplate($tpl, 0, 0, null, null);

// Set font and color
$pdf->SetFont('Helvetica', '', 10); // Font Name, Font Style (eg. 'B' for Bold), Font Size
$pdf->SetTextColor(0, 0, 0); // RGB

// Position our "cursor" to left edge and in the middle in vertical position minus 1/2 of the font size
$pdf->SetXY(9, 100);

// Add text cell that has full page width and height of our font
$pdf->MultiCell(215.9, 5, utf8_decode($nameline . chr(10) . $localidadline .chr(10) . $dniline), '' , 'L');

$pdf->AddPage();

// We import only page 1
$tpl = $pdf->importPage(2);

// Let's use it as a template from top-left corner to full width and height
$pdf->useTemplate($tpl, 0, 0, null, null);

// Set font and color
$pdf->SetFont('Helvetica', '', 10); // Font Name, Font Style (eg. 'B' for Bold), Font Size
$pdf->SetTextColor(0, 0, 0); // RGB

// Position our "cursor" to left edge and in the middle in vertical position minus 1/2 of the font size
$pdf->SetXY(6, 98);

// Add text cell that has full page width and height of our font
$pdf->MultiCell(215.9, 5, utf8_decode($nameline . chr(10) . $localidadline .chr(10) . $dniline), '' , 'L');

// Output our new pdf into a file
// F = Write local file
// I = Send to standard output (browser)
// D = Download file
// S = Return PDF as a string
$pdf->Output('/tmp/new-file.pdf', 'I');

?>
