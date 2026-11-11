<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Cross-Site Request Forgery (CSRF) Protection
 */
class Csrf
{
    private const SESSION_KEY = '_csrf_token';

    public static function generateToken(): string
    {
        Session::start();
        $token = Session::get(self::SESSION_KEY);
        if (!$token) {
            $token = bin2hex(random_bytes(32));
            Session::set(self::SESSION_KEY, $token);
        }
        return $token;
    }

    public static function validateToken(?string $token): bool
    {
        Session::start();
        $stored = Session::get(self::SESSION_KEY);
        if (!$stored || !$token) {
            return false;
        }
        return hash_equals($stored, $token);
    }

    public static function inputField(): string
    {
        $token = htmlspecialchars(self::generateToken(), ENT_QUOTES, 'UTF-8');
        return '<input type="hidden" name="_csrf_token" value="' . $token . '">';
    }
}

