<?php
$pageTitle = 'Registrasi Akun Calon Santri';
require dirname(__DIR__) . '/layouts/header.php';
?>

<div class="min-h-screen flex flex-col justify-center py-10 sm:px-6 lg:px-8 bg-neutral-bg">
    <!-- Header Brand -->
    <div class="sm:mx-auto sm:w-full sm:max-w-lg text-center">
        <a href="/" class="inline-flex flex-col items-center group">
            <div class="w-16 h-16 rounded-2xl bg-brand-maroon flex items-center justify-center text-white shadow-card group-hover:scale-105 transition-smooth">
                <svg class="w-9 h-9 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="mt-4 text-2xl font-extrabold text-brand-dark tracking-tight">
                Pendaftaran Akun Baru
            </h2>
            <p class="text-sm font-semibold text-brand-maroon">
                PPDB Pondok Pesantren Nusaibah Binti Kaab
            </p>
        </a>
    </div>

    <!-- Register Card -->
    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-lg px-4 sm:px-0">
        <div class="bg-white py-8 px-6 sm:px-10 rounded-2xl border border-neutral-border shadow-card">
            
            <div class="mb-6 text-center border-b border-neutral-border pb-4">
                <h3 class="text-lg font-bold text-neutral-text">Buat Akun Calon Santri</h3>
                <p class="text-xs text-neutral-muted mt-1">Langkah awal untuk memulai proses pendaftaran santriwati baru</p>
            </div>

            <!-- Flash Alerts -->
            <?php if (!empty($error)): ?>
                <div class="mb-5 p-3.5 rounded-xl bg-status-error/10 border border-status-error/20 flex items-start space-x-2.5 text-xs text-status-error animate-fade-in">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="mb-5 p-3.5 rounded-xl bg-status-success/10 border border-status-success/20 flex items-start space-x-2.5 text-xs text-status-success animate-fade-in">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="/register" method="POST" class="space-y-4">
                <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">

                <!-- Nama Lengkap -->
                <div>
                    <label for="nama" class="block text-xs font-semibold text-neutral-text mb-1">
                        Nama Lengkap Calon Santriwati <span class="text-status-error">*</span>
                    </label>
                    <input id="nama" name="nama" type="text" required
                        placeholder="Contoh: Fatimah Az-Zahra"
                        class="block w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-maroon focus:border-brand-maroon transition-smooth bg-white" />
                </div>

                <!-- Email & No WhatsApp (2 Columns on tablet/desktop) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-xs font-semibold text-neutral-text mb-1">
                            Alamat Email Aktif <span class="text-status-error">*</span>
                        </label>
                        <input id="email" name="email" type="email" required autocomplete="email"
                            placeholder="nama@email.com"
                            class="block w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-maroon focus:border-brand-maroon transition-smooth bg-white" />
                    </div>

                    <div>
                        <label for="no_hp" class="block text-xs font-semibold text-neutral-text mb-1">
                            Nomor WhatsApp Aktif <span class="text-status-error">*</span>
                        </label>
                        <input id="no_hp" name="no_hp" type="tel" required
                            placeholder="08123456789"
                            class="block w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-maroon focus:border-brand-maroon transition-smooth bg-white" />
                    </div>
                </div>

                <!-- Password & Confirmation (2 Columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-neutral-text mb-1">
                            Kata Sandi <span class="text-status-error">*</span>
                        </label>
                        <input id="password" name="password" type="password" required minlength="8"
                            placeholder="Min. 8 karakter"
                            class="block w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-maroon focus:border-brand-maroon transition-smooth bg-white" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-neutral-text mb-1">
                            Konfirmasi Sandi <span class="text-status-error">*</span>
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8"
                            placeholder="Ulangi kata sandi"
                            class="block w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-maroon focus:border-brand-maroon transition-smooth bg-white" />
                    </div>
                </div>

                <div class="p-3 bg-neutral-bg rounded-xl border border-neutral-border flex items-center space-x-2 text-[11px] text-neutral-muted">
                    <svg class="w-4 h-4 text-brand-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Setelah registrasi, nomor pendaftaran resmi akan dibuat secara otomatis oleh sistem.</span>
                </div>

                <button type="submit"
                    class="w-full mt-2 py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-brand-maroon hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-maroon shadow-md transition-smooth flex items-center justify-center space-x-2">
                    <span>Daftar Akun Santri</span>
                    <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </form>

            <!-- Footer Link -->
            <div class="mt-6 text-center text-xs text-neutral-muted pt-4 border-t border-neutral-border">
                Sudah memiliki akun?
                <a href="/login" class="font-bold text-brand-maroon hover:text-brand-dark underline ml-1">
                    Masuk di Sini
                </a>
            </div>

        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>

