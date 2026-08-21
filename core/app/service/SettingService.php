<?php
namespace App\Service;

/**
 * Clase SettingService
 * 
 * Lógica de negocio para administración de ajustes y variables globales del sistema.
 */
class SettingService {
    public function getAllSettings(): array {
        return \SettingData::getAll();
    }

    public function updateSettings(array $settingsData): void {
        foreach ($settingsData as $name => $val) {
            if ($name !== 'csrf_token') {
                \SettingData::updateValFromName($name, (string)$val);
            }
        }
    }

    public function createSetting(array $data): bool {
        $setting = new \SettingData();
        $setting->name = trim($data['name'] ?? '');
        $setting->label = trim($data['label'] ?? '');
        $setting->val = trim($data['val'] ?? '');
        return $setting->save();
    }
}
