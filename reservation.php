<?php
include "core/autoload.php";
include "core/app/autoload.php";
require('fpdf/fpdf.php');

if(isset($_GET["id"])){
$reservation = ReservationData::getById($_GET["id"]);
$pacient = $reservation->getPacient();
$medic = $reservation->getMedic();

$pdf = new FPDF();
$pdf->AddPage();

// Logo o encabezado
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,10,'BOOKMEDIK - REPORTE DE CITA',0,1,'C');
$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,10,'Sistema de Control de Citas Medicas',0,1,'C');
$pdf->Ln(10);

// Datos de la cita
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(230,230,230);
$pdf->Cell(0,10,'DATOS DE LA CITA',1,1,'L',true);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,10,'ID de Cita:',1,0); 
$pdf->Cell(0,10,$reservation->id,1,1);
$pdf->Cell(50,10,'Asunto:',1,0); 
$pdf->Cell(0,10,mb_convert_encoding($reservation->title, "ISO-8859-1", "UTF-8"),1,1);
$pdf->Cell(50,10,'Fecha:',1,0); 
$pdf->Cell(0,10,$reservation->date_at,1,1);
$pdf->Cell(50,10,'Hora:',1,0); 
$pdf->Cell(0,10,$reservation->time_at,1,1);
$pdf->Ln(5);

// Datos del Paciente
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'DATOS DEL PACIENTE',1,1,'L',true);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,10,'Nombre:',1,0); 
$pdf->Cell(0,10,mb_convert_encoding($pacient->name." ".$pacient->lastname, "ISO-8859-1", "UTF-8"),1,1);
$pdf->Cell(50,10,'Email:',1,0); 
$pdf->Cell(0,10,$pacient->email,1,1);
$pdf->Ln(5);

// Datos del Medico
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'DATOS DEL MEDICO',1,1,'L',true);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,10,'Nombre:',1,0); 
$pdf->Cell(0,10,mb_convert_encoding($medic->name." ".$medic->lastname, "ISO-8859-1", "UTF-8"),1,1);
$pdf->Ln(10);

// Detalles medicos
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'DETALLES MEDICOS',1,1,'L',true);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,'Sintomas:',0,1);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,7,mb_convert_encoding($reservation->symtoms, "ISO-8859-1", "UTF-8"),0,1);
$pdf->Ln(2);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,'Diagnostico/Enfermedad:',0,1);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,7,mb_convert_encoding($reservation->sick, "ISO-8859-1", "UTF-8"),0,1);
$pdf->Ln(2);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,8,'Medicamentos:',0,1);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,7,mb_convert_encoding($reservation->medicaments, "ISO-8859-1", "UTF-8"),0,1);
$pdf->Ln(10);

$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,10,'Generado el: '.date("d/m/Y H:i:s"),0,0,'R');

$pdf->Output();
}
?>
