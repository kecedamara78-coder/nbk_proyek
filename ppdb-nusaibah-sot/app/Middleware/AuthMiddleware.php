<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Services\AuthService;
use App\Services\Session;

class AuthMiddleware
{
    public static function requireAuth(): void
    {
        if (!AuthService::check()) {
            Session::setFlash('error', 'Silakan masuk ke akun Anda terlebih dahulu.');
            header('Location: /login');
            exit;
        }
    }

    public static function requireRole(string|array $roles): void
    {
        self::requireAuth();

        if (!AuthService::hasRole($roles)) {
            Session::setFlash('error', 'Anda tidak memiliki hak akses ke halaman tersebut.');
            $currentRole = AuthService::role();
            if ($currentRole === 'calon_santri') {
                header('Location: /santri/dashboard');
            } else {
                header('Location: /admin/dashboard');
            }
            exit;
        }
    }

    public static function guestOnly(): void
    {
        if (AuthService::check()) {
            $role = AuthService::role();
            if ($role === 'calon_santri') {
                header('Location: /santri/dashboard');
            } else {
                header('Location: /admin/dashboard');
            }
            exit;
        }
    }
}

