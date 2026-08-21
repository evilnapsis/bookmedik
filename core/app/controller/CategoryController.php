<?php
namespace App\Controller;

use App\Service\CategoryService;
use Request;
use Session;
use ViewEngine;

class CategoryController {
    private CategoryService $categoryService;

    public function __construct() {
        $this->categoryService = new CategoryService();
    }

    public function index(): void {
        $categories = $this->categoryService->getAllCategories();
        ViewEngine::render('categories/index.html.twig', [
            'categories' => $categories
        ]);
    }

    public function new(): void {
        ViewEngine::render('categories/new.html.twig');
    }

    public function create(): void {
        $errors = Request::validate(['name' => 'required']);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/category/new');
            exit;
        }

        $this->categoryService->createCategory(Request::post());
        Session::flash('success', 'Categoría / Especialidad creada con éxito.');
        header('Location: ' . $baseFolder . '/categories');
        exit;
    }

    public function edit(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $category = $this->categoryService->getCategoryById($id);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!$category) {
            Session::flash('error', 'La categoría especificada no existe.');
            header('Location: ' . $baseFolder . '/categories');
            exit;
        }

        ViewEngine::render('categories/edit.html.twig', [
            'category' => $category
        ]);
    }

    public function update(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $errors = Request::validate(['name' => 'required']);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/category/' . $id . '/edit');
            exit;
        }

        $this->categoryService->updateCategory($id, Request::post());
        Session::flash('success', 'Categoría actualizada exitosamente.');
        header('Location: ' . $baseFolder . '/categories');
        exit;
    }

    public function delete(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if ($this->categoryService->deleteCategory($id)) {
            Session::flash('success', 'Categoría eliminada del sistema.');
        } else {
            Session::flash('error', 'No se pudo eliminar la categoría.');
        }

        header('Location: ' . $baseFolder . '/categories');
        exit;
    }
}
