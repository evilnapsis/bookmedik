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
        $todayReservations = $reservationService->getTodayReservations();
        $allReservations = $reservationService->getAllReservations();

        // Obtener resúmenes estadísticos
        $statusSummary = $reservationService->getStatusSummary();
        $monthlySummary = $reservationService->getMonthlySummary(6);
        $specialtySummary = $reservationService->getSpecialtySummary(6);
        $kpiSummary = $reservationService->getKpiSummary();

        // Mapeo de meses en español
        $meses = [
            '01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr',
            '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago',
            '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic'
        ];

        $chartMonthlyLabels = [];
        $chartMonthlyCompleted = [];
        $chartMonthlyPending = [];
        $chartMonthlyTotal = [];
        $chartMonthlyRevenue = [];

        foreach ($monthlySummary as $item) {
            $parts = explode('-', $item['period']);
            $label = ($meses[$parts[1]] ?? $parts[1]) . ' ' . $parts[0];
            $chartMonthlyLabels[] = $label;
            $chartMonthlyCompleted[] = (int)($item['completed_appointments'] ?? 0);
            $chartMonthlyPending[] = (int)($item['pending_appointments'] ?? 0);
            $chartMonthlyTotal[] = (int)($item['total_appointments'] ?? 0);
            $chartMonthlyRevenue[] = (float)($item['total_revenue'] ?? 0);
        }

        // Datos para gráfica de estatus
        $statusColorMap = [
            1 => '#f59e0b', // Pendiente - Ámbar
            2 => '#10b981', // Aplicada - Verde
            3 => '#64748b', // No asistió - Slate
            4 => '#ef4444', // Cancelada - Rojo
        ];
        $chartStatusLabels = [];
        $chartStatusData = [];
        $chartStatusColors = [];

        foreach ($statusSummary as $st) {
            $chartStatusLabels[] = $st['name'];
            $chartStatusData[] = (int)$st['total'];
            $chartStatusColors[] = $statusColorMap[$st['id']] ?? '#3b82f6';
        }

        // Datos para gráfica de especialidades
        $chartSpecialtyLabels = [];
        $chartSpecialtyData = [];
        foreach ($specialtySummary as $sp) {
            $chartSpecialtyLabels[] = $sp['name'];
            $chartSpecialtyData[] = (int)$sp['total'];
        }

        // Cálculo de métricas adicionales
        $totalCitas = (int)($kpiSummary['total_reservations'] ?? count($allReservations));
        $aplicadas = 0;
        foreach ($statusSummary as $s) {
            if ($s['id'] == 2) $aplicadas = (int)$s['total'];
        }
        $asistenciaTasa = $totalCitas > 0 ? round(($aplicadas / $totalCitas) * 100, 1) : 0;

        ViewEngine::render('home/index.html.twig', [
            'pacients_count' => $pacientsCount,
            'medics_count' => $medicsCount,
            'today_count' => count($todayReservations),
            'upcoming_count' => count($upcomingReservations),
            'pending_count' => count($pendingReservations),
            'total_reservations' => $totalCitas,
            'total_revenue' => (float)($kpiSummary['total_paid'] ?? 0),
            'attendance_rate' => $asistenciaTasa,
            'recent_reservations' => array_slice($upcomingReservations, 0, 8),
            'chart_monthly_labels' => json_encode($chartMonthlyLabels),
            'chart_monthly_completed' => json_encode($chartMonthlyCompleted),
            'chart_monthly_pending' => json_encode($chartMonthlyPending),
            'chart_monthly_total' => json_encode($chartMonthlyTotal),
            'chart_monthly_revenue' => json_encode($chartMonthlyRevenue),
            'chart_status_labels' => json_encode($chartStatusLabels),
            'chart_status_data' => json_encode($chartStatusData),
            'chart_status_colors' => json_encode($chartStatusColors),
            'chart_specialty_labels' => json_encode($chartSpecialtyLabels),
            'chart_specialty_data' => json_encode($chartSpecialtyData),
            'status_summary' => $statusSummary,
            'specialty_summary' => $specialtySummary,
        ]);
    }
}
