<?php
$pageTitle = 'Kartu Bukti Pendaftaran — ' . ($calonSantri['no_pendaftaran'] ?? '');
$cs = $calonSantri ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/app.css">
    <style>
        @media print {
            body { background: white !important; padding: 0 !important; }
            .no-print { display: none !important; }
            .print-card { border: none !important; box-shadow: none !important; padding: 0 !important; }
        }
    </style>
</head>
<body class="bg-neutral-bg text-neutral-text font-sans p-4 sm:p-8">

    <!-- Top Action Bar (Screen Only) -->
    <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between no-print">
        <a href="/santri/dashboard" class="inline-flex items-center space-x-2 text-xs font-bold text-neutral-muted hover:text-brand-maroon transition-smooth">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Dashboard</span>
        </a>
        <div class="flex items-center space-x-3">
            <button onclick="window.print()" class="px-5 py-2.5 bg-brand-maroon hover:bg-brand-dark text-white font-bold text-xs rounded-xl shadow-sm transition-smooth flex items-center space-x-2">
                <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>
    </div>

    <!-- Official Printable Card Container -->
    <div class="max-w-4xl mx-auto bg-white p-8 sm:p-12 rounded-3xl border border-neutral-border shadow-card print-card">
        
        <!-- Kop Surat Lembaga -->
        <div class="flex items-center justify-between pb-6 border-b-2 border-brand-maroon mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-2xl bg-brand-maroon flex items-center justify-center text-brand-gold shrink-0">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-brand-dark uppercase tracking-tight">Pondok Pesantren Nusaibah Binti Kaab</h1>
                    <p class="text-xs font-bold text-brand-maroon">PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB) TA 2027/2028</p>
                    <p class="text-[11px] text-neutral-muted mt-0.5">Jl. KH. Hasyim Ashari No. 45, Cipondoh, Kota Tangerang | WA: +62 895-4284-89532 | Email: kecedamara@gmail.com</p>
                </div>
            </div>
            <div class="text-right hidden sm:block">
                <div class="w-20 h-20 p-2 border-2 border-dashed border-neutral-border rounded-xl flex flex-col items-center justify-center text-center text-[10px] text-neutral-muted">
                    <span class="font-bold text-brand-maroon">QR KODE</span>
                    <span class="text-[8px]">VERIFIKASI</span>
                </div>
            </div>
        </div>

        <!-- Document Title -->
        <div class="text-center my-6">
            <h2 class="text-lg font-black text-brand-dark uppercase tracking-wide inline-block border-b-2 border-neutral-text pb-1">
                KARTU BUKTI PENDAFTARAN SANTRIWATI BARU
            </h2>
            <p class="text-xs text-neutral-muted mt-1">Dokumen ini merupakan bukti resmi registrasi PPDB Online.</p>
        </div>

        <!-- Registration Key Info Header -->
        <div class="bg-neutral-bg p-4 rounded-2xl border border-neutral-border mb-6 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
            <div>
                <span class="text-neutral-muted block">Nomor Registrasi:</span>
                <span class="font-black text-brand-maroon text-sm"><?= htmlspecialchars($cs['no_pendaftaran'] ?? 'PPDB-2026-0001') ?></span>
            </div>
            <div>
                <span class="text-neutral-muted block">Gelombang:</span>
                <span class="font-bold text-neutral-text"><?= htmlspecialchars($cs['gelombang'] ?? 'Gelombang 1') ?></span>
            </div>
            <div>
                <span class="text-neutral-muted block">Tanggal Daftar:</span>
                <span class="font-bold text-neutral-text"><?= htmlspecialchars($cs['tanggal_daftar'] ?? date('Y-m-d')) ?></span>
            </div>
            <div>
                <span class="text-neutral-muted block">Status Pendaftaran:</span>
                <span class="font-bold text-status-success uppercase"><?= htmlspecialchars($cs['status_pendaftaran'] ?? 'Terdaftar') ?></span>
            </div>
        </div>

        <!-- Content Grid: Photo + Biodata -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-8 text-xs">
            
            <!-- Photo Frame (3 cols) -->
            <div class="md:col-span-3 flex flex-col items-center text-center">
                <div class="w-32 h-44 rounded-2xl border-2 border-dashed border-neutral-border bg-neutral-bg flex flex-col items-center justify-center p-2 text-neutral-muted">
                    <svg class="w-10 h-10 text-neutral-border mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span class="text-[10px] font-bold">Pas Foto Santri</span>
                    <span class="text-[9px] text-neutral-muted">Ukuran 3 x 4</span>
                </div>
                <p class="text-[10px] text-neutral-muted mt-2">Ditempel jika belum upload</p>
            </div>

            <!-- Biodata Table (9 cols) -->
            <div class="md:col-span-9 space-y-4">
                
                <div>
                    <h3 class="font-extrabold text-brand-maroon uppercase tracking-wider text-xs pb-1 border-b border-neutral-border mb-2">
                        I. Data Pribadi Calon Santriwati
                    </h3>
                    <table class="w-full text-xs">
                        <tr class="border-b border-neutral-border/50"><td class="w-40 py-1.5 text-neutral-muted">Nama Lengkap</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['nama_lengkap'] ?? '-') ?></td></tr>
                        <tr class="border-b border-neutral-border/50"><td class="py-1.5 text-neutral-muted">NIK Santri</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['nik'] ?? '-') ?></td></tr>
                        <tr class="border-b border-neutral-border/50"><td class="py-1.5 text-neutral-muted">Nomor KK</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['no_kk'] ?? '-') ?></td></tr>
                        <tr class="border-b border-neutral-border/50"><td class="py-1.5 text-neutral-muted">Tempat, Tanggal Lahir</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['tempat_lahir'] ?? '-') ?>, <?= htmlspecialchars($cs['tanggal_lahir'] ?? '-') ?></td></tr>
                        <tr class="border-b border-neutral-border/50"><td class="py-1.5 text-neutral-muted">Asal Sekolah</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['asal_sekolah'] ?? '-') ?></td></tr>
                        <tr class="border-b border-neutral-border/50"><td class="py-1.5 text-neutral-muted">Nomor WhatsApp</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['no_whatsapp'] ?? '-') ?></td></tr>
                        <tr><td class="py-1.5 text-neutral-muted">Alamat Lengkap</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['alamat'] ?? '-') ?></td></tr>
                    </table>
                </div>

                <div>
                    <h3 class="font-extrabold text-brand-maroon uppercase tracking-wider text-xs pb-1 border-b border-neutral-border mb-2">
                        II. Data Orang Tua / Wali
                    </h3>
                    <table class="w-full text-xs">
                        <tr class="border-b border-neutral-border/50"><td class="w-40 py-1.5 text-neutral-muted">Nama Lengkap Ayah</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['nama_ayah'] ?? '-') ?> (WA: <?= htmlspecialchars($cs['no_hp_ayah'] ?? '-') ?>)</td></tr>
                        <tr class="border-b border-neutral-border/50"><td class="py-1.5 text-neutral-muted">Nama Lengkap Ibu</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['nama_ibu'] ?? '-') ?> (WA: <?= htmlspecialchars($cs['no_hp_ibu'] ?? '-') ?>)</td></tr>
                        <?php if (($cs['menggunakan_wali'] ?? 'Tidak') === 'Ya'): ?>
                            <tr><td class="py-1.5 text-neutral-muted">Wali Santri</td><td class="font-bold text-neutral-text">: <?= htmlspecialchars($cs['nama_wali'] ?? '-') ?> (<?= htmlspecialchars($cs['hubungan_wali'] ?? '-') ?>)</td></tr>
                        <?php endif; ?>
                    </table>
                </div>

            </div>

        </div>

        <!-- Petunjuk Ujian Seleksi Box -->
        <div class="p-4 bg-brand-gold/10 rounded-2xl border border-brand-gold/30 mb-8 text-[11px] text-brand-dark">
            <h4 class="font-bold mb-1">PETUNJUK BAGI CALON SANTRIWATI & WALI:</h4>
            <ol class="list-decimal list-inside space-y-1 text-neutral-text">
                <li>Bawalah lembar bukti pendaftaran ini pada saat pelaksanaan tes seleksi/observasi.</li>
                <li>Hadir 30 menit sebelum jadwal seleksi dimulai dengan mengenakan pakaian muslimah rapi, longgar, dan sopan.</li>
                <li>Informasi jadwal teknis seleksi dapat dipantau melalui portal PPDB akun masing-masing.</li>
            </ol>
        </div>

        <!-- Signature Area -->
        <div class="grid grid-cols-2 gap-8 text-xs pt-4 border-t border-neutral-border text-center">
            <div>
                <p class="text-neutral-muted">Calon Santriwati / Wali Santri</p>
                <div class="h-20"></div>
                <p class="font-bold text-neutral-text border-t border-neutral-border inline-block px-8 pt-1">
                    ( <?= htmlspecialchars($cs['nama_lengkap'] ?? '..................................') ?> )
                </p>
            </div>
            <div>
                <p class="text-neutral-muted">Tangerang, <?= date('d F Y') ?><br>Panitia PPDB Pesantren Nusaibah</p>
                <div class="h-16"></div>
                <p class="font-bold text-neutral-text border-t border-neutral-border inline-block px-8 pt-1">
                    ( Panitia PPDB Online )
                </p>
            </div>
        </div>

    </div>

</body>
</html>

