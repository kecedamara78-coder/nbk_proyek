<?php
$pageTitle = 'Dashboard Calon Santri';
require dirname(__DIR__) . '/layouts/header.php';

$cs = $calonSantri ?? [];

// Calculate progress & status
$statusFormulir = $cs['status_formulir'] ?? 'draft';
$statusPendaftaran = $cs['status_pendaftaran'] ?? 'belum_lengkap';
$catatanVerifikasi = $cs['catatan_verifikasi'] ?? '';

$hasStarted = !empty($cs['nik']) || !empty($cs['tempat_lahir']) || !empty($cs['nama_ayah']);

if ($statusPendaftaran === 'diterima' || $statusPendaftaran === 'lolos_seleksi') {
    $progressPercent = 100;
    $statusText = 'Alhamdulillah Diterima';
    $statusBadgeClass = 'bg-status-success/20 text-status-success border-status-success/40';
    $btnLabel = 'Lihat Bukti Pendaftaran';
    $btnClass = 'bg-status-success hover:bg-green-700 text-white';
} elseif ($statusPendaftaran === 'ditolak') {
    $progressPercent = 100;
    $statusText = 'Belum Diterima';
    $statusBadgeClass = 'bg-status-error/20 text-status-error border-status-error/40';
    $btnLabel = 'Lihat Detail Pendaftaran';
    $btnClass = 'bg-status-error hover:bg-red-700 text-white';
} elseif ($statusPendaftaran === 'perlu_perbaikan') {
    $progressPercent = 80;
    $statusText = 'Perlu Perbaikan';
    $statusBadgeClass = 'bg-status-error/10 text-status-error border-status-error/30';
    $btnLabel = 'Perbaiki Data Formulir';
    $btnClass = 'bg-status-error hover:bg-status-error/90 text-white';
} elseif ($statusFormulir === 'submitted') {
    $progressPercent = 100;
    if ($statusPendaftaran === 'terverifikasi' || $statusPendaftaran === 'sedang_diverifikasi') {
        $statusText = 'Terverifikasi';
        $statusBadgeClass = 'bg-status-success/10 text-status-success border-status-success/30';
    } else {
        $statusText = 'Menunggu Verifikasi';
        $statusBadgeClass = 'bg-brand-maroon/10 text-brand-maroon border-brand-maroon/30';
    }
    $btnLabel = 'Lihat Detail Formulir';
    $btnClass = 'bg-brand-maroon hover:bg-brand-dark text-white';
} elseif ($hasStarted) {
    $progressPercent = 50;
    $statusText = 'Sedang Dikerjakan (Draft)';
    $statusBadgeClass = 'bg-brand-gold/20 text-brand-dark border-brand-gold/40';
    $btnLabel = 'Lanjutkan Pengisian Formulir';
    $btnClass = 'bg-brand-maroon hover:bg-brand-dark text-white';
} else {
    $progressPercent = 15;
    $statusText = 'Belum Diisi';
    $statusBadgeClass = 'bg-neutral-border text-neutral-muted border-neutral-border';
    $btnLabel = 'Isi Formulir Biodata Sekarang';
    $btnClass = 'bg-brand-maroon hover:bg-brand-dark text-white';
}
?>

