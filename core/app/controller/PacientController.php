<?php
namespace App\Controller;

use App\Service\PacientService;
use App\Service\ReservationService;
use Request;
use Session;
use ViewEngine;

class PacientController {
    private PacientService $pacientService;

    public function __construct() {
        $this->pacientService = new PacientService();
    }

    public function index(): void {
        $query = Request::get('q');
        if (!empty($query)) {
            $pacients = $this->pacientService->searchPacients($query);
        } else {
            $pacients = $this->pacientService->getAllPacients();
        }

        ViewEngine::render('pacients/index.html.twig', [
            'pacients' => $pacients,
            'query' => $query
        ]);
    }

    public function new(): void {
        ViewEngine::render('pacients/new.html.twig');
    }

    public function create(): void {
        $errors = Request::validate([
            'name' => 'required',
            'lastname' => 'required'
        ]);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/pacient/new');
            exit;
        }

        $this->pacientService->createPacient(Request::post());
        Session::flash('success', 'Paciente registrado exitosamente.');
        header('Location: ' . $baseFolder . '/pacients');
        exit;
    }

    public function show(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $pacient = $this->pacientService->getPacientById($id);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!$pacient) {
            Session::flash('error', 'El paciente solicitado no existe.');
            header('Location: ' . $baseFolder . '/pacients');
            exit;
        }

        $reservations = \ReservationData::getAllByPacientId($id);

        ViewEngine::render('pacients/show.html.twig', [
            'pacient' => $pacient,
            'reservations' => $reservations
        ]);
    }

    public function edit(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $pacient = $this->pacientService->getPacientById($id);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!$pacient) {
            Session::flash('error', 'El paciente solicitado no existe.');
            header('Location: ' . $baseFolder . '/pacients');
            exit;
        }

        ViewEngine::render('pacients/edit.html.twig', [
            'pacient' => $pacient
        ]);
    }

    public function update(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $errors = Request::validate([
            'name' => 'required',
            'lastname' => 'required'
        ]);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/pacient/' . $id . '/edit');
            exit;
        }

        $this->pacientService->updatePacient($id, Request::post());
        Session::flash('success', 'Información del paciente actualizada.');
        header('Location: ' . $baseFolder . '/pacients');
        exit;
    }

    public function delete(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if ($this->pacientService->deletePacient($id)) {
            Session::flash('success', 'Paciente eliminado del sistema.');
        } else {
            Session::flash('error', 'No se pudo eliminar el paciente.');
        }

        header('Location: ' . $baseFolder . '/pacients');
        exit;
    }
}
