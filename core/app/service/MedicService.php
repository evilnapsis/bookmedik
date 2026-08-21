<?php
namespace App\Service;

/**
 * Clase MedicService
 * 
 * Lógica de negocio para la administración de médicos.
 */
class MedicService {
    public function getAllMedics(): array {
        return \MedicData::getAll();
    }

    public function getMedicById(int $id) {
        return \MedicData::find($id);
    }

    public function searchMedics(string $query): array {
        return \MedicData::getLike($query);
    }

    public function createMedic(array $data): bool {
        $medic = new \MedicData();
        $medic->no = trim($data['no'] ?? '');
        $medic->name = trim($data['name'] ?? '');
        $medic->lastname = trim($data['lastname'] ?? '');
        $medic->gender = $data['gender'] ?? 'm';
        $medic->day_of_birth = !empty($data['day_of_birth']) ? $data['day_of_birth'] : null;
        $medic->email = trim($data['email'] ?? '');
        $medic->address = trim($data['address'] ?? '');
        $medic->phone = trim($data['phone'] ?? '');
        $medic->category_id = !empty($data['category_id']) ? (int)$data['category_id'] : null;
        $medic->is_active = 1;
        $medic->created_at = date('Y-m-d H:i:s');
        return $medic->save();
    }

    public function updateMedic(int $id, array $data): bool {
        $medic = \MedicData::find($id);
        if (!$medic) return false;

        $medic->no = trim($data['no'] ?? $medic->no);
        $medic->name = trim($data['name'] ?? '');
        $medic->lastname = trim($data['lastname'] ?? '');
        $medic->gender = $data['gender'] ?? 'm';
        $medic->day_of_birth = !empty($data['day_of_birth']) ? $data['day_of_birth'] : null;
        $medic->email = trim($data['email'] ?? '');
        $medic->address = trim($data['address'] ?? '');
        $medic->phone = trim($data['phone'] ?? '');
        $medic->category_id = !empty($data['category_id']) ? (int)$data['category_id'] : null;

        return $medic->save();
    }

    public function deleteMedic(int $id): bool {
        $medic = \MedicData::find($id);
        return $medic ? $medic->delete() : false;
    }
}
