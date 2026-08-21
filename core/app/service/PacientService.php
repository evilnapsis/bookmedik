<?php
namespace App\Service;

/**
 * Clase PacientService
 * 
 * Lógica de negocio para la administración de pacientes.
 */
class PacientService {
    public function getAllPacients(): array {
        return \PacientData::getAll();
    }

    public function getPacientById(int $id) {
        return \PacientData::find($id);
    }

    public function searchPacients(string $query): array {
        return \PacientData::getLike($query);
    }

    public function createPacient(array $data): bool {
        $pacient = new \PacientData();
        $pacient->no = trim($data['no'] ?? '');
        $pacient->name = trim($data['name'] ?? '');
        $pacient->lastname = trim($data['lastname'] ?? '');
        $pacient->gender = $data['gender'] ?? 'm';
        $pacient->day_of_birth = !empty($data['day_of_birth']) ? $data['day_of_birth'] : null;
        $pacient->email = trim($data['email'] ?? '');
        $pacient->address = trim($data['address'] ?? '');
        $pacient->phone = trim($data['phone'] ?? '');
        $pacient->sick = trim($data['sick'] ?? '');
        $pacient->medicaments = trim($data['medicaments'] ?? '');
        $pacient->alergy = trim($data['alergy'] ?? '');
        $pacient->created_at = date('Y-m-d H:i:s');
        return $pacient->save();
    }

    public function updatePacient(int $id, array $data): bool {
        $pacient = \PacientData::find($id);
        if (!$pacient) return false;

        $pacient->no = trim($data['no'] ?? $pacient->no);
        $pacient->name = trim($data['name'] ?? '');
        $pacient->lastname = trim($data['lastname'] ?? '');
        $pacient->gender = $data['gender'] ?? 'm';
        $pacient->day_of_birth = !empty($data['day_of_birth']) ? $data['day_of_birth'] : null;
        $pacient->email = trim($data['email'] ?? '');
        $pacient->address = trim($data['address'] ?? '');
        $pacient->phone = trim($data['phone'] ?? '');
        $pacient->sick = trim($data['sick'] ?? '');
        $pacient->medicaments = trim($data['medicaments'] ?? '');
        $pacient->alergy = trim($data['alergy'] ?? '');

        return $pacient->save();
    }

    public function deletePacient(int $id): bool {
        $pacient = \PacientData::find($id);
        return $pacient ? $pacient->delete() : false;
    }
}
