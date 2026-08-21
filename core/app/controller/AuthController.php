<?php
namespace App\Controller;

use App\Service\AuthService;
use Request;
use Response;
use Session;
use ViewEngine;

class AuthController {
    private AuthService $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function showLogin(): void {
        if (AuthService::check()) {
            $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseFolder . '/');
            exit;
        }
        ViewEngine::render('auth/login.html.twig');
    }

    public function login(): void {
        $username = Request::post('username', '');
        $password = Request::post('password', '');

        if (empty($username) || empty($password)) {
            Session::flash('error', 'Por favor ingresa tu usuario/correo y contraseña.');
            $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseFolder . '/login');
            exit;
        }

        if ($this->authService->login($username, $password)) {
            Session::flash('success', '¡Bienvenido de nuevo a BookMedik!');
            $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseFolder . '/');
            exit;
        } else {
            Session::flash('error', 'Credenciales incorrectas. Verifica tus datos.');
            $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseFolder . '/login');
            exit;
        }
    }

    public function logout(): void {
        $this->authService->logout();
        Session::flash('info', 'Has cerrado sesión correctamente.');
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header('Location: ' . $baseFolder . '/login');
        exit;
    }
}
