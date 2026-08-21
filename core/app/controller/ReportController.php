<?php
namespace App\Controller;

use App\Service\ReportService;
use App\Service\PacientService;
use App\Service\MedicService;
use Request;
use ViewEngine;

class ReportController {
    private ReportService $reportService;
    private PacientService $pacientService;
    private MedicService $medicService;

    public function __construct() {
        $this->reportService = new ReportService();
        $this->pacientService = new PacientService();
        $this->medicService = new MedicService();
    }

    public function index(): void {
        $filters = [
            'medic_id' => Request::get('medic_id'),
            'pacient_id' => Request::get('pacient_id'),
            'status_id' => Request::get('status_id'),
            'start_at' => Request::get('start_at'),
            'finish_at' => Request::get('finish_at'),
        ];

        $hasFilters = array_filter($filters);
        $reservations = !empty($hasFilters) ? $this->reportService->generateReport($filters) : [];

        $pacients = $this->pacientService->getAllPacients();
        $medics = $this->medicService->getAllMedics();
        $statuses = \StatusData::getAll();

        ViewEngine::render('reports/index.html.twig', [
            'reservations' => $reservations,
            'pacients' => $pacients,
            'medics' => $medics,
            'statuses' => $statuses,
            'filters' => $filters,
            'has_filters' => !empty($hasFilters)
        ]);
    }

    public function pdf(): void {
        $filters = [
            'medic_id' => Request::get('medic_id'),
            'pacient_id' => Request::get('pacient_id'),
            'status_id' => Request::get('status_id'),
            'start_at' => Request::get('start_at'),
            'finish_at' => Request::get('finish_at'),
        ];

        $reservations = $this->reportService->generateReport($filters);

        require_once __DIR__ . '/../../../fpdf/fpdf.php';

        $pdf = new \FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',18);
        $pdf->Cell(0,10,mb_convert_encoding('BOOKMEDIK - REPORTE DE CITAS', "ISO-8859-1", "UTF-8"),0,1,'C');
        $pdf->SetFont('Arial','I',10);
        $pdf->Cell(0,10,mb_convert_encoding('Resultados de búsqueda personalizada', "ISO-8859-1", "UTF-8"),0,1,'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetFillColor(200,200,200);
        $pdf->Cell(40,10,'Asunto',1,0,'C',true);
        $pdf->Cell(40,10,'Paciente',1,0,'C',true);
        $pdf->Cell(40,10,'Medico',1,0,'C',true);
        $pdf->Cell(30,10,'Fecha',1,0,'C',true);
        $pdf->Cell(20,10,'Estatus',1,0,'C',true);
        $pdf->Cell(20,10,'Costo',1,1,'C',true);

        $pdf->SetFont('Arial','',9);
        $total = 0;
        foreach($reservations as $r){
            $pacient = $r->getPacient();
            $medic = $r->getMedic();
            $status = $r->getStatus();

            $h = 8;
            $pdf->Cell(40,$h,mb_convert_encoding(substr($r->title ?: 'Cita', 0, 20), "ISO-8859-1", "UTF-8"),1,0);
            $pdf->Cell(40,$h,mb_convert_encoding(substr($pacient ? $pacient->name." ".$pacient->lastname : 'N/A', 0, 20), "ISO-8859-1", "UTF-8"),1,0);
            $pdf->Cell(40,$h,mb_convert_encoding(substr($medic ? $medic->name." ".$medic->lastname : 'N/A', 0, 20), "ISO-8859-1", "UTF-8"),1,0);
            $pdf->Cell(30,$h,$r->date_at,1,0);
            $pdf->Cell(20,$h,mb_convert_encoding($status ? $status->name : 'N/A', "ISO-8859-1", "UTF-8"),1,0);
            $pdf->Cell(20,$h,number_format($r->price, 2),1,1,'R');

            $total += $r->price;
        }

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(170,10,'TOTAL: ',0,0,'R');
        $pdf->Cell(20,10,'$ '.number_format($total,2),0,1,'R');

        $pdf->Ln(10);
        $pdf->SetFont('Arial','I',10);
        $pdf->Cell(0,10,'Generado el: '.date("d/m/Y H:i:s"),0,0,'R');

        $pdf->Output();
        exit;
    }
}
