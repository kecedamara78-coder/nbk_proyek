<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\Csrf;
use App\Services\Session;
use App\Models\CalonSantri;

class SantriController
{
    public function showFormulir(): void
    {
        $user = AuthService::user();
        $calonSantri = CalonSantri::findByUserId((int) $user['id']);

        if (!$calonSantri) {
            Session::setFlash('error', 'Profil pendaftaran tidak ditemukan.');
            header('Location: /santri/dashboard');
            exit;
        }

        $error = Session::getFlash('error');
        $success = Session::getFlash('success');
        $csrfToken = Csrf::generateToken();

        // Check lock status: locked if submitted and not requested for revision
        $isLocked = ($calonSantri['status_formulir'] === 'submitted' && $calonSantri['status_pendaftaran'] !== 'perlu_perbaikan');

        require dirname(__DIR__) . '/Views/santri/formulir.php';
    }

    public function showBukti(): void
    {
        $user = AuthService::user();
        $calonSantri = CalonSantri::findByUserId((int) $user['id']);

        if (!$calonSantri) {
            Session::setFlash('error', 'Profil pendaftaran tidak ditemukan.');
            header('Location: /santri/dashboard');
            exit;
        }

        require dirname(__DIR__) . '/Views/santri/bukti-cetak.php';
    }

    public function saveFormulir(): void
    {
        // 1. Verify CSRF
        $token = $_POST['_csrf_token'] ?? '';
        if (!Csrf::validateToken($token)) {
            Session::setFlash('error', 'Token keamanan kedaluwarsa. Silakan coba lagi.');
            header('Location: /santri/formulir');
            exit;
        }

        $user = AuthService::user();
        $calonSantri = CalonSantri::findByUserId((int) $user['id']);

        if (!$calonSantri) {
            Session::setFlash('error', 'Data santri tidak ditemukan.');
            header('Location: /santri/dashboard');
            exit;
        }

        // Lock check
        if ($calonSantri['status_formulir'] === 'submitted' && $calonSantri['status_pendaftaran'] !== 'perlu_perbaikan') {
            Session::setFlash('error', 'Formulir telah dikirim dan sedang dalam tahap verifikasi, data tidak dapat diubah.');
            header('Location: /santri/formulir');
            exit;
        }

        $action = $_POST['form_action'] ?? 'draft';
        $isSubmit = ($action === 'submit');

        // Validation for final submission
        if ($isSubmit) {
            $required = [
                'nama_lengkap' => 'Nama Lengkap Calon Santri',
                'nik' => 'NIK Santri',
                'no_kk' => 'Nomor Kartu Keluarga (KK)',
                'tempat_lahir' => 'Tempat Lahir Santri',
                'tanggal_lahir' => 'Tanggal Lahir Santri',
                'asal_sekolah' => 'Asal Sekolah',
                'no_whatsapp' => 'Nomor WhatsApp Santri',
                'alamat' => 'Alamat Lengkap Santri',
                'nama_ayah' => 'Nama Lengkap Ayah',
                'no_hp_ayah' => 'Nomor WhatsApp / HP Ayah',
                'nama_ibu' => 'Nama Lengkap Ibu',
                'no_hp_ibu' => 'Nomor WhatsApp / HP Ibu',
            ];

            foreach ($required as $key => $label) {
                if (empty(trim($_POST[$key] ?? ''))) {
                    // Save draft first so input isn't lost
                    CalonSantri::updateBiodata((int)$calonSantri['id'], $_POST, false);
                    Session::setFlash('error', "Kolom {$label} wajib diisi sebelum mengirim formulir.");
                    header('Location: /santri/formulir?step=' . ($key === 'nama_ayah' || $key === 'nama_ibu' ? '2' : '1'));
                    exit;
                }
            }

            // Validasi format angka NIK & KK (16 digit)
            $nik = preg_replace('/[^0-9]/', '', $_POST['nik'] ?? '');
            $noKk = preg_replace('/[^0-9]/', '', $_POST['no_kk'] ?? '');

            if (strlen($nik) !== 16) {
                CalonSantri::updateBiodata((int)$calonSantri['id'], $_POST, false);
                Session::setFlash('error', 'NIK harus terdiri dari tepat 16 digit angka.');
                header('Location: /santri/formulir?step=1');
                exit;
            }

            if (strlen($noKk) !== 16) {
                CalonSantri::updateBiodata((int)$calonSantri['id'], $_POST, false);
                Session::setFlash('error', 'Nomor Kartu Keluarga (KK) harus terdiri dari tepat 16 digit angka.');
                header('Location: /santri/formulir?step=1');
                exit;
            }

            // Validasi wali jika memilih "Ya"
            if (($_POST['menggunakan_wali'] ?? 'Tidak') === 'Ya') {
                if (empty(trim($_POST['nama_wali'] ?? '')) || empty(trim($_POST['no_hp_wali'] ?? ''))) {
                    CalonSantri::updateBiodata((int)$calonSantri['id'], $_POST, false);
                    Session::setFlash('error', 'Nama wali dan nomor kontak wali wajib diisi jika memilih menggunakan wali.');
                    header('Location: /santri/formulir?step=2');
                    exit;
                }
            }
        }

        // Save to database
        $saved = CalonSantri::updateBiodata((int) $calonSantri['id'], $_POST, $isSubmit);

        if (!$saved) {
            Session::setFlash('error', 'Terjadi kesalahan sistem saat menyimpan data.');
            header('Location: /santri/formulir');
            exit;
        }

        if ($isSubmit) {
            Session::setFlash('success', 'Alhamdulillah! Formulir pendaftaran berhasil dikirim. Berkas Anda masuk ke tahap verifikasi panitia.');
            header('Location: /santri/dashboard');
        } else {
            Session::setFlash('success', 'Draft formulir berhasil disimpan sementara.');
            $currentStep = $_POST['current_step'] ?? '1';
            header('Location: /santri/formulir?step=' . urlencode($currentStep));
        }
        exit;
    }
}
