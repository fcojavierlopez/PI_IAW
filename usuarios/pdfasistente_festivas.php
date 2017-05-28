<?php
$festival=$_GET['id'];
require('printhtml.php');
require_once("conexion.php");
class PDF extends FPDF
{
//Pie de página
function Footer()
{
$this->SetY(-10);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
//Creación del objeto de la clase heredada
$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
if ($result = $connection->query("SELECT NOMBRE as nombre_evento
  FROM eventos where NOMBRE='$festival';")) {
 while($obj = $result->fetch_object()) {
   $eve = stripslashes($obj->nombre_evento);
   $eve = iconv('UTF-8', 'windows-1252', $eve);
$pdf->WriteHTML($eve);
$pdf->ln(10);
}
}
$pdf->Cell(50,5,"Artistas",1,0,'C');
$pdf->ln();
//Aquí escribimos lo que deseamos mostrar
 if ($result = $connection->query("SELECT artista.NOMBRE as nombre_artista
   FROM artista;")) {
 	while($obj = $result->fetch_object()) {

    $art = stripslashes($obj->nombre_artista);
    $art = iconv('UTF-8', 'windows-1252', $art);
$pdf->Cell(50,5,$art,1,0,'C');
$pdf->ln();
}
}
$pdf->output();
?>