<!-- Santri Topbar -->
<header class="bg-white border-b border-neutral-border sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-3">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-brand-maroon flex items-center justify-center text-brand-gold shadow-sm group-hover:scale-105 transition-smooth">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-sm font-bold text-brand-dark">Portal Calon Santri</h1>
                        <p class="text-[11px] font-semibold text-brand-maroon">Pesantren Nusaibah Binti Kaab</p>
                    </div>
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="/" class="text-xs font-bold text-neutral-muted hover:text-brand-maroon transition-smooth hidden sm:inline">
                    Website Publik
                </a>
                <div class="text-right hidden sm:block pl-3 border-l border-neutral-border">
                    <p class="text-xs font-bold text-neutral-text"><?= htmlspecialchars($user['nama'] ?? 'Calon Santri') ?></p>
                    <p class="text-[10px] text-brand-maroon font-extrabold"><?= htmlspecialchars($cs['no_pendaftaran'] ?? 'PPDB-2026-XXXX') ?></p>
                </div>
                <form action="/logout" method="POST" class="inline">
                    <button type="submit" 
                        class="inline-flex items-center space-x-1.5 px-3 py-1.5 border border-status-error/30 text-status-error text-xs font-semibold rounded-lg hover:bg-status-error/10 transition-smooth">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1">
    
    <!-- Flash Messages -->
    <?php if (!empty($success)): ?>
        <div class="mb-6 p-4 rounded-xl bg-status-success/10 border border-status-success/20 text-status-success text-xs flex items-center space-x-2 animate-fade-in shadow-xs">
            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span><?= htmlspecialchars($success) ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="mb-6 p-4 rounded-xl bg-status-error/10 border border-status-error/20 text-status-error text-xs flex items-center space-x-2 animate-fade-in shadow-xs">
            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <!-- Revision Alert Box if Status is perlu_perbaikan -->
    <?php if ($statusPendaftaran === 'perlu_perbaikan' && !empty($catatanVerifikasi)): ?>
        <div class="mb-6 p-5 rounded-2xl bg-status-error/10 border border-status-error/30 text-xs">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 rounded-full bg-status-error text-white flex items-center justify-center shrink-0 font-bold">!</div>
                <div>
                    <h3 class="text-sm font-bold text-status-error">Perhatian: Berkas Formulir Perlu Perbaikan</h3>
                    <p class="text-neutral-text font-medium mt-1">Catatan dari Panitia Verifikator:</p>
                    <div class="p-3 bg-white rounded-xl border border-status-error/20 mt-1.5 text-neutral-text font-semibold">
                        "<?= htmlspecialchars($catatanVerifikasi) ?>"
                    </div>
                    <a href="/santri/formulir" class="inline-block mt-3 px-4 py-2 bg-status-error text-white font-bold rounded-xl hover:bg-status-error/90 transition-smooth">
                        Buka Formulir untuk Melakukan Perbaikan &rarr;
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Welcome & Registration Status Banner -->
    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-2 mb-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-brand-maroon/10 text-brand-maroon border border-brand-maroon/20">
                        <?= htmlspecialchars($cs['no_pendaftaran'] ?? 'PPDB-2026-0001') ?>
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-gold/20 text-brand-dark">
                        <?= htmlspecialchars($cs['gelombang'] ?? 'Gelombang 1') ?>
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border <?= $statusBadgeClass ?>">
                        Status: <?= $statusText ?>
                    </span>
                </div>
                <h2 class="text-2xl font-extrabold text-neutral-text">
                    Ahlan Wa Sahlan, <?= htmlspecialchars($cs['nama_lengkap'] ?? $user['nama'] ?? 'Calon Santriwati') ?>!
                </h2>
                <p class="text-xs text-neutral-muted mt-1">
                    Silakan pastikan biodata dan data orang tua telah dilengkapi secara akurat sebelum masuk ke tahap pengunggahan dokumen.
                </p>
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <a href="/santri/formulir" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl font-bold text-xs shadow-sm transition-smooth <?= $btnClass ?>">
                        <span><?= $btnLabel ?></span>
                        <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                    <!-- Cetak Bukti Pendaftaran Button -->
                    <a href="/santri/bukti" target="_blank" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl font-bold text-xs bg-white border border-neutral-border hover:border-brand-maroon text-neutral-text hover:text-brand-maroon shadow-xs transition-smooth">
                        <svg class="w-4 h-4 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Cetak Bukti Registrasi</span>
                    </a>
                </div>
            </div>
            
            <!-- Progress Completion Card -->
            <div class="shrink-0 bg-neutral-bg p-5 rounded-2xl border border-neutral-border text-xs w-full md:w-64">
                <div class="flex justify-between items-center mb-1.5">
                    <span class="text-neutral-muted font-medium">Kelengkapan Biodata:</span>
                    <span class="font-extrabold text-brand-maroon text-sm"><?= $progressPercent ?>%</span>
                </div>
                <div class="w-full bg-neutral-border rounded-full h-3 overflow-hidden">
                    <div class="bg-status-success h-3 rounded-full transition-smooth" style="width: <?= $progressPercent ?>%"></div>
                </div>
                <div class="mt-2.5 text-[11px] text-neutral-muted flex items-center justify-between">
                    <span>Tahap: <strong>M3 (Biodata)</strong></span>
                    <span><?= $statusText ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Details & Workflow Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Account Info Card -->
        <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
            <h3 class="text-sm font-bold text-neutral-text mb-4 flex items-center space-x-2">
                <svg class="w-4 h-4 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Ringkasan Identitas Pendaftar</span>
            </h3>
            <div class="space-y-3 text-xs">
                <div class="flex justify-between pb-2 border-b border-neutral-border">
                    <span class="text-neutral-muted">Nama Lengkap:</span>
                    <span class="font-bold text-neutral-text"><?= htmlspecialchars($cs['nama_lengkap'] ?? $user['nama'] ?? '-') ?></span>
                </div>
                <div class="flex justify-between pb-2 border-b border-neutral-border">
                    <span class="text-neutral-muted">NIK Santri:</span>
                    <span class="font-bold text-neutral-text"><?= htmlspecialchars($cs['nik'] ?? 'Belum diisi') ?></span>
                </div>
                <div class="flex justify-between pb-2 border-b border-neutral-border">
                    <span class="text-neutral-muted">Asal Sekolah:</span>
                    <span class="font-bold text-neutral-text"><?= htmlspecialchars($cs['asal_sekolah'] ?? 'Belum diisi') ?></span>
                </div>
                <div class="flex justify-between pb-2 border-b border-neutral-border">
                    <span class="text-neutral-muted">Email Akun:</span>
                    <span class="font-bold text-neutral-text"><?= htmlspecialchars($user['email'] ?? '') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-muted">WhatsApp Santri:</span>
                    <span class="font-bold text-neutral-text"><?= htmlspecialchars($cs['no_whatsapp'] ?? $user['no_hp'] ?? '') ?></span>
                </div>
            </div>
        </div>

        <!-- 4-Step PPDB Admission Roadmap -->
        <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
            <h3 class="text-sm font-bold text-neutral-text mb-4 flex items-center space-x-2">
                <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span>Tahapan Alur Pendaftaran PPDB</span>
            </h3>
            <div class="space-y-2 text-xs">
                
                <!-- Step 1 -->
                <div class="p-2.5 rounded-xl bg-status-success/10 border border-status-success/30 flex items-center space-x-2.5">
                    <span class="w-5 h-5 rounded-full bg-status-success text-white flex items-center justify-center text-[10px] font-bold">✓</span>
                    <span class="text-status-success font-bold">1. Buat Akun & Dapatkan Nomor Pendaftaran (Selesai M1)</span>
                </div>

                <!-- Step 2 -->
                <div class="p-2.5 rounded-xl <?= $statusFormulir === 'submitted' ? 'bg-status-success/10 border border-status-success/30' : 'bg-brand-gold/15 border border-brand-gold/40' ?> flex items-center justify-between">
                    <div class="flex items-center space-x-2.5">
                        <span class="w-5 h-5 rounded-full <?= $statusFormulir === 'submitted' ? 'bg-status-success text-white' : 'bg-brand-maroon text-white' ?> flex items-center justify-center text-[10px] font-bold">
                            <?= $statusFormulir === 'submitted' ? '✓' : '2' ?>
                        </span>
                        <span class="font-bold text-neutral-text">2. Pengisian Formulir Biodata & Orang Tua (M3)</span>
                    </div>
                    <span class="text-[11px] font-extrabold text-brand-maroon"><?= $statusText ?></span>
                </div>

                <!-- Step 3 -->
                <div class="p-2.5 rounded-xl bg-neutral-bg border border-neutral-border flex items-center space-x-2.5 opacity-60">
                    <span class="w-5 h-5 rounded-full bg-neutral-border text-neutral-muted flex items-center justify-center text-[10px] font-bold">3</span>
                    <span class="text-neutral-muted">3. Unggah Dokumen (KK, Akta, Pas Foto, Ijazah) (M3 Berikutnya)</span>
                </div>

                <!-- Step 4 -->
                <div class="p-2.5 rounded-xl bg-neutral-bg border border-neutral-border flex items-center space-x-2.5 opacity-60">
                    <span class="w-5 h-5 rounded-full bg-neutral-border text-neutral-muted flex items-center justify-center text-[10px] font-bold">4</span>
                    <span class="text-neutral-muted">4. Verifikasi Berkas & Cetak Bukti Pendaftaran (M3/M4)</span>
                </div>

            </div>
        </div>

    </div>
</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>
