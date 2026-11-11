<?php

declare(strict_types=1);

namespace App\Services;

use PDO;
use PDOException;

/**
 * Database Connection Manager (PDO)
 */
class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $config = require dirname(__DIR__, 2) . '/config/database.php';

            $dsn = sprintf(
                'mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $config['host'],
                $config['port'],
                $config['database'],
                $config['charset']
            );

            try {
                self::$instance = new PDO(
                    $dsn,
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            } catch (PDOException $e) {
                // Log technical error internally without leaking credentials to client
                error_log('Database Connection Error: ' . $e->getMessage());
                throw new PDOException('Tidak dapat terhubung ke database. Pastikan MySQL aktif dan database terkonfigurasi dengan benar.');
            }
        }

        return self::$instance;
    }
}

