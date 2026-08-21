<?php
namespace App\Service;

/**
 * Clase UserService
 * 
 * Lógica de negocio para la administración de usuarios del sistema.
 */
class UserService {
    public function getAllUsers(): array {
        return \UserData::getAll();
    }

    public function getUserById(int $id) {
        return \UserData::find($id);
    }

    public function createUser(array $data): bool {
        $user = new \UserData();
        $user->name = trim($data['name'] ?? '');
        $user->lastname = trim($data['lastname'] ?? '');
        $user->username = trim($data['username'] ?? '');
        $user->email = trim($data['email'] ?? '');
        $isAdmin = !empty($data['is_admin']) || (isset($data['kind']) && $data['kind'] == 1) ? 1 : 0;
        $user->is_admin = $isAdmin;
        $user->kind = $isAdmin ? 1 : 2;
        $user->is_active = 1;
        $user->created_at = date('Y-m-d H:i:s');

        $plainPassword = $data['password'] ?? 'admin';
        $user->password = password_hash($plainPassword, PASSWORD_DEFAULT);

        return $user->save();
    }

    public function updateUser(int $id, array $data): bool {
        $user = \UserData::find($id);
        if (!$user) return false;

        $user->name = trim($data['name'] ?? '');
        $user->lastname = trim($data['lastname'] ?? '');
        $user->username = trim($data['username'] ?? '');
        $user->email = trim($data['email'] ?? '');

        if (isset($data['is_admin']) || isset($data['kind'])) {
            $isAdmin = !empty($data['is_admin']) || (isset($data['kind']) && $data['kind'] == 1) ? 1 : 0;
            $user->is_admin = $isAdmin;
            $user->kind = $isAdmin ? 1 : 2;
        }

        if (isset($data['is_active'])) {
            $user->is_active = (int)$data['is_active'];
        }

        if (!empty($data['password'])) {
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $user->save();
    }

    public function deleteUser(int $id): bool {
        $user = \UserData::find($id);
        return $user ? $user->delete() : false;
    }
}
