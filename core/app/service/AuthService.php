<?php
namespace App\Service;

/**
 * Clase AuthService
 * 
 * Servicio encargado de la lógica de autenticación,
 * inicio y cierre de sesión de BookMedik.
 */
class AuthService {
    /**
     * Procesa el inicio de sesión
     * @param string $username Nombre de usuario o correo
     * @param string $password Contraseña en texto plano
     * @return bool
     */
    public function login(string $username, string $password): bool {
        $user = \UserData::getLogin($username, $password);
        
        if ($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = trim(($user->name ?? '') . ' ' . ($user->lastname ?? ''));
            if (empty(trim($_SESSION['user_name']))) {
                $_SESSION['user_name'] = $user->username;
            }
            $_SESSION['username'] = $user->username;
            $_SESSION['is_admin'] = (!empty($user->is_admin) || (isset($user->kind) && $user->kind == 1)) ? 1 : 0;
            return true;
        }
        
        return false;
    }

    /**
     * Cierra la sesión activa
     */
    public function logout(): void {
        \Session::init();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['username']);
        unset($_SESSION['is_admin']);
        session_destroy();
    }

    /**
     * Verifica si existe un usuario autenticado
     * @return bool
     */
    public static function check(): bool {
        return isset($_SESSION['user_id']);
    }

    /**
     * Obtiene el usuario autenticado actual
     * @return \UserData|null
     */
    public static function user() {
        if (!self::check()) return null;
        return \UserData::find($_SESSION['user_id']);
    }
}
