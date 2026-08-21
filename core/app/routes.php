<?php
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\PacientController;
use App\Controller\MedicController;
use App\Controller\CategoryController;
use App\Controller\ReservationController;
use App\Controller\UserController;
use App\Controller\ReportController;
use App\Controller\SettingController;

return function(FastRoute\RouteCollector $r) {
    // Rutas públicas y de autenticación
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    $r->addRoute('GET', '/login', [AuthController::class, 'showLogin']);
    $r->addRoute('POST', '/login', [AuthController::class, 'login']);
    $r->addRoute('GET', '/logout', [AuthController::class, 'logout']);

    // Rutas de Pacientes
    $r->addRoute('GET', '/pacients', [PacientController::class, 'index']);
    $r->addRoute('GET', '/pacient/new', [PacientController::class, 'new']);
    $r->addRoute('POST', '/pacient/create', [PacientController::class, 'create']);
    $r->addRoute('GET', '/pacient/{id:\d+}', [PacientController::class, 'show']);
    $r->addRoute('GET', '/pacient/{id:\d+}/edit', [PacientController::class, 'edit']);
    $r->addRoute('POST', '/pacient/{id:\d+}/update', [PacientController::class, 'update']);
    $r->addRoute('POST', '/pacient/{id:\d+}/delete', [PacientController::class, 'delete']);

    // Rutas de Médicos
    $r->addRoute('GET', '/medics', [MedicController::class, 'index']);
    $r->addRoute('GET', '/medic/new', [MedicController::class, 'new']);
    $r->addRoute('POST', '/medic/create', [MedicController::class, 'create']);
    $r->addRoute('GET', '/medic/{id:\d+}', [MedicController::class, 'show']);
    $r->addRoute('GET', '/medic/{id:\d+}/edit', [MedicController::class, 'edit']);
    $r->addRoute('POST', '/medic/{id:\d+}/update', [MedicController::class, 'update']);
    $r->addRoute('POST', '/medic/{id:\d+}/delete', [MedicController::class, 'delete']);

    // Rutas de Categorías / Especialidades
    $r->addRoute('GET', '/categories', [CategoryController::class, 'index']);
    $r->addRoute('GET', '/category/new', [CategoryController::class, 'new']);
    $r->addRoute('POST', '/category/create', [CategoryController::class, 'create']);
    $r->addRoute('GET', '/category/{id:\d+}/edit', [CategoryController::class, 'edit']);
    $r->addRoute('POST', '/category/{id:\d+}/update', [CategoryController::class, 'update']);
    $r->addRoute('POST', '/category/{id:\d+}/delete', [CategoryController::class, 'delete']);

    // Rutas de Citas / Reservaciones
    $r->addRoute('GET', '/reservations', [ReservationController::class, 'index']);
    $r->addRoute('GET', '/calendar', [ReservationController::class, 'calendar']);
    $r->addRoute('GET', '/reservation/new', [ReservationController::class, 'new']);
    $r->addRoute('POST', '/reservation/create', [ReservationController::class, 'create']);
    $r->addRoute('GET', '/reservation/{id:\d+}/edit', [ReservationController::class, 'edit']);
    $r->addRoute('POST', '/reservation/{id:\d+}/update', [ReservationController::class, 'update']);
    $r->addRoute('POST', '/reservation/{id:\d+}/status', [ReservationController::class, 'changeStatus']);
    $r->addRoute('POST', '/reservation/{id:\d+}/delete', [ReservationController::class, 'delete']);
    $r->addRoute('GET', '/reservation/{id:\d+}/pdf', [ReservationController::class, 'pdf']);

    // Rutas de Reportes
    $r->addRoute('GET', '/reports', [ReportController::class, 'index']);
    $r->addRoute('GET', '/reports/pdf', [ReportController::class, 'pdf']);

    // Rutas de Ajustes del Sistema
    $r->addRoute('GET', '/settings', [SettingController::class, 'index']);
    $r->addRoute('POST', '/settings/update', [SettingController::class, 'update']);
    $r->addRoute('POST', '/settings/create', [SettingController::class, 'create']);

    // Rutas de Usuarios
    $r->addRoute('GET', '/users', [UserController::class, 'index']);
    $r->addRoute('GET', '/user/new', [UserController::class, 'new']);
    $r->addRoute('POST', '/user/create', [UserController::class, 'create']);
    $r->addRoute('GET', '/user/{id:\d+}/edit', [UserController::class, 'edit']);
    $r->addRoute('POST', '/user/{id:\d+}/update', [UserController::class, 'update']);
    $r->addRoute('POST', '/user/{id:\d+}/delete', [UserController::class, 'delete']);
};
