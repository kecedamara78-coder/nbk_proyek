<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\CalonSantri;

class AuthService
{
    public const SESSION_USER_KEY = 'auth_user';

    public static function user(): ?array
    {
        return Session::get(self::SESSION_USER_KEY);
    }

    public static function check(): bool
    {
        return Session::has(self::SESSION_USER_KEY);
    }

    public static function id(): ?int
    {
        $user = self::user();
        return $user ? (int) $user['id'] : null;
    }

    public static function role(): ?string
    {
        $user = self::user();
        return $user['role'] ?? null;
    }

    public static function hasRole(string|array $roles): bool
    {
        $current = self::role();
        if (!$current) {
            return false;
        }

        if (is_array($roles)) {
            return in_array($current, $roles, true);
        }

        return $current === $roles;
    }

    public static function login(array $user): void
    {
        Session::regenerate();
        Session::set(self::SESSION_USER_KEY, [
            'id' => $user['id'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'no_hp' => $user['no_hp'],
            'role' => $user['role'],
            'logged_at' => time(),
        ]);
    }

    public static function attempt(string $identifier, string $password): bool
    {
        $identifier = trim($identifier);

        // Can log in with email or no_hp
        $user = str_contains($identifier, '@')
            ? User::findByEmail($identifier)
            : User::findByNoHp($identifier);

        if (!$user) {
            return false;
        }

        if ($user['status'] !== 'aktif') {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        self::login($user);
        return true;
    }

    public static function logout(): void
    {
        Session::remove(self::SESSION_USER_KEY);
        Session::destroy();
    }
}

