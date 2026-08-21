<?php
namespace App\Service;

/**
 * Clase ReportService
 * 
 * Lógica de negocio para filtrado y generación de reportes.
 */
class ReportService {
    public function generateReport(array $filters): array {
        return \ReservationData::getByFilter($filters);
    }
}
