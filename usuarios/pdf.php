<?php
	require("printhtml.php");
	  $a=$_GET['id'];
                              require_once("conexion.php");
	                                     if ($result = $connection->query("SELECT *
	                                        FROM ARTISTA  where NOMBRE='$a';")) {
	                                             while($obj = $result->fetch_object()) {
	                                             	$pdf=new PDF_HTML();
	                                              		$pdf->AddPage();
	                                             	$pdf->SetFont('Arial','',14);
	                                             	$titular = stripslashes($obj->NOMBRE);
													$titular = iconv('UTF-8', 'windows-1252', $titular);
	                                             	$pdf->WriteHTML($titular,'FJ');
	                                             	$pdf->ln(20);
	                                             	$cuerpo = stripslashes($obj->DESCRIPCION);
													$cuerpo = iconv('UTF-8', 'windows-1252', $cuerpo);
	                                             	$pdf->WriteHTML($cuerpo);
	                                             	$pdf->output();
	                                             	}
	                                             }
	                                              $result->close();
 													unset($obj);
 												unset($connection);
