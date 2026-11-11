<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\Csrf;
use App\Services\Session;
use App\Models\User;
use App\Models\CalonSantri;

class AuthController
{
    public function showLogin(): void
    {
        $error = Session::getFlash('error');
        $success = Session::getFlash('success');
        $csrfToken = Csrf::generateToken();

        require dirname(__DIR__) . '/Views/auth/login.php';
    }

    public function processLogin(): void
    {
        // 1. Verify CSRF
        $token = $_POST['_csrf_token'] ?? '';
        if (!Csrf::validateToken($token)) {
            Session::setFlash('error', 'Token keamanan tidak valid. Silakan coba lagi.');
            header('Location: /login');
            exit;
        }

        // 2. Validate input
        $identifier = trim($_POST['identifier'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($identifier === '' || $password === '') {
            Session::setFlash('error', 'Email/No. WhatsApp dan kata sandi wajib diisi.');
            header('Location: /login');
            exit;
        }

        // 3. Attempt authentication
        if (!AuthService::attempt($identifier, $password)) {
            Session::setFlash('error', 'Email/No. WhatsApp atau kata sandi tidak cocok.');
            header('Location: /login');
            exit;
        }

        // 4. Role-based redirect
        $role = AuthService::role();
        Session::setFlash('success', 'Selamat datang kembali, ' . htmlspecialchars(AuthService::user()['nama']));

        if ($role === 'calon_santri') {
            header('Location: /santri/dashboard');
        } else {
            header('Location: /admin/dashboard');
        }
        exit;
    }

    public function showRegister(): void
    {
        $error = Session::getFlash('error');
        $success = Session::getFlash('success');
        $csrfToken = Csrf::generateToken();

        require dirname(__DIR__) . '/Views/auth/register.php';
    }

    public function processRegister(): void
    {
        // 1. Verify CSRF
        $token = $_POST['_csrf_token'] ?? '';
        if (!Csrf::validateToken($token)) {
            Session::setFlash('error', 'Token keamanan tidak valid. Silakan coba lagi.');
            header('Location: /register');
            exit;
        }

        // 2. Collect & sanitize input
        $nama = trim($_POST['nama'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? ''));
        $noHp = preg_replace('/[^0-9]/', '', trim($_POST['no_hp'] ?? ''));
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['password_confirmation'] ?? '';

        // 3. Server-side validations
        if ($nama === '' || $email === '' || $noHp === '' || $password === '') {
            Session::setFlash('error', 'Semua kolom formulir pendaftaran wajib diisi.');
            header('Location: /register');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::setFlash('error', 'Format alamat email tidak valid.');
            header('Location: /register');
            exit;
        }

        if (strlen($noHp) < 10 || strlen($noHp) > 15) {
            Session::setFlash('error', 'Nomor WhatsApp harus berupa 10-15 digit angka.');
            header('Location: /register');
            exit;
        }

        if (strlen($password) < 8) {
            Session::setFlash('error', 'Kata sandi minimal harus 8 karakter.');
            header('Location: /register');
            exit;
        }

        if ($password !== $confirmPassword) {
            Session::setFlash('error', 'Konfirmasi kata sandi tidak cocok.');
            header('Location: /register');
            exit;
        }

        // 4. Duplicate checks
        if (User::findByEmail($email)) {
            Session::setFlash('error', 'Alamat email sudah terdaftar. Silakan masuk.');
            header('Location: /register');
            exit;
        }

        if (User::findByNoHp($noHp)) {
            Session::setFlash('error', 'Nomor WhatsApp sudah terdaftar. Silakan gunakan nomor lain atau masuk.');
            header('Location: /register');
            exit;
        }

        // 5. Create user & applicant profile
        try {
            $userId = User::create([
                'nama' => $nama,
                'email' => $email,
                'no_hp' => $noHp,
                'password' => $password,
                'role' => 'calon_santri',
                'status' => 'aktif',
            ]);

            CalonSantri::createInitial($userId, $nama);

            // Auto-login
            AuthService::attempt($email, $password);

            Session::setFlash('success', 'Akun pendaftaran berhasil dibuat! Silakan lengkapi formulir pendaftaran Anda.');
            header('Location: /santri/dashboard');
            exit;
        } catch (\Throwable $e) {
            error_log('Registration Error: ' . $e->getMessage());
            Session::setFlash('error', 'Terjadi kesalahan sistem saat membuat akun. Silakan coba kembali.');
            header('Location: /register');
            exit;
        }
    }

    public function logout(): void
    {
        AuthService::logout();
        Session::setFlash('success', 'Anda telah berhasil keluar dari sistem.');
        header('Location: /login');
        exit;
    }
}

