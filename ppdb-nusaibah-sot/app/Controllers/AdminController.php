<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\Csrf;
use App\Services\Session;
use App\Models\CalonSantri;

class AdminController
{
    public function showPendaftar(): void
    {
        $search = trim($_GET['search'] ?? '');
        $status = trim($_GET['status'] ?? 'semua');

        $pendaftarList = CalonSantri::getAllWithFilters($search ?: null, $status ?: null);
        $user = AuthService::user();
        $error = Session::getFlash('error');
        $success = Session::getFlash('success');

        require dirname(__DIR__) . '/Views/admin/pendaftar.php';
    }

    public function showDetail(int $id): void
    {
        $user = AuthService::user();
        $calonSantri = CalonSantri::findById($id);

        if (!$calonSantri) {
            Session::setFlash('error', 'Data pendaftar tidak ditemukan.');
            header('Location: /admin/pendaftar');
            exit;
        }

        $error = Session::getFlash('error');
        $success = Session::getFlash('success');
        $csrfToken = Csrf::generateToken();

        require dirname(__DIR__) . '/Views/admin/detail-santri.php';
    }

    public function updateVerifikasi(): void
    {
        $token = $_POST['_csrf_token'] ?? '';
        if (!Csrf::validateToken($token)) {
            Session::setFlash('error', 'Token keamanan tidak valid.');
            header('Location: /admin/pendaftar');
            exit;
        }

        $calonSantriId = (int) ($_POST['calon_santri_id'] ?? 0);
        $status = $_POST['status'] ?? '';
        $catatan = trim($_POST['catatan_verifikasi'] ?? '');
        $adminId = (int) AuthService::id();

        $allowedStatuses = [
            'belum_lengkap',
            'menunggu_verifikasi',
            'sedang_diverifikasi',
            'perlu_perbaikan',
            'terverifikasi',
            'lolos_seleksi',
            'tidak_lolos_seleksi'
        ];

        if (!in_array($status, $allowedStatuses, true)) {
            Session::setFlash('error', 'Status verifikasi tidak valid.');
            header('Location: /admin/santri/' . $calonSantriId);
            exit;
        }

        $updated = CalonSantri::updateVerifikasi($calonSantriId, $status, $catatan, $adminId);

        if ($updated) {
            Session::setFlash('success', 'Status pendaftaran dan catatan verifikasi berhasil diperbarui.');
        } else {
            Session::setFlash('error', 'Gagal memperbarui status pendaftaran.');
        }

        header('Location: /admin/santri/' . $calonSantriId);
        exit;
    }
}
