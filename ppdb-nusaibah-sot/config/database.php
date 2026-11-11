<?php

declare(strict_types=1);

/**
 * PPDB Online Pondok Pesantren Nusaibah Binti Kaab Tangerang
 * Database Configuration
 */

$appConfig = require __DIR__ . '/app.php';

return [
    'host' => $appConfig['database']['host'] ?? '127.0.0.1',
    'port' => $appConfig['database']['port'] ?? 3306,
    'database' => $appConfig['database']['database'] ?? 'ppdb_nusaibah',
    'username' => $appConfig['database']['username'] ?? 'root',
    'password' => $appConfig['database']['password'] ?? '',
    'charset' => $appConfig['database']['charset'] ?? 'utf8mb4',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];

