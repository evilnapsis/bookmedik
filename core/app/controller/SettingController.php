<?php
namespace App\Controller;

use App\Service\SettingService;
use Request;
use Session;
use ViewEngine;

class SettingController {
    private SettingService $settingService;

    public function __construct() {
        $this->settingService = new SettingService();
    }

    public function index(): void {
        $settings = $this->settingService->getAllSettings();
        ViewEngine::render('settings/index.html.twig', [
            'settings' => $settings
        ]);
    }

    public function update(): void {
        $data = Request::post();
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        $this->settingService->updateSettings($data);
        Session::flash('success', 'Ajustes del sistema actualizados con éxito.');
        header('Location: ' . $baseFolder . '/settings');
        exit;
    }

    public function create(): void {
        $errors = Request::validate([
            'name' => 'required',
            'label' => 'required'
        ]);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/settings');
            exit;
        }

        $this->settingService->createSetting(Request::post());
        Session::flash('success', 'Nueva variable de configuración añadida.');
        header('Location: ' . $baseFolder . '/settings');
        exit;
    }
}
