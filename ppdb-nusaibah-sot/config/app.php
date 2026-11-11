<?php

declare(strict_types=1);

/**
 * PPDB Online Pondok Pesantren Nusaibah Binti Kaab Tangerang
 * Foundation Configuration (M0)
 */

// Simple .env parser for development environment
if (!function_exists('loadEnv')) {
    function loadEnv(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            if (str_contains($line, '=')) {
                [$name, $value] = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value, " \t\n\r\0\x0B\"'");
                if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                    putenv(sprintf('%s=%s', $name, $value));
                    $_ENV[$name] = $value;
                    $_SERVER[$name] = $value;
                }
            }
        }
    }
}

// Load environment variables if .env exists
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    loadEnv($envFile);
}

function env(string $key, mixed $default = null): mixed
{
    $val = getenv($key);
    if ($val === false) {
        return $_ENV[$key] ?? $default;
    }
    return match (strtolower((string) $val)) {
        'true', '(true)' => true,
        'false', '(false)' => false,
        'null', '(null)' => null,
        'empty', '(empty)' => '',
        default => $val,
    };
}

return [
    'app_name' => env('APP_NAME', 'PPDB Pondok Pesantren Nusaibah Binti Kaab'),
    'env' => env('APP_ENV', 'local'),
    'debug' => env('APP_DEBUG', true),
    'url' => env('APP_URL', 'http://localhost/ppdb-nusaibah-sot/public'),

    'database' => [
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => (int) env('DB_PORT', 3306),
        'database' => env('DB_DATABASE', 'ppdb_nusaibah'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
    ],

    'upload' => [
        'max_size_kb' => (int) env('UPLOAD_MAX_FILESIZE_KB', 2048),
        'allowed_mime' => explode(',', (string) env('ALLOWED_MIME_TYPES', 'image/jpeg,image/png,application/pdf')),
        'storage_path' => dirname(__DIR__) . '/storage/uploads',
    ],

    'paths' => [
        'root' => dirname(__DIR__),
        'app' => dirname(__DIR__) . '/app',
        'public' => dirname(__DIR__) . '/public',
        'storage' => dirname(__DIR__) . '/storage',
        'views' => dirname(__DIR__) . '/app/Views',
    ],
];

