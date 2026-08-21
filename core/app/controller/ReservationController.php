<?php
namespace App\Controller;

use App\Service\ReservationService;
use App\Service\PacientService;
use App\Service\MedicService;
use Request;
use Session;
use ViewEngine;

class ReservationController {
    private ReservationService $reservationService;
    private PacientService $pacientService;
    private MedicService $medicService;

    public function __construct() {
        $this->reservationService = new ReservationService();
        $this->pacientService = new PacientService();
        $this->medicService = new MedicService();
    }

    public function index(): void {
        $filter = Request::get('filter', 'all');
        
        if ($filter === 'pending') {
            $reservations = $this->reservationService->getPendingReservations();
        } elseif ($filter === 'old') {
            $reservations = $this->reservationService->getOldReservations();
        } else {
            $reservations = $this->reservationService->getAllReservations();
        }

        $statuses = \StatusData::getAll();
        $payments = \PaymentData::getAll();

        ViewEngine::render('reservations/index.html.twig', [
            'reservations' => $reservations,
            'statuses' => $statuses,
            'payments' => $payments,
            'filter' => $filter
        ]);
    }

    public function calendar(): void {
        $events = \ReservationData::getEvery();
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        
        $thejson = [];
        foreach ($events as $event) {
            $title = $event->title;
            if (empty($title)) {
                $pacient = $event->getPacient();
                $medic = $event->getMedic();
                $title = ($pacient ? $pacient->name . ' ' . $pacient->lastname : 'Cita') . 
                         ($medic ? ' (Dr. ' . $medic->name . ')' : '');
            }
            
            $start = $event->date_at;
            if (!empty($event->time_at)) {
                $start .= 'T' . $event->time_at;
            }

            $thejson[] = [
                'id' => $event->id,
                'title' => $title,
                'url' => $baseFolder . '/reservation/' . $event->id . '/edit',
                'start' => $start
            ];
        }

        ViewEngine::render('reservations/calendar.html.twig', [
            'events_json' => json_encode($thejson)
        ]);
    }

    public function new(): void {
        $pacients = $this->pacientService->getAllPacients();
        $medics = $this->medicService->getAllMedics();
        $statuses = \StatusData::getAll();
        $payments = \PaymentData::getAll();

        ViewEngine::render('reservations/new.html.twig', [
            'pacients' => $pacients,
            'medics' => $medics,
            'statuses' => $statuses,
            'payments' => $payments
        ]);
    }

    public function create(): void {
        $errors = Request::validate([
            'pacient_id' => 'required',
            'medic_id' => 'required',
            'date_at' => 'required',
            'time_at' => 'required'
        ]);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/reservation/new');
            exit;
        }

