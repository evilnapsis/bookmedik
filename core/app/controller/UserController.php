<?php
namespace App\Controller;

use App\Service\UserService;
use Request;
use Session;
use ViewEngine;

class UserController {
    private UserService $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function index(): void {
        $users = $this->userService->getAllUsers();
        ViewEngine::render('users/index.html.twig', [
            'users' => $users
        ]);
    }

    public function new(): void {
        ViewEngine::render('users/new.html.twig');
    }

    public function create(): void {
        $errors = Request::validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/user/new');
            exit;
        }

        $this->userService->createUser(Request::post());
        Session::flash('success', 'Usuario registrado con éxito.');
        header('Location: ' . $baseFolder . '/users');
        exit;
    }

    public function edit(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $user = $this->userService->getUserById($id);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!$user) {
            Session::flash('error', 'El usuario solicitado no existe.');
            header('Location: ' . $baseFolder . '/users');
            exit;
        }

        ViewEngine::render('users/edit.html.twig', [
            'user' => $user
        ]);
    }

    public function update(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $errors = Request::validate([
            'name' => 'required',
            'username' => 'required'
        ]);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $baseFolder . '/user/' . $id . '/edit');
            exit;
        }

        $this->userService->updateUser($id, Request::post());
        Session::flash('success', 'Usuario actualizado correctamente.');
        header('Location: ' . $baseFolder . '/users');
        exit;
    }

    public function delete(array $vars): void {
        $id = (int)($vars['id'] ?? 0);
        $baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        if ($this->userService->deleteUser($id)) {
            Session::flash('success', 'Usuario eliminado del sistema.');
        } else {
            Session::flash('error', 'No se pudo eliminar el usuario.');
        }

        header('Location: ' . $baseFolder . '/users');
        exit;
    }
}
