<?php
$pageTitle = 'Masuk Akun PPDB';
require dirname(__DIR__) . '/layouts/header.php';
?>

<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-neutral-bg">
    <!-- Header Brand -->
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="/" class="inline-flex flex-col items-center group">
            <div class="w-16 h-16 rounded-2xl bg-brand-maroon flex items-center justify-center text-white shadow-card group-hover:scale-105 transition-smooth">
                <svg class="w-9 h-9 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h2 class="mt-4 text-2xl font-extrabold text-brand-dark tracking-tight">
                PPDB Online
            </h2>
            <p class="text-sm font-semibold text-brand-maroon">
                Pondok Pesantren Nusaibah Binti Kaab
            </p>
        </a>
    </div>

    <!-- Login Card -->
    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
        <div class="bg-white py-8 px-6 sm:px-10 rounded-2xl border border-neutral-border shadow-card">
            
            <div class="mb-6 text-center">
                <h3 class="text-lg font-bold text-neutral-text">Masuk ke Portal PPDB</h3>
                <p class="text-xs text-neutral-muted mt-1">Gunakan alamat email atau nomor WhatsApp yang telah terdaftar</p>
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
            <form action="/login" method="POST" class="space-y-4">
                <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">

                <div>
                    <label for="identifier" class="block text-xs font-semibold text-neutral-text mb-1.5">
                        Email atau Nomor WhatsApp <span class="text-status-error">*</span>
                    </label>
                    <div class="relative rounded-xl shadow-xs">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-muted">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </div>
                        <input id="identifier" name="identifier" type="text" required autocomplete="username"
                            placeholder="nama@email.com atau 08123456789"
                            class="block w-full pl-10 pr-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-maroon focus:border-brand-maroon transition-smooth bg-white" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-neutral-text">
                            Kata Sandi <span class="text-status-error">*</span>
                        </label>
                    </div>
                    <div class="relative rounded-xl shadow-xs">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-neutral-muted">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="block w-full pl-10 pr-10 py-2.5 border border-neutral-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-maroon focus:border-brand-maroon transition-smooth bg-white" />
                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-neutral-muted hover:text-neutral-text focus:outline-none">
                            <svg class="h-4 w-4 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center text-neutral-muted hover:text-neutral-text cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-neutral-border text-brand-maroon focus:ring-brand-maroon">
                        <span class="ml-2">Ingat saya</span>
                    </label>
                    <span class="text-neutral-muted hover:text-brand-maroon cursor-pointer">Bantuan login?</span>
                </div>

                <button type="submit"
                    class="w-full mt-2 py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-brand-maroon hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-maroon shadow-md transition-smooth flex items-center justify-center space-x-2">
                    <span>Masuk ke Akun</span>
                    <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>

            <!-- Quick Demo Credentials Box for Evaluation -->
            <div class="mt-6 pt-5 border-t border-neutral-border">
                <p class="text-[11px] font-bold text-neutral-muted uppercase tracking-wider text-center mb-2.5">
                    Akun Pengujian Demo (TA 2027/2028):
                </p>
                <div class="grid grid-cols-2 gap-2 text-[11px]">
                    <button type="button" onclick="fillCredentials('admin@nusaibah.sch.id', 'AdminPPDB2027!')"
                        class="p-2 rounded-lg bg-neutral-bg border border-neutral-border hover:border-brand-maroon text-left transition-smooth">
                        <span class="block font-bold text-brand-maroon">Admin Tunggal</span>
                        <span class="text-neutral-muted truncate block">admin@nusaibah.sch.id</span>
                    </button>
                    <button type="button" onclick="fillCredentials('santri@gmail.com', 'SantriPPDB2027!')"
                        class="p-2 rounded-lg bg-neutral-bg border border-neutral-border hover:border-brand-maroon text-left transition-smooth">
                        <span class="block font-bold text-status-success">Calon Siswa</span>
                        <span class="text-neutral-muted truncate block">santri@gmail.com</span>
                    </button>
                </div>
                <p class="text-[10px] text-neutral-muted text-center mt-2.5">
                    🔒 Keamanan Sistem: Hanya terdapat <strong>1 Akun Admin Utama</strong> dan tidak dapat ditambah dari luar.
                </p>
            </div>

            <!-- Footer Link -->
            <div class="mt-6 text-center text-xs text-neutral-muted">
                Belum memiliki akun pendaftar?
                <a href="/register" class="font-bold text-brand-maroon hover:text-brand-dark underline ml-1">
                    Daftar Sekarang
                </a>
            </div>

        </div>
    </div>
</div>

<script>
function togglePasswordVisibility(fieldId, btn) {
    const field = document.getElementById(fieldId);
    if (field.type === 'password') {
        field.type = 'text';
    } else {
        field.type = 'password';
    }
}

function fillCredentials(id, pass) {
    document.getElementById('identifier').value = id;
    document.getElementById('password').value = pass;
}
</script>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>

