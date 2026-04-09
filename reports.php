<?php
include "core/autoload.php";
include "core/app/autoload.php";
require('fpdf/fpdf.php');

session_start();

if(isset($_SESSION["user_id"])){

$sql = "select * from reservation where ";
$active_filter = false;

if(isset($_GET["status_id"]) && $_GET["status_id"]!=""){
	$sql .= " status_id = ".$_GET["status_id"];
    $active_filter = true;
}

if(isset($_GET["payment_id"]) && $_GET["payment_id"]!=""){
    if($active_filter) { $sql .= " and "; }
	$sql .= " payment_id = ".$_GET["payment_id"];
    $active_filter = true;
}

if(isset($_GET["pacient_id"]) && $_GET["pacient_id"]!=""){
    if($active_filter) { $sql .= " and "; }
	$sql .= " pacient_id = ".$_GET["pacient_id"];
    $active_filter = true;
}

if(isset($_GET["medic_id"]) && $_GET["medic_id"]!=""){
    if($active_filter) { $sql .= " and "; }
	$sql .= " medic_id = ".$_GET["medic_id"];
    $active_filter = true;
}

if(isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){
    if($active_filter) { $sql .= " and "; }
	$sql .= " ( date_at >= \"".$_GET["start_at"]."\" and date_at <= \"".$_GET["finish_at"]."\" ) ";
    $active_filter = true;
}

if(!$active_filter){
	$users = ReservationData::getAllPendings();
} else {
    $users = ReservationData::getBySQL($sql);
}

$pdf = new FPDF();
$pdf->AddPage();

// Logo o encabezado
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,10,'BOOKMEDIK - REPORTE DE CITAS',0,1,'C');
$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,10,'Resultados de busqueda personalizada',0,1,'C');
$pdf->Ln(10);

// Tabla
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(40,10,'Asunto',1,0,'C',true);
$pdf->Cell(40,10,'Paciente',1,0,'C',true);
$pdf->Cell(40,10,'Medico',1,0,'C',true);
$pdf->Cell(30,10,'Fecha',1,0,'C',true);
$pdf->Cell(20,10,'Pago',1,0,'C',true);
$pdf->Cell(20,10,'Costo',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$total = 0;
foreach($users as $user){
    $pacient = $user->getPacient();
    $medic = $user->getMedic();
    
    $h = 8;
    $pdf->Cell(40,$h,mb_convert_encoding(substr($user->title,0,20), "ISO-8859-1", "UTF-8"),1,0);
    $pdf->Cell(40,$h,mb_convert_encoding(substr($pacient->name." ".$pacient->lastname,0,20), "ISO-8859-1", "UTF-8"),1,0);
    $pdf->Cell(40,$h,mb_convert_encoding(substr($medic->name." ".$medic->lastname,0,20), "ISO-8859-1", "UTF-8"),1,0);
    $pdf->Cell(30,$h,$user->date_at,1,0);
    $pdf->Cell(20,$h,mb_convert_encoding($user->getPayment()->name, "ISO-8859-1", "UTF-8"),1,0);
    $pdf->Cell(20,$h,number_format($user->price,2),1,1,'R');
    
    $total += $user->price;
}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(170,10,'TOTAL: ',0,0,'R');
$pdf->Cell(20,10,'$ '.number_format($total,2),0,1,'R');

$pdf->Ln(10);
$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,10,'Generado el: '.date("d/m/Y H:i:s"),0,0,'R');

$pdf->Output();

} else {
    header("Location: ./");
}
?>
