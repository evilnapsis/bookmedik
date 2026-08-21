<?php
namespace App\Service;

/**
 * Clase CategoryService
 * 
 * Lógica de negocio para las categorías de médicos / especialidades.
 */
class CategoryService {
    public function getAllCategories(): array {
        return \CategoryData::getAll();
    }

    public function getCategoryById(int $id) {
        return \CategoryData::find($id);
    }

    public function createCategory(array $data): bool {
        $category = new \CategoryData();
        $category->name = trim($data['name'] ?? '');
        return $category->save();
    }

    public function updateCategory(int $id, array $data): bool {
        $category = \CategoryData::find($id);
        if (!$category) return false;

        $category->name = trim($data['name'] ?? '');
        return $category->save();
    }

    public function deleteCategory(int $id): bool {
        $category = \CategoryData::find($id);
        return $category ? $category->delete() : false;
    }
}