        $userId = $_SESSION['user_id'] ?? 1;
        $this->reservationService->createReservation(Request::post(), $userId);
        Session::flash('success', 'Cita médica agendada correctamente.');
        header('Location: ' . $baseFolder . '/reservations');
        exit;
    }

    public function edit(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $reservation = $this->reservationService->getReservationById($id);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!$reservation) {
            Session::flash('error', 'La cita seleccionada no existe.');
            header('Location: ' . $baseFolder . '/reservations');
            exit;
        }

        $pacients = $this->pacientService->getAllPacients();
        $medics = $this->medicService->getAllMedics();
        $statuses = \StatusData::getAll();
        $payments = \PaymentData::getAll();

        ViewEngine::render('reservations/edit.html.twig', [
            'reservation' => $reservation,
            'pacients' => $pacients,
            'medics' => $medics,
            'statuses' => $statuses,
            'payments' => $payments
        ]);
    }

    public function update(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $errors = Request::validate([
            'pacient_id' => 'required',
            'medic_id' => 'required',
            'date_at' => 'required'
        ]);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/reservation/' . $id . '/edit');
            exit;
        }

        $this->reservationService->updateReservation($id, Request::post());
        Session::flash('success', 'Cita actualizada exitosamente.');
        header('Location: ' . $baseFolder . '/reservations');
        exit;
    }

    public function changeStatus(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $statusId = (int)Request::post('status_id', 1);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        $this->reservationService->changeStatus($id, $statusId);
        Session::flash('success', 'Estatus de la cita actualizado.');
        header('Location: ' . $baseFolder . '/reservations');
        exit;
    }

    public function delete(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if ($this->reservationService->deleteReservation($id)) {
            Session::flash('success', 'Cita cancelada y eliminada del sistema.');
        } else {
            Session::flash('error', 'No se pudo eliminar la cita.');
        }

        header('Location: ' . $baseFolder . '/reservations');
        exit;
    }

    public function pdf(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $reservation = $this->reservationService->getReservationById($id);
        if (!$reservation) {
            http_response_code(404);
            echo "Cita no encontrada";
            exit;
        }

        require_once __DIR__ . '/../../../fpdf/fpdf.php';

        $pacient = $reservation->getPacient();
        $medic = $reservation->getMedic();

        $pdf = new \FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',18);
        $pdf->Cell(0,10,mb_convert_encoding('BOOKMEDIK - REPORTE DE CITA', "ISO-8859-1", "UTF-8"),0,1,'C');
        $pdf->SetFont('Arial','I',10);
        $pdf->Cell(0,10,mb_convert_encoding('Sistema de Control de Citas Médicas', "ISO-8859-1", "UTF-8"),0,1,'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial','B',12);
        $pdf->SetFillColor(230,230,230);
        $pdf->Cell(0,10,mb_convert_encoding('DATOS DE LA CITA', "ISO-8859-1", "UTF-8"),1,1,'L',true);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50,10,'ID de Cita:',1,0); 
        $pdf->Cell(0,10,$reservation->id,1,1);
        $pdf->Cell(50,10,'Asunto:',1,0); 
        $pdf->Cell(0,10,mb_convert_encoding($reservation->title ?: 'Cita Médica', "ISO-8859-1", "UTF-8"),1,1);
        $pdf->Cell(50,10,'Fecha:',1,0); 
        $pdf->Cell(0,10,$reservation->date_at,1,1);
        $pdf->Cell(50,10,'Hora:',1,0); 
        $pdf->Cell(0,10,$reservation->time_at,1,1);
        $pdf->Ln(5);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,10,mb_convert_encoding('DATOS DEL PACIENTE', "ISO-8859-1", "UTF-8"),1,1,'L',true);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50,10,'Nombre:',1,0); 
        $pdf->Cell(0,10,mb_convert_encoding($pacient ? $pacient->name." ".$pacient->lastname : 'N/A', "ISO-8859-1", "UTF-8"),1,1);
        $pdf->Cell(50,10,'Email:',1,0); 
        $pdf->Cell(0,10,$pacient ? $pacient->email : 'N/A',1,1);
        $pdf->Ln(5);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,10,mb_convert_encoding('DATOS DEL MÉDICO', "ISO-8859-1", "UTF-8"),1,1,'L',true);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50,10,'Nombre:',1,0); 
        $pdf->Cell(0,10,mb_convert_encoding($medic ? "Dr. ".$medic->name." ".$medic->lastname : 'N/A', "ISO-8859-1", "UTF-8"),1,1);
        $pdf->Ln(10);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,10,mb_convert_encoding('DETALLES MÉDICOS', "ISO-8859-1", "UTF-8"),1,1,'L',true);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(0,8,mb_convert_encoding('Síntomas:', "ISO-8859-1", "UTF-8"),0,1);
        $pdf->SetFont('Arial','',11);
        $pdf->MultiCell(0,7,mb_convert_encoding($reservation->symtoms ?: 'Sin síntomas registrados', "ISO-8859-1", "UTF-8"),0,1);
        $pdf->Ln(2);

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(0,8,mb_convert_encoding('Diagnóstico/Notas:', "ISO-8859-1", "UTF-8"),0,1);
        $pdf->SetFont('Arial','',11);
        $pdf->MultiCell(0,7,mb_convert_encoding($reservation->sick ?: ($reservation->note ?: 'Sin notas'), "ISO-8859-1", "UTF-8"),0,1);
        $pdf->Ln(10);

        $pdf->SetFont('Arial','I',10);
        $pdf->Cell(0,10,'Generado el: '.date("d/m/Y H:i:s"),0,0,'R');

        $pdf->Output();
        exit;
    }
}
