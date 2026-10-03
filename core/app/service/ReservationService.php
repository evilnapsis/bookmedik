<?php
namespace App\Service;

/**
 * Clase ReservationService
 * 
 * Lógica de negocio para las citas médicas (reservaciones).
 */
class ReservationService {
    public function getAllReservations(): array {
        return \ReservationData::getEvery();
    }

    public function getUpcomingReservations(): array {
        return \ReservationData::getAll();
    }

    public function getPendingReservations(): array {
        return \ReservationData::getAllPendings();
    }

    public function getTodayReservations(): array {
        return \ReservationData::getToday();
    }

    public function getOldReservations(): array {
        return \ReservationData::getOld();
    }

    public function getReservationById(int $id) {
        return \ReservationData::find($id);
    }

    public function createReservation(array $data, int $userId): bool {
        $reservation = new \ReservationData();
        $reservation->title = trim($data['title'] ?? '');
        $reservation->note = trim($data['note'] ?? '');
        $reservation->message = trim($data['message'] ?? '');
        $reservation->date_at = $data['date_at'] ?? date('Y-m-d');
        $reservation->time_at = $data['time_at'] ?? date('H:i');
        $reservation->pacient_id = (int)($data['pacient_id'] ?? 0);
        $reservation->medic_id = (int)($data['medic_id'] ?? 0);
        $reservation->user_id = $userId;
        $reservation->price = (float)($data['price'] ?? 0);
        $reservation->status_id = (int)($data['status_id'] ?? 1);
        $reservation->payment_id = (int)($data['payment_id'] ?? 1);
        $reservation->sick = trim($data['sick'] ?? '');
        $reservation->symtoms = trim($data['symtoms'] ?? '');
        $reservation->medicaments = trim($data['medicaments'] ?? '');
        $reservation->created_at = date('Y-m-d H:i:s');

        return $reservation->save();
    }

    public function updateReservation(int $id, array $data): bool {
        $reservation = \ReservationData::find($id);
        if (!$reservation) return false;

        $reservation->title = trim($data['title'] ?? '');
        $reservation->note = trim($data['note'] ?? '');
        $reservation->date_at = $data['date_at'] ?? $reservation->date_at;
        $reservation->time_at = $data['time_at'] ?? $reservation->time_at;
        $reservation->pacient_id = (int)($data['pacient_id'] ?? $reservation->pacient_id);
        $reservation->medic_id = (int)($data['medic_id'] ?? $reservation->medic_id);
        $reservation->price = (float)($data['price'] ?? $reservation->price);
        $reservation->status_id = (int)($data['status_id'] ?? $reservation->status_id);
        $reservation->payment_id = (int)($data['payment_id'] ?? $reservation->payment_id);
        $reservation->sick = trim($data['sick'] ?? $reservation->sick);
        $reservation->symtoms = trim($data['symtoms'] ?? $reservation->symtoms);
        $reservation->medicaments = trim($data['medicaments'] ?? $reservation->medicaments);

        return $reservation->save();
    }

    public function changeStatus(int $id, int $statusId): bool {
        $reservation = \ReservationData::find($id);
        if (!$reservation) return false;
        $reservation->status_id = $statusId;
        return $reservation->save();
    }

    public function deleteReservation(int $id): bool {
        $reservation = \ReservationData::find($id);
        return $reservation ? $reservation->delete() : false;
    }

    public function filterReservations(array $filters): array {
        return \ReservationData::getByFilter($filters);
    }

    public function getStatusSummary(): array {
        return \ReservationData::getStatusSummary();
    }

    public function getMonthlySummary(int $limit = 6): array {
        return \ReservationData::getMonthlySummary($limit);
    }

    public function getSpecialtySummary(int $limit = 6): array {
        return \ReservationData::getSpecialtySummary($limit);
    }

    public function getKpiSummary(): array {
        return \ReservationData::getKpiSummary();
    }
}
