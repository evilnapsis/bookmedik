<?php
namespace App\Controller;

use App\Service\MedicService;
use App\Service\CategoryService;
use Request;
use Session;
use ViewEngine;

class MedicController {
    private MedicService $medicService;
    private CategoryService $categoryService;

    public function __construct() {
        $this->medicService = new MedicService();
        $this->categoryService = new CategoryService();
    }

    public function index(): void {
        $query = Request::get('q');
        if (!empty($query)) {
            $medics = $this->medicService->searchMedics($query);
        } else {
            $medics = $this->medicService->getAllMedics();
        }

        ViewEngine::render('medics/index.html.twig', [
            'medics' => $medics,
            'query' => $query
        ]);
    }

    public function new(): void {
        $categories = $this->categoryService->getAllCategories();
        ViewEngine::render('medics/new.html.twig', [
            'categories' => $categories
        ]);
    }

    public function create(): void {
        $errors = Request::validate([
            'name' => 'required',
            'lastname' => 'required'
        ]);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/medic/new');
            exit;
        }

        $this->medicService->createMedic(Request::post());
        Session::flash('success', 'Médico registrado correctamente.');
        header('Location: ' . $baseFolder . '/medics');
        exit;
    }

    public function show(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $medic = $this->medicService->getMedicById($id);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!$medic) {
            Session::flash('error', 'El médico solicitado no existe.');
            header('Location: ' . $baseFolder . '/medics');
            exit;
        }

        $reservations = \ReservationData::getAllByMedicId($id);

        ViewEngine::render('medics/show.html.twig', [
            'medic' => $medic,
            'reservations' => $reservations
        ]);
    }

    public function edit(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $medic = $this->medicService->getMedicById($id);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!$medic) {
            Session::flash('error', 'El médico solicitado no existe.');
            header('Location: ' . $baseFolder . '/medics');
            exit;
        }

        $categories = $this->categoryService->getAllCategories();

        ViewEngine::render('medics/edit.html.twig', [
            'medic' => $medic,
            'categories' => $categories
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
            header('Location: ' . $baseFolder . '/medic/' . $id . '/edit');
            exit;
        }

        $this->medicService->updateMedic($id, Request::post());
        Session::flash('success', 'Médico actualizado exitosamente.');
        header('Location: ' . $baseFolder . '/medics');
        exit;
    }

    public function delete(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if ($this->medicService->deleteMedic($id)) {
            Session::flash('success', 'Médico eliminado del sistema.');
        } else {
            Session::flash('error', 'No se pudo eliminar el médico.');
        }

        header('Location: ' . $baseFolder . '/medics');
        exit;
    }
}
