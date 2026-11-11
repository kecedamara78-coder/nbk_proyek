<?php
$pageTitle = 'Detail Biodata Santri — ' . ($calonSantri['nama_lengkap'] ?? '');
require dirname(__DIR__) . '/layouts/header.php';

$cs = $calonSantri ?? [];
$statusP = $cs['status_pendaftaran'] ?? 'belum_lengkap';
?>

<!-- Topbar -->
<header class="bg-white border-b border-neutral-border sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-3">
                <a href="/admin/pendaftar" class="text-neutral-muted hover:text-brand-maroon transition-smooth p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div>
                    <h1 class="text-sm font-bold text-brand-dark">Pemeriksaan Biodata Santri</h1>
                    <p class="text-[11px] font-semibold text-brand-maroon uppercase tracking-wider"><?= htmlspecialchars($cs['no_pendaftaran'] ?? '') ?></p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <a href="/admin/pendaftar" class="text-xs font-bold text-brand-maroon hover:underline">
                    &larr; Kembali ke Daftar Pendaftar
                </a>
            </div>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1">
    
    <!-- Flash Messages -->
    <?php if (!empty($success)): ?>
        <div class="mb-6 p-4 rounded-xl bg-status-success/10 border border-status-success/20 text-status-success text-xs flex items-center space-x-2 animate-fade-in shadow-xs">
            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span><?= htmlspecialchars($success) ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="mb-6 p-4 rounded-xl bg-status-error/10 border border-status-error/20 text-status-error text-xs flex items-center space-x-2 animate-fade-in shadow-xs">
            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <!-- Summary Header Card -->
    <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2 mb-1.5">
                <span class="px-3 py-0.5 rounded-full text-xs font-extrabold bg-brand-maroon/10 text-brand-maroon border border-brand-maroon/20">
                    <?= htmlspecialchars($cs['no_pendaftaran'] ?? '') ?>
                </span>
                <span class="px-3 py-0.5 rounded-full text-xs font-bold bg-brand-gold/20 text-brand-dark">
                    <?= htmlspecialchars($cs['gelombang'] ?? 'Gelombang 1') ?>
                </span>
            </div>
            <h2 class="text-2xl font-extrabold text-brand-dark"><?= htmlspecialchars($cs['nama_lengkap'] ?? '-') ?></h2>
            <p class="text-xs text-neutral-muted mt-0.5">Asal Sekolah: <strong><?= htmlspecialchars($cs['asal_sekolah'] ?? '-') ?></strong> | Terdaftar: <?= htmlspecialchars($cs['tanggal_daftar'] ?? '-') ?></p>
        </div>

        <div>
            <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-extrabold border uppercase
                <?= $statusP === 'terverifikasi' ? 'bg-status-success/10 text-status-success border-status-success/30' : ($statusP === 'perlu_perbaikan' ? 'bg-status-error/10 text-status-error border-status-error/30' : 'bg-brand-maroon/10 text-brand-maroon border-brand-maroon/30') ?>">
                Status: <?= htmlspecialchars($statusP) ?>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left 2 Cols: Biodata & Data Orang Tua -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card 1: Data Diri -->
            <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                <h3 class="text-sm font-bold text-brand-dark pb-3 border-b border-neutral-border mb-4 flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-brand-maroon"></span>
                    <span>1. Data Diri Calon Santri</span>
                </h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div><dt class="text-neutral-muted">Nama Lengkap</dt><dd class="font-bold text-neutral-text text-sm"><?= htmlspecialchars($cs['nama_lengkap'] ?? '-') ?></dd></div>
                    <div><dt class="text-neutral-muted">NIK Santri</dt><dd class="font-bold text-neutral-text text-sm"><?= htmlspecialchars($cs['nik'] ?? '-') ?></dd></div>
                    <div><dt class="text-neutral-muted">Nomor KK</dt><dd class="font-bold text-neutral-text text-sm"><?= htmlspecialchars($cs['no_kk'] ?? '-') ?></dd></div>
                    <div><dt class="text-neutral-muted">Jenis Kelamin</dt><dd class="font-bold text-neutral-text"><?= ($cs['jenis_kelamin'] ?? '') === 'P' ? 'Perempuan (Santriwati)' : 'Laki-laki' ?></dd></div>
                    <div><dt class="text-neutral-muted">Tempat, Tanggal Lahir</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['tempat_lahir'] ?? '-') ?>, <?= htmlspecialchars($cs['tanggal_lahir'] ?? '-') ?></dd></div>
                    <div><dt class="text-neutral-muted">Agama / Kewarganegaraan</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['agama'] ?? '-') ?> / <?= htmlspecialchars($cs['kewarganegaraan'] ?? '-') ?></dd></div>
                    <div><dt class="text-neutral-muted">WhatsApp Santri</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['no_whatsapp'] ?? '-') ?></dd></div>
                    <div><dt class="text-neutral-muted">Email Santri</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['email'] ?? '-') ?></dd></div>
                    <div class="sm:col-span-2"><dt class="text-neutral-muted">Alamat Domisili</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['alamat'] ?? '-') ?>, RT <?= htmlspecialchars($cs['rt'] ?? '-') ?>/RW <?= htmlspecialchars($cs['rw'] ?? '-') ?>, Ds. <?= htmlspecialchars($cs['desa'] ?? '-') ?>, Kec. <?= htmlspecialchars($cs['kecamatan'] ?? '-') ?>, <?= htmlspecialchars($cs['kabupaten'] ?? '-') ?>, <?= htmlspecialchars($cs['provinsi'] ?? '-') ?> (Kode Pos: <?= htmlspecialchars($cs['kode_pos'] ?? '-') ?>)</dd></div>
                    <div><dt class="text-neutral-muted">Anak Ke- / Jml Saudara</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars((string)($cs['anak_ke'] ?? '-')) ?> dari <?= htmlspecialchars((string)($cs['jumlah_saudara'] ?? '-')) ?> bersaudara</dd></div>
                    <div><dt class="text-neutral-muted">Riwayat Penyakit / Alergi</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['riwayat_penyakit'] ?? 'Tidak ada') ?></dd></div>
                </dl>
            </div>

            <!-- Card 2: Data Orang Tua -->
            <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card">
                <h3 class="text-sm font-bold text-brand-dark pb-3 border-b border-neutral-border mb-4 flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-brand-maroon"></span>
                    <span>2. Data Orang Tua / Wali</span>
                </h3>

                <!-- Data Ayah -->
                <div class="mb-5 pb-5 border-b border-neutral-border">
                    <h4 class="text-xs font-bold text-brand-maroon uppercase tracking-wider mb-2">Ayah Kandung</h4>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div><dt class="text-neutral-muted">Nama Ayah</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['nama_ayah'] ?? '-') ?></dd></div>
                        <div><dt class="text-neutral-muted">WhatsApp Ayah</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['no_hp_ayah'] ?? '-') ?></dd></div>
                        <div><dt class="text-neutral-muted">Pekerjaan / Pendidikan</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['pekerjaan_ayah'] ?? '-') ?> (<?= htmlspecialchars($cs['pendidikan_ayah'] ?? '-') ?>)</dd></div>
                        <div><dt class="text-neutral-muted">Alamat Ayah</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['alamat_ayah'] ?? '-') ?></dd></div>
                    </dl>
                </div>

                <!-- Data Ibu -->
                <div class="mb-5 pb-5 border-b border-neutral-border">
                    <h4 class="text-xs font-bold text-brand-maroon uppercase tracking-wider mb-2">Ibu Kandung</h4>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div><dt class="text-neutral-muted">Nama Ibu</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['nama_ibu'] ?? '-') ?></dd></div>
                        <div><dt class="text-neutral-muted">WhatsApp Ibu</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['no_hp_ibu'] ?? '-') ?></dd></div>
                        <div><dt class="text-neutral-muted">Pekerjaan / Pendidikan</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['pekerjaan_ibu'] ?? '-') ?> (<?= htmlspecialchars($cs['pendidikan_ibu'] ?? '-') ?>)</dd></div>
                        <div><dt class="text-neutral-muted">Alamat Ibu</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['alamat_ibu'] ?? '-') ?></dd></div>
                    </dl>
                </div>

                <!-- Data Wali jika ada -->
                <div>
                    <h4 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-2">Data Wali Santri</h4>
                    <?php if (($cs['menggunakan_wali'] ?? 'Tidak') === 'Ya'): ?>
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div><dt class="text-neutral-muted">Nama Wali</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['nama_wali'] ?? '-') ?></dd></div>
                            <div><dt class="text-neutral-muted">Hubungan</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['hubungan_wali'] ?? '-') ?></dd></div>
                            <div><dt class="text-neutral-muted">WhatsApp Wali</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['no_hp_wali'] ?? '-') ?></dd></div>
                            <div><dt class="text-neutral-muted">Alamat Wali</dt><dd class="font-bold text-neutral-text"><?= htmlspecialchars($cs['alamat_wali'] ?? '-') ?></dd></div>
                        </dl>
                    <?php else: ?>
                        <p class="text-xs text-neutral-muted italic">Tidak menggunakan wali (tinggal dan diwakilkan orang tua langsung).</p>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <!-- Right 1 Col: Panel Verifikasi Keputusan Panitia -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-neutral-border p-6 shadow-card sticky top-24">
                <h3 class="text-sm font-bold text-brand-dark pb-3 border-b border-neutral-border mb-4 flex items-center space-x-2">
                    <svg class="w-4 h-4 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Tindakan Verifikasi Panitia</span>
                </h3>

                <form action="/admin/verifikasi" method="POST" class="space-y-4">
                    <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">
                    <input type="hidden" name="calon_santri_id" value="<?= $cs['id'] ?>">

                    <div>
                        <label class="block text-xs font-semibold text-neutral-text mb-1.5">
                            Status Verifikasi Formulir <span class="text-status-error">*</span>
                        </label>
                        <select name="status" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-xs font-bold focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                            <option value="menunggu_verifikasi" <?= $statusP === 'menunggu_verifikasi' ? 'selected' : '' ?>>Menunggu Verifikasi</option>
                            <option value="sedang_diverifikasi" <?= $statusP === 'sedang_diverifikasi' ? 'selected' : '' ?>>Sedang Diverifikasi</option>
                            <option value="terverifikasi" <?= $statusP === 'terverifikasi' ? 'selected' : '' ?>>Terverifikasi (Berkas Lengkap & Valid)</option>
                            <option value="perlu_perbaikan" <?= $statusP === 'perlu_perbaikan' ? 'selected' : '' ?>>Perlu Perbaikan (Kembalikan ke Santri)</option>
                            <option value="lolos_seleksi" <?= $statusP === 'lolos_seleksi' ? 'selected' : '' ?>>Lolos Seleksi PPDB</option>
                            <option value="tidak_lolos_seleksi" <?= $statusP === 'tidak_lolos_seleksi' ? 'selected' : '' ?>>Tidak Lolos Seleksi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-neutral-text mb-1.5">
                            Catatan Verifikasi / Instruksi Revisi
                        </label>
                        <textarea name="catatan_verifikasi" rows="4"
                            placeholder="Tuliskan catatan perbaikan atau alasan jika berkas perlu direvisi oleh calon santri..."
                            class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-xs focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white"><?= htmlspecialchars($cs['catatan_verifikasi'] ?? '') ?></textarea>
                        <p class="text-[11px] text-neutral-muted mt-1">Catatan ini akan langsung tampil di dashboard calon santriwati.</p>
                    </div>

                    <button type="submit" class="w-full py-3 bg-brand-maroon hover:bg-brand-dark text-white font-extrabold text-xs rounded-xl shadow-sm transition-smooth flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Simpan Keputusan Verifikasi</span>
                    </button>
                </form>

            </div>
        </div>

    </div>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>
