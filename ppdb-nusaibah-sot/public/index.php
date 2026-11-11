<?php

declare(strict_types=1);

/**
 * PPDB Online Pondok Pesantren Nusaibah Binti Kaab Tangerang
 * Front Controller (Milestone M3)
 */

error_reporting(E_ALL);

// Simple PSR-4 Autoloader for App\ namespace
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = dirname(__DIR__) . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Services\Session;
use App\Middleware\AuthMiddleware;
use App\Controllers\AdminController;

// Start secure session
Session::start();

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

$config = require_once dirname(__DIR__) . '/config/app.php';

if ($config['debug']) {
    ini_set('display_errors', '1');
} else {
    ini_set('display_errors', '0');
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Normalize path relative to script directory when hosted in subfolder
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$scriptDir = dirname($scriptName);
if ($scriptDir !== '/' && $scriptDir !== '\\' && str_starts_with($uri, $scriptDir)) {
    $uri = substr($uri, strlen($scriptDir));
}
$uri = '/' . ltrim($uri, '/');
if ($uri === '' || $uri === '/index.php') {
    $uri = '/';
}

// Parametric route handler: /admin/santri/{id}
if ($method === 'GET' && preg_match('#^/admin/santri/([0-9]+)$#', $uri, $matches)) {
    AuthMiddleware::requireRole(['admin', 'panitia']);
    (new AdminController())->showDetail((int) $matches[1]);
    exit;
}

// Standard Router
$routes = require_once dirname(__DIR__) . '/routes/web.php';
$handler = $routes[$method][$uri] ?? null;

if (is_callable($handler)) {
    $handler($config);
} else {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>404 Tidak Ditemukan — PPDB Nusaibah</title>
        <link rel="stylesheet" href="/assets/css/app.css">
    </head>
    <body class="bg-neutral-bg text-neutral-text font-sans min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-card border border-neutral-border p-8 text-center">
            <h1 class="text-4xl font-extrabold text-brand-maroon mb-2">404</h1>
            <p class="text-sm font-semibold text-neutral-text mb-1">Halaman Tidak Ditemukan</p>
            <p class="text-xs text-neutral-muted mb-6">Alamat halaman yang Anda tuju tidak tersedia atau telah dipindahkan.</p>
            <a href="/" class="inline-block px-5 py-2.5 bg-brand-maroon text-white text-xs font-semibold rounded-xl hover:bg-brand-dark transition-smooth shadow-md">
                Kembali ke Beranda
            </a>
        </div>
    </body>
    </html>
    <?php
}
