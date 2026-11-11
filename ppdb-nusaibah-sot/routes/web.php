<?php

declare(strict_types=1);

/**
 * PPDB Online Pondok Pesantren Nusaibah Binti Kaab Tangerang
 * Web Routes Definition (Milestone M2 & M3)
 */

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\SantriController;
use App\Controllers\AdminController;
use App\Middleware\AuthMiddleware;
use App\Services\AuthService;

return [
    'GET' => [
        '/' => function (array $config): void {
            if (AuthService::check()) {
                $role = AuthService::role();
                if ($role === 'calon_santri') {
                    header('Location: /santri/dashboard');
                } else {
                    header('Location: /admin/dashboard');
                }
                exit;
            }
            require dirname(__DIR__) . '/app/Views/public/landing.php';
        },
        '/login' => function (): void {
            AuthMiddleware::guestOnly();
            (new AuthController())->showLogin();
        },
        '/register' => function (): void {
            AuthMiddleware::guestOnly();
            (new AuthController())->showRegister();
        },
        '/logout' => function (): void {
            (new AuthController())->logout();
        },
        '/admin/dashboard' => function (): void {
            AuthMiddleware::requireRole(['admin', 'panitia']);
            (new DashboardController())->admin();
        },
        '/admin/pendaftar' => function (): void {
            AuthMiddleware::requireRole(['admin', 'panitia']);
            (new AdminController())->showPendaftar();
        },
        '/santri/dashboard' => function (): void {
            AuthMiddleware::requireRole('calon_santri');
            (new DashboardController())->santri();
        },
        '/santri/formulir' => function (): void {
            AuthMiddleware::requireRole('calon_santri');
            (new SantriController())->showFormulir();
        },
        '/santri/bukti' => function (): void {
            AuthMiddleware::requireRole('calon_santri');
            (new SantriController())->showBukti();
        },
        '/health' => function (array $config): void {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'status' => 'ok',
                'milestone' => 'PPDB Nusaibah Online Pro',
                'app' => $config['app_name'],
                'auth_check' => AuthService::check(),
                'timestamp' => date('c'),
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        },
    ],
    'POST' => [
        '/login' => function (): void {
            (new AuthController())->processLogin();
        },
        '/register' => function (): void {
            (new AuthController())->processRegister();
        },
        '/logout' => function (): void {
            (new AuthController())->logout();
        },
        '/santri/formulir' => function (): void {
            AuthMiddleware::requireRole('calon_santri');
            (new SantriController())->saveFormulir();
        },
        '/admin/verifikasi' => function (): void {
            AuthMiddleware::requireRole(['admin', 'panitia']);
            (new AdminController())->updateVerifikasi();
        },
    ],
];
