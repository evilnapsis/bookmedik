<?php
namespace App\Controller;

use App\Service\PacientService;
use App\Service\MedicService;
use App\Service\ReservationService;
use ViewEngine;

class HomeController {
    public function index(): void {
        $pacientService = new PacientService();
        $medicService = new MedicService();
        $reservationService = new ReservationService();

        $pacientsCount = count($pacientService->getAllPacients());
        $medicsCount = count($medicService->getAllMedics());
        $upcomingReservations = $reservationService->getUpcomingReservations();
        $pendingReservations = $reservationService->getPendingReservations();

        ViewEngine::render('home/index.html.twig', [
            'pacients_count' => $pacientsCount,
            'medics_count' => $medicsCount,
            'upcoming_count' => count($upcomingReservations),
            'pending_count' => count($pendingReservations),
            'recent_reservations' => array_slice($upcomingReservations, 0, 10),
        ]);
    }
}
