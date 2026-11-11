<?php
$pageTitle = 'Formulir Biodata Calon Santri';
require dirname(__DIR__) . '/layouts/header.php';

$cs = $calonSantri ?? [];
$isLocked = $isLocked ?? false;
$initialStep = (int)($_GET['step'] ?? 1);
if ($initialStep < 1 || $initialStep > 3) $initialStep = 1;
?>

<div class="min-h-screen bg-neutral-bg flex flex-col md:flex-row">

    <!-- Sidebar Calon Santri -->
    <aside class="w-full md:w-64 bg-white border-r border-neutral-border flex flex-col shrink-0">
        <div class="p-6 border-b border-neutral-border flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-brand-maroon flex items-center justify-center text-brand-gold shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <h1 class="text-xs font-bold text-brand-dark leading-tight">PPDB Online</h1>
                <p class="text-[10px] font-semibold text-brand-maroon uppercase tracking-wider">Pesantren Nusaibah</p>
            </div>
        </div>

        <!-- User Info Badge -->
        <div class="p-4 mx-4 my-4 rounded-xl bg-neutral-bg border border-neutral-border">
            <p class="text-[11px] text-neutral-muted">Nomor Pendaftaran:</p>
            <p class="text-xs font-extrabold text-brand-maroon tracking-wide"><?= htmlspecialchars($cs['no_pendaftaran'] ?? 'PPDB-2026-XXXX') ?></p>
            <p class="text-xs font-bold text-neutral-text mt-1 truncate"><?= htmlspecialchars($cs['nama_lengkap'] ?? $user['nama'] ?? 'Calon Santri') ?></p>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 space-y-1.5 text-xs font-semibold">
            <a href="/santri/dashboard" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-neutral-muted hover:bg-neutral-bg hover:text-neutral-text transition-smooth">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>

            <a href="/santri/formulir" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl bg-brand-maroon text-white font-bold shadow-sm">
                <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Formulir Biodata</span>
            </a>

            <div class="pt-4 pb-1">
                <p class="px-3.5 text-[10px] font-bold text-neutral-muted uppercase tracking-wider">Tahap Pendaftaran</p>
            </div>

            <a href="/santri/bukti" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-neutral-muted hover:bg-neutral-bg hover:text-brand-maroon transition-smooth">
                <svg class="w-4 h-4 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak Bukti Registrasi</span>
            </a>

            <span class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-neutral-muted/60 cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                <span>Upload Dokumen (M3)</span>
            </span>
        </nav>

        <!-- Logout Action -->
        <div class="p-4 border-t border-neutral-border">
            <form action="/logout" method="POST">
                <button type="submit" class="w-full flex items-center justify-center space-x-2 px-3 py-2 text-xs font-semibold text-status-error hover:bg-status-error/10 rounded-xl transition-smooth">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Body -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Header & Breadcrumb -->
        <div class="bg-white border-b border-neutral-border px-6 py-4">
            <div class="flex items-center space-x-2 text-xs text-neutral-muted mb-1">
                <a href="/santri/dashboard" class="hover:text-brand-maroon transition-smooth">Dashboard</a>
                <span>&rsaquo;</span>
                <span class="text-neutral-text font-bold">Formulir Biodata</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h2 class="text-xl font-extrabold text-brand-dark">Formulir Biodata Calon Santri</h2>
                    <p class="text-xs text-neutral-muted mt-0.5">Silakan lengkapi data diri dan informasi orang tua/wali dengan benar untuk melanjutkan proses pendaftaran.</p>
                </div>
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-brand-maroon/10 text-brand-maroon border border-brand-maroon/20">
                        <?= htmlspecialchars($cs['no_pendaftaran'] ?? 'PPDB-2026-XXXX') ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6 max-w-5xl mx-auto w-full flex-1">

            <!-- Flash Alerts -->
            <?php if (!empty($error)): ?>
                <div class="mb-6 p-4 rounded-xl bg-status-error/10 border border-status-error/20 flex items-start space-x-3 text-xs text-status-error animate-fade-in shadow-xs">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="mb-6 p-4 rounded-xl bg-status-success/10 border border-status-success/20 flex items-start space-x-3 text-xs text-status-success animate-fade-in shadow-xs">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>

            <!-- Locked Banner if already submitted -->
            <?php if ($isLocked): ?>
                <div class="mb-6 p-4 rounded-2xl bg-brand-gold/15 border border-brand-gold/30 flex items-center space-x-3 text-xs text-brand-dark">
                    <svg class="w-6 h-6 text-brand-maroon shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <div>
                        <p class="font-bold">Formulir Telah Dikirim & Terkunci</p>
                        <p class="text-[11px] text-neutral-muted">Data biodata Anda sedang diverifikasi oleh panitia PPDB. Perubahan data hanya dapat dilakukan jika panitia memberikan status revisi berkas.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Multi-Step Stepper Progress Bar -->
            <div class="mb-8">
                <div class="grid grid-cols-3 gap-2 sm:gap-4 text-center">
                    
                    <!-- Step 1 Tab -->
                    <button type="button" onclick="goToStep(1)" class="step-nav-btn text-left p-3 sm:p-4 rounded-2xl border transition-smooth" id="step-tab-1">
                        <div class="flex items-center space-x-2 sm:space-x-3">
                            <span class="step-badge w-7 h-7 sm:w-8 sm:h-8 rounded-xl flex items-center justify-center text-xs font-extrabold">1</span>
                            <div>
                                <p class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-neutral-muted">Langkah 1</p>
                                <p class="text-xs sm:text-sm font-bold text-neutral-text">Data Diri</p>
                            </div>
                        </div>
                    </button>

                    <!-- Step 2 Tab -->
                    <button type="button" onclick="goToStep(2)" class="step-nav-btn text-left p-3 sm:p-4 rounded-2xl border transition-smooth" id="step-tab-2">
                        <div class="flex items-center space-x-2 sm:space-x-3">
                            <span class="step-badge w-7 h-7 sm:w-8 sm:h-8 rounded-xl flex items-center justify-center text-xs font-extrabold">2</span>
                            <div>
                                <p class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-neutral-muted">Langkah 2</p>
                                <p class="text-xs sm:text-sm font-bold text-neutral-text">Data Orang Tua</p>
                            </div>
                        </div>
                    </button>

                    <!-- Step 3 Tab -->
                    <button type="button" onclick="goToStep(3)" class="step-nav-btn text-left p-3 sm:p-4 rounded-2xl border transition-smooth" id="step-tab-3">
                        <div class="flex items-center space-x-2 sm:space-x-3">
                            <span class="step-badge w-7 h-7 sm:w-8 sm:h-8 rounded-xl flex items-center justify-center text-xs font-extrabold">3</span>
                            <div>
                                <p class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-neutral-muted">Langkah 3</p>
                                <p class="text-xs sm:text-sm font-bold text-neutral-text">Konfirmasi</p>
                            </div>
                        </div>
                    </button>

                </div>
            </div>

            <!-- FORM START -->
            <form id="ppdb-form" action="/santri/formulir" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">
                <input type="hidden" name="current_step" id="current_step_input" value="<?= $initialStep ?>">
                <input type="hidden" name="form_action" id="form_action_input" value="draft">

                <!-- ================= STEP 1: DATA DIRI CALON SANTRI ================= -->
                <div id="step-panel-1" class="step-panel space-y-6">
                    
                    <!-- A. Identitas Pribadi -->
                    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                        <div class="border-b border-neutral-border pb-3 mb-5 flex items-center justify-between">
                            <h3 class="text-sm font-bold text-brand-dark flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-brand-maroon"></span>
                                <span>A. Identitas Pribadi Calon Santriwati</span>
                            </h3>
                            <span class="text-[11px] text-neutral-muted">Tanda <span class="text-status-error">*</span> wajib diisi</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nama Lengkap -->
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Nama Lengkap Calon Santri (Sesuai Akta Kelahiran) <span class="text-status-error">*</span>
                                </label>
                                <input type="text" name="nama_lengkap" id="f_nama_lengkap" required value="<?= htmlspecialchars($cs['nama_lengkap'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Nama lengkap huruf balok/kapital"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <!-- NIK -->
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    NIK Santri (16 Digit) <span class="text-status-error">*</span>
                                </label>
                                <input type="text" name="nik" id="f_nik" maxlength="16" required value="<?= htmlspecialchars($cs['nik'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="367101xxxxxxxxxx"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <!-- No KK -->
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Nomor Kartu Keluarga (KK - 16 Digit) <span class="text-status-error">*</span>
                                </label>
                                <input type="text" name="no_kk" id="f_no_kk" maxlength="16" required value="<?= htmlspecialchars($cs['no_kk'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="367101xxxxxxxxxx"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Jenis Kelamin <span class="text-status-error">*</span>
                                </label>
                                <select name="jenis_kelamin" id="f_jenis_kelamin" required <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                                    <option value="P" <?= ($cs['jenis_kelamin'] ?? 'P') === 'P' ? 'selected' : '' ?>>Perempuan (Santriwati)</option>
                                    <option value="L" <?= ($cs['jenis_kelamin'] ?? '') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                </select>
                            </div>

                            <!-- Agama -->
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Agama <span class="text-status-error">*</span></label>
                                <input type="text" name="agama" id="f_agama" value="<?= htmlspecialchars($cs['agama'] ?? 'Islam') ?>" required <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Tempat Lahir <span class="text-status-error">*</span>
                                </label>
                                <input type="text" name="tempat_lahir" id="f_tempat_lahir" required value="<?= htmlspecialchars($cs['tempat_lahir'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Kota/Kabupaten kelahiran"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Tanggal Lahir <span class="text-status-error">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" id="f_tanggal_lahir" required value="<?= htmlspecialchars($cs['tanggal_lahir'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <!-- Kewarganegaraan -->
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Kewarganegaraan</label>
                                <select name="kewarganegaraan" id="f_kewarganegaraan" <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                                    <option value="WNI" <?= ($cs['kewarganegaraan'] ?? 'WNI') === 'WNI' ? 'selected' : '' ?>>WNI (Warga Negara Indonesia)</option>
                                    <option value="WNA" <?= ($cs['kewarganegaraan'] ?? '') === 'WNA' ? 'selected' : '' ?>>WNA (Warga Negara Asing)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- B. Informasi Pendidikan -->
                    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                        <div class="border-b border-neutral-border pb-3 mb-5">
                            <h3 class="text-sm font-bold text-brand-dark flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-brand-maroon"></span>
                                <span>B. Informasi Asal Sekolah & Pendidikan</span>
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Nama Asal Sekolah / Madrasah <span class="text-status-error">*</span>
                                </label>
                                <input type="text" name="asal_sekolah" id="f_asal_sekolah" required value="<?= htmlspecialchars($cs['asal_sekolah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Contoh: SDIT Al-Ihsan / SDN 01 Cipondoh"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Jenjang Pendidikan Sebelumnya</label>
                                <select name="jenjang_pendidikan" id="f_jenjang_pendidikan" <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                                    <option value="SD/MI" <?= ($cs['jenjang_pendidikan'] ?? 'SD/MI') === 'SD/MI' ? 'selected' : '' ?>>SD / MI / Sederajat</option>
                                    <option value="SMP/MTs" <?= ($cs['jenjang_pendidikan'] ?? '') === 'SMP/MTs' ? 'selected' : '' ?>>SMP / MTs / Sederajat</option>
                                    <option value="Pondok Pesantren" <?= ($cs['jenjang_pendidikan'] ?? '') === 'Pondok Pesantren' ? 'selected' : '' ?>>Pondok Pesantren Lain</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" id="f_tahun_lulus" value="<?= htmlspecialchars($cs['tahun_lulus'] ?? date('Y')) ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Contoh: 2024"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Nomor Ijazah / SKL (Jika sudah ada)</label>
                                <input type="text" name="nomor_ijazah" id="f_nomor_ijazah" value="<?= htmlspecialchars($cs['nomor_ijazah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Dapat dikosongkan jika belum terbit"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- C. Kontak & Domisili Calon Santri -->
                    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                        <div class="border-b border-neutral-border pb-3 mb-5">
                            <h3 class="text-sm font-bold text-brand-dark flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-brand-maroon"></span>
                                <span>C. Kontak & Alamat Domisili</span>
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Nomor WhatsApp Aktif Santri <span class="text-status-error">*</span>
                                </label>
                                <input type="tel" name="no_whatsapp" id="f_no_whatsapp" required value="<?= htmlspecialchars($cs['no_whatsapp'] ?? $user['no_hp'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="081234567890"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Email Aktif</label>
                                <input type="email" name="email" id="f_email" value="<?= htmlspecialchars($cs['email'] ?? $user['email'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="email@domain.com"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Alamat Jalan / Tempat Tinggal Lengkap <span class="text-status-error">*</span>
                                </label>
                                <textarea name="alamat" id="f_alamat" rows="2" required <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Nama Jalan, Nomor Rumah, Dusun / Komplek"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white"><?= htmlspecialchars($cs['alamat'] ?? '') ?></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-neutral-text mb-1">RT</label>
                                    <input type="text" name="rt" id="f_rt" value="<?= htmlspecialchars($cs['rt'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                        placeholder="001" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-neutral-text mb-1">RW</label>
                                    <input type="text" name="rw" id="f_rw" value="<?= htmlspecialchars($cs['rw'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                        placeholder="005" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Kelurahan / Desa</label>
                                <input type="text" name="desa" id="f_desa" value="<?= htmlspecialchars($cs['desa'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Kelurahan / Desa" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Kecamatan</label>
                                <input type="text" name="kecamatan" id="f_kecamatan" value="<?= htmlspecialchars($cs['kecamatan'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Kecamatan" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Kabupaten / Kota</label>
                                <input type="text" name="kabupaten" id="f_kabupaten" value="<?= htmlspecialchars($cs['kabupaten'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Kota / Kabupaten" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Provinsi</label>
                                <input type="text" name="provinsi" id="f_provinsi" value="<?= htmlspecialchars($cs['provinsi'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Provinsi" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Kode Pos</label>
                                <input type="text" name="kode_pos" id="f_kode_pos" value="<?= htmlspecialchars($cs['kode_pos'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="15148" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- D. Informasi Tambahan -->
                    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                        <div class="border-b border-neutral-border pb-3 mb-5">
                            <h3 class="text-sm font-bold text-brand-dark flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-brand-maroon"></span>
                                <span>D. Informasi Tambahan</span>
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Anak Ke-</label>
                                <input type="number" name="anak_ke" id="f_anak_ke" min="1" value="<?= htmlspecialchars((string)($cs['anak_ke'] ?? '')) ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="1" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Dari Jumlah Saudara Kandung</label>
                                <input type="number" name="jumlah_saudara" id="f_jumlah_saudara" min="1" value="<?= htmlspecialchars((string)($cs['jumlah_saudara'] ?? '')) ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="3" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Riwayat Penyakit / Alergi (Opsional)</label>
                                <input type="text" name="riwayat_penyakit" id="f_riwayat_penyakit" value="<?= htmlspecialchars($cs['riwayat_penyakit'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Tuliskan jika ada alergi makanan, obat, asma, dll."
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Catatan Khusus untuk Pesantren (Opsional)</label>
                                <textarea name="catatan_tambahan" id="f_catatan_tambahan" rows="2" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Informasi lain yang relevan diketahui pihak pengasuhan pondok"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white"><?= htmlspecialchars($cs['catatan_tambahan'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1 Footer Action Buttons -->
                    <div class="flex items-center justify-between pt-4">
                        <div>
                            <?php if (!$isLocked): ?>
                                <button type="button" onclick="submitDraft(1)" class="px-5 py-2.5 rounded-xl border border-neutral-border text-neutral-text font-bold text-xs hover:border-brand-maroon hover:text-brand-maroon transition-smooth bg-white shadow-xs">
                                    Simpan Draft
                                </button>
                            <?php endif; ?>
                        </div>
                        <button type="button" onclick="validateAndGoToStep(2)" class="px-6 py-2.5 rounded-xl bg-brand-maroon text-white font-bold text-xs hover:bg-brand-dark transition-smooth shadow-sm flex items-center space-x-2">
                            <span>Lanjut ke Data Orang Tua</span>
                            <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>

                </div>

                <!-- ================= STEP 2: DATA ORANG TUA / WALI ================= -->
                <div id="step-panel-2" class="step-panel space-y-6 hidden">
                    
                    <!-- Copy Address Helper Checkbox -->
                    <div class="bg-white rounded-2xl border border-neutral-border p-4 shadow-card flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" id="copy_address_checkbox" onchange="syncParentAddress(this.checked)" class="w-4 h-4 rounded text-brand-maroon focus:ring-brand-maroon">
                            <label for="copy_address_checkbox" class="text-xs font-bold text-neutral-text cursor-pointer">
                                Alamat orang tua sama dengan alamat domisili calon santri?
                            </label>
                        </div>
                        <span class="text-[11px] text-neutral-muted hidden sm:inline">Centang untuk pengisian otomatis</span>
                    </div>

                    <!-- A. Data Ayah Kandung -->
                    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                        <div class="border-b border-neutral-border pb-3 mb-5">
                            <h3 class="text-sm font-bold text-brand-dark flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-brand-maroon"></span>
                                <span>A. Data Lengkap Ayah Kandung</span>
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Nama Lengkap Ayah <span class="text-status-error">*</span>
                                </label>
                                <input type="text" name="nama_ayah" id="f_nama_ayah" required value="<?= htmlspecialchars($cs['nama_ayah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Nama lengkap ayah"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">NIK Ayah (Opsional)</label>
                                <input type="text" name="nik_ayah" id="f_nik_ayah" maxlength="16" value="<?= htmlspecialchars($cs['nik_ayah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="16 digit NIK ayah"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Tempat Lahir Ayah</label>
                                <input type="text" name="tempat_lahir_ayah" id="f_tempat_lahir_ayah" value="<?= htmlspecialchars($cs['tempat_lahir_ayah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Kota kelahiran ayah"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Tanggal Lahir Ayah</label>
                                <input type="date" name="tanggal_lahir_ayah" id="f_tanggal_lahir_ayah" value="<?= htmlspecialchars($cs['tanggal_lahir_ayah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" id="f_pekerjaan_ayah" value="<?= htmlspecialchars($cs['pekerjaan_ayah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Contoh: PNS, Karyawan Swasta, Wiraswasta"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Pendidikan Terakhir Ayah</label>
                                <select name="pendidikan_ayah" id="f_pendidikan_ayah" <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                                    <option value="SMA/SMK" <?= ($cs['pendidikan_ayah'] ?? 'SMA/SMK') === 'SMA/SMK' ? 'selected' : '' ?>>SMA / SMK / MA</option>
                                    <option value="D3" <?= ($cs['pendidikan_ayah'] ?? '') === 'D3' ? 'selected' : '' ?>>Diploma (D3)</option>
                                    <option value="S1" <?= ($cs['pendidikan_ayah'] ?? '') === 'S1' ? 'selected' : '' ?>>Sarjana (S1)</option>
                                    <option value="S2" <?= ($cs['pendidikan_ayah'] ?? '') === 'S2' ? 'selected' : '' ?>>Magister (S2)</option>
                                    <option value="S3" <?= ($cs['pendidikan_ayah'] ?? '') === 'S3' ? 'selected' : '' ?>>Doktor (S3)</option>
                                    <option value="SMP" <?= ($cs['pendidikan_ayah'] ?? '') === 'SMP' ? 'selected' : '' ?>>SMP / MTs</option>
                                    <option value="SD" <?= ($cs['pendidikan_ayah'] ?? '') === 'SD' ? 'selected' : '' ?>>SD / Sederajat</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Nomor WhatsApp Ayah <span class="text-status-error">*</span>
                                </label>
                                <input type="tel" name="no_hp_ayah" id="f_no_hp_ayah" required value="<?= htmlspecialchars($cs['no_hp_ayah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="0812xxxxxxxx"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Alamat Tempat Tinggal Ayah</label>
                                <input type="text" name="alamat_ayah" id="f_alamat_ayah" value="<?= htmlspecialchars($cs['alamat_ayah'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Alamat domisili ayah"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- B. Data Ibu Kandung -->
                    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                        <div class="border-b border-neutral-border pb-3 mb-5">
                            <h3 class="text-sm font-bold text-brand-dark flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-brand-maroon"></span>
                                <span>B. Data Lengkap Ibu Kandung</span>
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Nama Lengkap Ibu <span class="text-status-error">*</span>
                                </label>
                                <input type="text" name="nama_ibu" id="f_nama_ibu" required value="<?= htmlspecialchars($cs['nama_ibu'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Nama lengkap ibu"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">NIK Ibu (Opsional)</label>
                                <input type="text" name="nik_ibu" id="f_nik_ibu" maxlength="16" value="<?= htmlspecialchars($cs['nik_ibu'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="16 digit NIK ibu"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Tempat Lahir Ibu</label>
                                <input type="text" name="tempat_lahir_ibu" id="f_tempat_lahir_ibu" value="<?= htmlspecialchars($cs['tempat_lahir_ibu'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Kota kelahiran ibu"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Tanggal Lahir Ibu</label>
                                <input type="date" name="tanggal_lahir_ibu" id="f_tanggal_lahir_ibu" value="<?= htmlspecialchars($cs['tanggal_lahir_ibu'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" id="f_pekerjaan_ibu" value="<?= htmlspecialchars($cs['pekerjaan_ibu'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Contoh: Ibu Rumah Tangga, Guru, Wiraswasta"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Pendidikan Terakhir Ibu</label>
                                <select name="pendidikan_ibu" id="f_pendidikan_ibu" <?= $isLocked ? 'disabled' : '' ?>
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                                    <option value="SMA/SMK" <?= ($cs['pendidikan_ibu'] ?? 'SMA/SMK') === 'SMA/SMK' ? 'selected' : '' ?>>SMA / SMK / MA</option>
                                    <option value="D3" <?= ($cs['pendidikan_ibu'] ?? '') === 'D3' ? 'selected' : '' ?>>Diploma (D3)</option>
                                    <option value="S1" <?= ($cs['pendidikan_ibu'] ?? '') === 'S1' ? 'selected' : '' ?>>Sarjana (S1)</option>
                                    <option value="S2" <?= ($cs['pendidikan_ibu'] ?? '') === 'S2' ? 'selected' : '' ?>>Magister (S2)</option>
                                    <option value="SMP" <?= ($cs['pendidikan_ibu'] ?? '') === 'SMP' ? 'selected' : '' ?>>SMP / MTs</option>
                                    <option value="SD" <?= ($cs['pendidikan_ibu'] ?? '') === 'SD' ? 'selected' : '' ?>>SD / Sederajat</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">
                                    Nomor WhatsApp Ibu <span class="text-status-error">*</span>
                                </label>
                                <input type="tel" name="no_hp_ibu" id="f_no_hp_ibu" required value="<?= htmlspecialchars($cs['no_hp_ibu'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="0812xxxxxxxx"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Alamat Tempat Tinggal Ibu</label>
                                <input type="text" name="alamat_ibu" id="f_alamat_ibu" value="<?= htmlspecialchars($cs['alamat_ibu'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Alamat domisili ibu"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- C. Data Wali (Kondisional) -->
                    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                        <div class="border-b border-neutral-border pb-3 mb-5 flex items-center justify-between">
                            <h3 class="text-sm font-bold text-brand-dark flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-brand-gold"></span>
                                <span>C. Data Wali Santri (Opsional)</span>
                            </h3>
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-neutral-text mb-1.5">
                                Apakah santriwati memiliki wali selain orang tua kandung?
                            </label>
                            <div class="flex items-center space-x-6 text-xs">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="menggunakan_wali" value="Tidak" onchange="toggleWaliForm(false)" <?= ($cs['menggunakan_wali'] ?? 'Tidak') === 'Tidak' ? 'checked' : '' ?> <?= $isLocked ? 'disabled' : '' ?> class="text-brand-maroon focus:ring-brand-maroon">
                                    <span>Tidak (Dikelola Orang Tua Langsung)</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="menggunakan_wali" value="Ya" onchange="toggleWaliForm(true)" <?= ($cs['menggunakan_wali'] ?? '') === 'Ya' ? 'checked' : '' ?> <?= $isLocked ? 'disabled' : '' ?> class="text-brand-maroon focus:ring-brand-maroon">
                                    <span>Ya (Tinggal / Diwakilkan kepada Wali)</span>
                                </label>
                            </div>
                        </div>

                        <div id="wali-fields-container" class="grid grid-cols-1 md:grid-cols-2 gap-4 <?= ($cs['menggunakan_wali'] ?? 'Tidak') === 'Ya' ? '' : 'hidden' ?> pt-3 border-t border-neutral-border">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Nama Lengkap Wali</label>
                                <input type="text" name="nama_wali" id="f_nama_wali" value="<?= htmlspecialchars($cs['nama_wali'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Nama lengkap wali"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Hubungan dengan Calon Santri</label>
                                <input type="text" name="hubungan_wali" id="f_hubungan_wali" value="<?= htmlspecialchars($cs['hubungan_wali'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Paman / Bibi / Kakek / Nenek / Saudara"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Pekerjaan Wali</label>
                                <input type="text" name="pekerjaan_wali" id="f_pekerjaan_wali" value="<?= htmlspecialchars($cs['pekerjaan_wali'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Pekerjaan wali"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Nomor WhatsApp Wali</label>
                                <input type="tel" name="no_hp_wali" id="f_no_hp_wali" value="<?= htmlspecialchars($cs['no_hp_wali'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="0812xxxxxxxx"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-neutral-text mb-1">Alamat Tempat Tinggal Wali</label>
                                <input type="text" name="alamat_wali" id="f_alamat_wali" value="<?= htmlspecialchars($cs['alamat_wali'] ?? '') ?>" <?= $isLocked ? 'disabled' : '' ?>
                                    placeholder="Alamat domisili wali"
                                    class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-sm focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 Footer Action Buttons -->
                    <div class="flex items-center justify-between pt-4">
                        <button type="button" onclick="goToStep(1)" class="px-5 py-2.5 rounded-xl border border-neutral-border text-neutral-text font-bold text-xs hover:border-brand-maroon transition-smooth bg-white">
                            &larr; Kembali ke Data Diri
                        </button>
                        <div class="flex items-center space-x-3">
                            <?php if (!$isLocked): ?>
                                <button type="button" onclick="submitDraft(2)" class="px-5 py-2.5 rounded-xl border border-neutral-border text-neutral-text font-bold text-xs hover:border-brand-maroon hover:text-brand-maroon transition-smooth bg-white shadow-xs">
                                    Simpan Draft
                                </button>
                            <?php endif; ?>
                            <button type="button" onclick="validateAndGoToStep(3)" class="px-6 py-2.5 rounded-xl bg-brand-maroon text-white font-bold text-xs hover:bg-brand-dark transition-smooth shadow-sm flex items-center space-x-2">
                                <span>Lihat Ringkasan & Konfirmasi</span>
                                <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- ================= STEP 3: KONFIRMASI & REVIEW ================= -->
                <div id="step-panel-3" class="step-panel space-y-6 hidden">
                    
                    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                        <div class="border-b border-neutral-border pb-4 mb-5 flex items-center justify-between">
                            <div>
                                <h3 class="text-base font-extrabold text-brand-dark">Ringkasan Data Formulir PPDB</h3>
                                <p class="text-xs text-neutral-muted mt-0.5">Mohon periksa kembali kebenaran seluruh informasi sebelum mengirim formulir pendaftaran.</p>
                            </div>
                            <span class="px-3 py-1 bg-brand-gold/20 text-brand-dark rounded-full text-xs font-bold">Langkah Final</span>
                        </div>

                        <!-- Data Diri Review Box -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between bg-neutral-bg p-3 rounded-xl border border-neutral-border mb-3">
                                <h4 class="text-xs font-bold text-brand-maroon uppercase tracking-wider">1. Data Diri Calon Santri</h4>
                                <button type="button" onclick="goToStep(1)" class="text-[11px] font-bold text-brand-maroon hover:underline">Ubah Data Diri</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs p-2">
                                <div><span class="text-neutral-muted">Nama Lengkap:</span> <strong id="r_nama" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">NIK:</span> <strong id="r_nik" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">Nomor KK:</span> <strong id="r_no_kk" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">Tempat, Tgl Lahir:</span> <strong id="r_ttl" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">Asal Sekolah:</span> <strong id="r_sekolah" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">WhatsApp Santri:</span> <strong id="r_wa_santri" class="text-neutral-text block font-semibold">-</strong></div>
                                <div class="sm:col-span-2"><span class="text-neutral-muted">Alamat Domisili:</span> <strong id="r_alamat" class="text-neutral-text block font-semibold">-</strong></div>
                            </div>
                        </div>

                        <!-- Data Orang Tua Review Box -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between bg-neutral-bg p-3 rounded-xl border border-neutral-border mb-3">
                                <h4 class="text-xs font-bold text-brand-maroon uppercase tracking-wider">2. Data Orang Tua / Wali</h4>
                                <button type="button" onclick="goToStep(2)" class="text-[11px] font-bold text-brand-maroon hover:underline">Ubah Orang Tua</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs p-2">
                                <div><span class="text-neutral-muted">Nama Ayah:</span> <strong id="r_ayah" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">WhatsApp Ayah:</span> <strong id="r_wa_ayah" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">Pekerjaan Ayah:</span> <strong id="r_job_ayah" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">Nama Ibu:</span> <strong id="r_ibu" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">WhatsApp Ibu:</span> <strong id="r_wa_ibu" class="text-neutral-text block font-semibold">-</strong></div>
                                <div><span class="text-neutral-muted">Pekerjaan Ibu:</span> <strong id="r_job_ibu" class="text-neutral-text block font-semibold">-</strong></div>
                                <div id="r_wali_row" class="sm:col-span-2 hidden pt-2 border-t border-neutral-border">
                                    <span class="text-neutral-muted">Data Wali:</span> <strong id="r_wali" class="text-neutral-text block font-semibold">-</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Statement Checkbox -->
                        <?php if (!$isLocked): ?>
                            <div class="p-4 rounded-xl bg-brand-maroon/5 border border-brand-maroon/20 mb-6">
                                <label class="flex items-start space-x-3 cursor-pointer">
                                    <input type="checkbox" id="agreement_checkbox" required class="mt-0.5 w-4 h-4 rounded text-brand-maroon focus:ring-brand-maroon">
                                    <span class="text-xs text-neutral-text">
                                        Saya menyatakan dengan sesungguhnya bahwa seluruh data biodata dan informasi orang tua/wali yang saya masukkan adalah benar dan dapat dipertanggungjawabkan sesuai ketentuan Pondok Pesantren Nusaibah Binti Kaab.
                                    </span>
                                </label>
                            </div>
                        <?php endif; ?>

                    </div>

                    <!-- Step 3 Footer Action Buttons -->
                    <div class="flex items-center justify-between pt-4">
                        <button type="button" onclick="goToStep(2)" class="px-5 py-2.5 rounded-xl border border-neutral-border text-neutral-text font-bold text-xs hover:border-brand-maroon transition-smooth bg-white">
                            &larr; Kembali ke Data Orang Tua
                        </button>
                        <div class="flex items-center space-x-3">
                            <?php if (!$isLocked): ?>
                                <button type="button" onclick="submitDraft(3)" class="px-5 py-2.5 rounded-xl border border-neutral-border text-neutral-text font-bold text-xs hover:border-brand-maroon hover:text-brand-maroon transition-smooth bg-white shadow-xs">
                                    Simpan Draft
                                </button>
                                <button type="button" onclick="confirmSubmitForm()" class="px-7 py-3 rounded-xl bg-status-success text-white font-extrabold text-sm hover:opacity-95 transition-smooth shadow-md flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Kirim Formulir Sekarang</span>
                                </button>
                            <?php else: ?>
                                <a href="/santri/dashboard" class="px-6 py-2.5 rounded-xl bg-brand-maroon text-white font-bold text-xs">Kembali ke Dashboard</a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

            </form>
            <!-- FORM END -->

        </div>
    </div>
</div>

<script>
let currentActiveStep = <?= $initialStep ?>;

function updateStepperUI(step) {
    currentActiveStep = step;
    document.getElementById('current_step_input').value = step;

    for (let i = 1; i <= 3; i++) {
        const tab = document.getElementById(`step-tab-${i}`);
        const badge = tab.querySelector('.step-badge');
        const panel = document.getElementById(`step-panel-${i}`);

        if (i === step) {
            tab.className = 'step-nav-btn text-left p-3 sm:p-4 rounded-2xl border-2 border-brand-maroon bg-white shadow-sm transition-smooth';
            badge.className = 'step-badge w-7 h-7 sm:w-8 sm:h-8 rounded-xl flex items-center justify-center text-xs font-extrabold bg-brand-maroon text-white shadow-xs';
            panel.classList.remove('hidden');
        } else if (i < step) {
            tab.className = 'step-nav-btn text-left p-3 sm:p-4 rounded-2xl border border-status-success/30 bg-status-success/5 hover:border-brand-maroon transition-smooth';
            badge.className = 'step-badge w-7 h-7 sm:w-8 sm:h-8 rounded-xl flex items-center justify-center text-xs font-extrabold bg-status-success text-white';
            panel.classList.add('hidden');
        } else {
            tab.className = 'step-nav-btn text-left p-3 sm:p-4 rounded-2xl border border-neutral-border bg-white/60 hover:border-neutral-muted transition-smooth';
            badge.className = 'step-badge w-7 h-7 sm:w-8 sm:h-8 rounded-xl flex items-center justify-center text-xs font-extrabold bg-neutral-bg text-neutral-muted border border-neutral-border';
            panel.classList.add('hidden');
        }
    }

    if (step === 3) {
        populateReviewData();
    }

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function goToStep(step) {
    updateStepperUI(step);
}

function validateAndGoToStep(nextStep) {
    if (nextStep === 2) {
        // Quick validate step 1
        const nama = document.getElementById('f_nama_lengkap').value.trim();
        if (!nama) {
            alert('Mohon isi Nama Lengkap Calon Santri.');
            document.getElementById('f_nama_lengkap').focus();
            return;
        }
    } else if (nextStep === 3) {
        // Quick validate step 2
        const ayah = document.getElementById('f_nama_ayah').value.trim();
        const ibu = document.getElementById('f_nama_ibu').value.trim();
        if (!ayah || !ibu) {
            alert('Mohon isi minimal Nama Lengkap Ayah dan Nama Lengkap Ibu.');
            return;
        }
    }
    updateStepperUI(nextStep);
}

function submitDraft(step) {
    document.getElementById('current_step_input').value = step;
    document.getElementById('form_action_input').value = 'draft';
    document.getElementById('ppdb-form').submit();
}

function confirmSubmitForm() {
    const agreement = document.getElementById('agreement_checkbox');
    if (agreement && !agreement.checked) {
        alert('Mohon centang pernyataan persetujuan kebenaran data sebelum mengirim.');
        agreement.focus();
        return;
    }

    if (confirm('Apakah Anda yakin seluruh data biodata dan orang tua sudah benar? Setelah dikirim, data akan masuk ke proses verifikasi panitia.')) {
        document.getElementById('form_action_input').value = 'submit';
        document.getElementById('ppdb-form').submit();
    }
}

function toggleWaliForm(show) {
    const container = document.getElementById('wali-fields-container');
    if (show) {
        container.classList.remove('hidden');
    } else {
        container.classList.add('hidden');
    }
}

function syncParentAddress(checked) {
    if (checked) {
        const alamat = document.getElementById('f_alamat').value;
        const desa = document.getElementById('f_desa').value;
        const kec = document.getElementById('f_kecamatan').value;
        const kab = document.getElementById('f_kabupaten').value;
        const prov = document.getElementById('f_provinsi').value;

        const fullAddr = [alamat, desa ? 'Ds. ' + desa : '', kec ? 'Kec. ' + kec : '', kab, prov].filter(Boolean).join(', ');
        document.getElementById('f_alamat_ayah').value = fullAddr;
        document.getElementById('f_alamat_ibu').value = fullAddr;
    }
}

function populateReviewData() {
    const getVal = (id) => (document.getElementById(id) ? document.getElementById(id).value.trim() : '');

    document.getElementById('r_nama').textContent = getVal('f_nama_lengkap') || '-';
    document.getElementById('r_nik').textContent = getVal('f_nik') || '-';
    document.getElementById('r_no_kk').textContent = getVal('f_no_kk') || '-';
    document.getElementById('r_ttl').textContent = `${getVal('f_tempat_lahir') || '-'}, ${getVal('f_tanggal_lahir') || '-'}`;
    document.getElementById('r_sekolah').textContent = getVal('f_asal_sekolah') || '-';
    document.getElementById('r_wa_santri').textContent = getVal('f_no_whatsapp') || '-';
    
    const addr = [getVal('f_alamat'), getVal('f_desa'), getVal('f_kecamatan'), getVal('f_kabupaten'), getVal('f_provinsi')].filter(Boolean).join(', ');
    document.getElementById('r_alamat').textContent = addr || '-';

    document.getElementById('r_ayah').textContent = getVal('f_nama_ayah') || '-';
    document.getElementById('r_wa_ayah').textContent = getVal('f_no_hp_ayah') || '-';
    document.getElementById('r_job_ayah').textContent = getVal('f_pekerjaan_ayah') || '-';

    document.getElementById('r_ibu').textContent = getVal('f_nama_ibu') || '-';
    document.getElementById('r_wa_ibu').textContent = getVal('f_no_hp_ibu') || '-';
    document.getElementById('r_job_ibu').textContent = getVal('f_pekerjaan_ibu') || '-';

    const useWali = document.querySelector('input[name="menggunakan_wali"]:checked')?.value === 'Ya';
    const waliRow = document.getElementById('r_wali_row');
    if (useWali) {
        waliRow.classList.remove('hidden');
        document.getElementById('r_wali').textContent = `${getVal('f_nama_wali')} (${getVal('f_hubungan_wali')}) - WA: ${getVal('f_no_hp_wali')}`;
    } else {
        waliRow.classList.add('hidden');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    updateStepperUI(<?= $initialStep ?>);
});
</script>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>
