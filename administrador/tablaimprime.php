<?php
require('../libreria/fpdf.php');
require_once("../usuarios/conexion.php");
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
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(50,5,"Correo",1,0,'C');
$pdf->Cell(50,5,"Nombre",1,0,'C');
$pdf->Cell(50,5,"Apellidos",1,0,'C');
$pdf->ln();
//Aquí escribimos lo que deseamos mostrar
 if ($result = $connection->query("SELECT *
  FROM usuarios;")) {
 	while($obj = $result->fetch_object()) {
$pdf->Cell(50,5,$obj->CORREO_ELECTRONICO,1,0,'C');
$nom = stripslashes($obj->NOMBRE);
$nom = iconv('UTF-8', 'windows-1252', $nom);
$pdf->Cell(50,5,$nom,1,0,'C');
$ap = stripslashes($obj->APELLIDOS);
$ap = iconv('UTF-8', 'windows-1252', $ap);
$pdf->Cell(50,5,$ap,1,0,'C');
$pdf->ln();
}
}
$pdf->output();
?>
