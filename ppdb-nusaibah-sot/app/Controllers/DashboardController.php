<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\Session;
use App\Models\CalonSantri;
use App\Services\Database;

class DashboardController
{
    public function admin(): void
    {
        $user = AuthService::user();
        $success = Session::getFlash('success');
        $error = Session::getFlash('error');

        // Initial stats query
        $stats = [
            'total_pendaftar' => 0,
            'menunggu_verifikasi' => 0,
            'terverifikasi' => 0,
            'lolos_seleksi' => 0,
        ];

        try {
            $db = Database::getConnection();
            $stmt = $db->query('SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = "menunggu_verifikasi" THEN 1 ELSE 0 END) as menunggu,
                SUM(CASE WHEN status = "sedang_diverifikasi" THEN 1 ELSE 0 END) as verifikasi,
                SUM(CASE WHEN status = "lolos_seleksi" THEN 1 ELSE 0 END) as lolos
                FROM pendaftaran');
            if ($row = $stmt->fetch()) {
                $stats['total_pendaftar'] = (int) ($row['total'] ?? 0);
                $stats['menunggu_verifikasi'] = (int) ($row['menunggu'] ?? 0);
                $stats['terverifikasi'] = (int) ($row['verifikasi'] ?? 0);
                $stats['lolos_seleksi'] = (int) ($row['lolos'] ?? 0);
            }
        } catch (\Throwable $e) {
            // In case DB connection fails, keep baseline stats
        }

        require dirname(__DIR__) . '/Views/admin/dashboard.php';
    }

    public function santri(): void
    {
        $user = AuthService::user();
        $success = Session::getFlash('success');
        $error = Session::getFlash('error');

        $calonSantri = null;
        try {
            $calonSantri = CalonSantri::findByUserId((int) $user['id']);
        } catch (\Throwable $e) {
            // Fallback
        }

        require dirname(__DIR__) . '/Views/santri/dashboard.php';
    }
}

