<?php

/**
 * Clase Session
 * 
 * Gestiona el manejo de sesiones en PHP y el almacenamiento/recuperación
 * de mensajes de notificación flash de un solo uso entre redirecciones.
 */
class Session {
    /**
     * Inicializa la sesión de PHP si no se ha iniciado previamente
     */
    public static function init(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Establece un valor en la sesión
     * @param string $key Clave de sesión
     * @param mixed $value Valor a guardar
     */
    public static function set(string $key, $value): void {
        self::init();
        $_SESSION[$key] = $value;
    }

    /**
     * Obtiene un valor de la sesión
     * @param string $key Clave de sesión
     * @param mixed $default Valor por defecto si no existe la clave
     * @return mixed
     */
    public static function get(string $key, $default = null) {
        self::init();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Elimina un valor de la sesión
     * @param string $key Clave de sesión
     */
    public static function delete(string $key): void {
        self::init();
        unset($_SESSION[$key]);
    }

    /**
     * Guarda un mensaje flash en la sesión para la siguiente petición HTTP
     * @param string $type Tipo de mensaje ('success', 'error', 'info', 'warning')
     * @param string $message Texto de la notificación
     */
    public static function flash(string $type, string $message): void {
        self::init();
        $_SESSION['flash'][$type] = $message;
    }

    /**
     * Obtiene todos los mensajes flash guardados y los limpia de la sesión
     * @return array Arreglo de mensajes flash acumulados
     */
    public static function getFlashes(): array {
        self::init();
        $flashes = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $flashes;
    }

    /**
     * Genera un token CSRF si no existe, y lo retorna
     * @return string Token CSRF
     */
    public static function csrfToken(): string {
        self::init();
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Valida si un token es igual al almacenado en sesión
     * @param string|null $token Token a verificar
     * @return bool True si es válido, False en caso contrario
     */
    public static function validateCsrf(?string $token): bool {
        self::init();
        if (empty($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
}
