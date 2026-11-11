<?php
$pageTitle = 'Dashboard Administrator PPDB';
require dirname(__DIR__) . '/layouts/header.php';

$pendaftarList = $pendaftarList ?? [];
?>

<div class="min-h-screen bg-neutral-bg flex flex-col md:flex-row">
    
    <!-- ================= ADMINLTE STYLE MAROON SIDEBAR ================= -->
    <aside class="w-full md:w-64 bg-brand-maroon text-white flex flex-col shrink-0 border-r border-brand-dark shadow-xl">
        
        <!-- Sidebar Brand Header -->
        <div class="p-5 border-b border-white/10 flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-brand-maroon font-black shadow-md">
                <svg class="w-6 h-6 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <h1 class="text-sm font-black text-white tracking-tight uppercase">Admin PPDB</h1>
                <p class="text-[10px] font-bold text-brand-gold uppercase tracking-wider">Nusaibah Binti Kaab</p>
            </div>
        </div>

        <!-- Single Admin Identity Card -->
        <div class="p-4 mx-3 my-3 rounded-2xl bg-brand-dark/80 border border-brand-gold/30">
            <div class="flex items-center space-x-2.5">
                <div class="w-8 h-8 rounded-full bg-brand-gold text-brand-maroon flex items-center justify-center font-black text-xs">
                    A
                </div>
                <div class="truncate">
                    <p class="text-xs font-black text-white truncate"><?= htmlspecialchars($user['nama'] ?? 'Admin Utama') ?></p>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-brand-gold/20 text-brand-gold uppercase">
                        Admin Tunggal
                    </span>
                </div>
            </div>
            <p class="text-[10px] text-white/70 mt-2 flex items-center space-x-1">
                <span>🔒 Single-Admin Mode</span>
            </p>
        </div>

        <!-- Sidebar Navigation Menu -->
        <nav class="flex-1 px-3 space-y-1 text-xs font-semibold overflow-y-auto">
            
            <a href="/admin/dashboard" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl bg-white/10 text-brand-gold font-bold transition-smooth">
                <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard & Statistik</span>
            </a>

            <a href="/admin/pendaftar" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-smooth">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Manajemen Data Siswa</span>
            </a>

            <div class="pt-3 pb-1 px-3.5">
                <p class="text-[10px] font-bold text-brand-gold/80 uppercase tracking-widest">Master Data</p>
            </div>

            <a href="#jurusan-section" class="flex items-center space-x-3 px-3.5 py-2 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-smooth">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span>Manajemen Jurusan</span>
            </a>

            <a href="#jadwal-section" class="flex items-center space-x-3 px-3.5 py-2 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-smooth">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Manajemen Jadwal</span>
            </a>

            <a href="#pengumuman-section" class="flex items-center space-x-3 px-3.5 py-2 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-smooth">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                <span>Manajemen Pengumuman</span>
            </a>

            <a href="#laporan-section" class="flex items-center space-x-3 px-3.5 py-2 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-smooth">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Laporan Pendaftaran</span>
            </a>

            <div class="pt-4 border-t border-white/10">
                <a href="/" class="flex items-center space-x-3 px-3.5 py-2 rounded-xl text-white/70 hover:text-white transition-smooth">
                    <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>Lihat Website Publik</span>
                </a>
            </div>

        </nav>

        <!-- Logout Form -->
        <div class="p-4 border-t border-white/10">
            <form action="/logout" method="POST">
                <button type="submit" class="w-full flex items-center justify-center space-x-2 px-3 py-2.5 rounded-xl bg-white/10 hover:bg-status-error text-white text-xs font-bold transition-smooth">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- ================= MAIN ADMIN CONTENT ================= -->
    <main class="flex-1 p-6 lg:p-8 overflow-y-auto">
        
        <!-- Header Topbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-6 border-b border-neutral-border gap-4">
            <div>
                <span class="text-[11px] font-black uppercase tracking-wider text-brand-maroon bg-brand-maroon/10 px-2.5 py-1 rounded-full">
                    Panel Kontrol PPDB TA 2027/2028
                </span>
                <h2 class="text-2xl font-black text-brand-dark mt-1">Dashboard Administrator</h2>
                <p class="text-xs text-neutral-muted">Kelola seluruh proses pendaftaran, verifikasi berkas, pengumuman, dan laporan.</p>
            </div>

            <div class="flex items-center space-x-3">
                <a href="/admin/pendaftar" class="px-5 py-2.5 bg-brand-maroon hover:bg-brand-dark text-white font-black text-xs rounded-xl shadow-md transition-smooth flex items-center space-x-2">
                    <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Verifikasi Berkas Siswa</span>
                </a>
            </div>
        </div>

        <!-- ================= 5 KPI STATISTIK UTAMA ================= -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            
            <!-- 1. Total Pendaftar -->
            <div class="bg-white p-5 rounded-2xl border border-neutral-border shadow-card hover:shadow-card-hover transition-smooth">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-neutral-muted uppercase tracking-wider">Total Pendaftar</p>
                        <p class="text-2xl font-black text-brand-dark mt-1"><?= $stats['total_pendaftar'] ?></p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-brand-maroon/10 text-brand-maroon flex items-center justify-center font-bold">
                        👥
                    </div>
                </div>
            </div>

            <!-- 2. Menunggu Verifikasi -->
            <div class="bg-white p-5 rounded-2xl border border-neutral-border shadow-card hover:shadow-card-hover transition-smooth">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-neutral-muted uppercase tracking-wider">Menunggu Verifikasi</p>
                        <p class="text-2xl font-black text-status-warning mt-1"><?= $stats['menunggu_verifikasi'] ?></p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-status-warning/15 text-status-warning flex items-center justify-center font-bold">
                        ⏳
                    </div>
                </div>
            </div>

            <!-- 3. Terverifikasi -->
            <div class="bg-white p-5 rounded-2xl border border-neutral-border shadow-card hover:shadow-card-hover transition-smooth">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-neutral-muted uppercase tracking-wider">Terverifikasi</p>
                        <p class="text-2xl font-black text-brand-maroon mt-1"><?= $stats['terverifikasi'] ?></p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-brand-maroon/10 text-brand-maroon flex items-center justify-center font-bold">
                        📄
                    </div>
                </div>
            </div>

            <!-- 4. Siswa Diterima -->
            <div class="bg-white p-5 rounded-2xl border border-neutral-border shadow-card hover:shadow-card-hover transition-smooth">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-neutral-muted uppercase tracking-wider">Siswa Diterima</p>
                        <p class="text-2xl font-black text-status-success mt-1"><?= $stats['lolos_seleksi'] ?></p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-status-success/15 text-status-success flex items-center justify-center font-bold">
                        🎉
                    </div>
                </div>
            </div>

            <!-- 5. Siswa Ditolak -->
            <div class="bg-white p-5 rounded-2xl border border-neutral-border shadow-card hover:shadow-card-hover transition-smooth">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-neutral-muted uppercase tracking-wider">Siswa Ditolak</p>
                        <p class="text-2xl font-black text-status-error mt-1">0</p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-status-error/15 text-status-error flex items-center justify-center font-bold">
                        ❌
                    </div>
                </div>
            </div>

        </div>

        <!-- ================= KEAMANAN SINGLE ADMIN NOTICE ================= -->
        <div class="mb-8 p-5 rounded-2xl bg-brand-maroon/5 border-2 border-brand-maroon/30 text-xs text-brand-dark flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl bg-brand-maroon text-brand-gold flex items-center justify-center font-black text-sm shrink-0">
                    🔒
                </div>
                <div>
                    <h4 class="font-black text-brand-maroon text-sm">Kebijakan Keamanan: Sistem Satu Akun Admin Utama</h4>
                    <p class="text-neutral-muted text-[11px] mt-0.5">
                        Sistem hanya mengizinkan tepat 1 akun admin utama (<code class="font-bold text-brand-dark">admin@nusaibah.sch.id</code>). Penambahan akun admin baru ditiadakan untuk menjaga integritas dan kerahasiaan data seluruh calon santriwati.
                    </p>
                </div>
            </div>
            <span class="px-3 py-1 bg-brand-maroon text-brand-gold font-black rounded-lg text-[10px] uppercase shrink-0">
                Single-Admin Enforced
            </span>
        </div>

        <!-- ================= LAPORAN PENDAFTARAN & EXPORT ================= -->
        <div id="laporan-section" class="bg-white p-6 rounded-3xl border border-neutral-border shadow-card mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-neutral-border gap-4">
                <div>
                    <h3 class="text-sm font-black text-brand-dark">Laporan & Rekap Pendaftaran</h3>
                    <p class="text-xs text-neutral-muted">Export data pendaftar ke format Excel / CSV atau cetak dokumen rekapitulasi PDF.</p>
                </div>
                <div class="flex items-center space-x-3">
                    <button onclick="window.print()" class="px-4 py-2 bg-white border border-neutral-border hover:border-brand-maroon text-brand-dark font-bold text-xs rounded-xl shadow-xs transition-smooth flex items-center space-x-2">
                        <svg class="w-4 h-4 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Cetak Laporan PDF</span>
                    </button>
                    <a href="/admin/pendaftar" class="px-4 py-2 bg-status-success text-white font-bold text-xs rounded-xl shadow-xs hover:bg-green-700 transition-smooth flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Export Excel / CSV</span>
                    </a>
                </div>
            </div>

            <!-- Tabel Pendaftar Cepat -->
            <div class="mt-4">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xs font-bold text-neutral-text">Antrean Pendaftar Perlu Ditinjau:</span>
                    <a href="/admin/pendaftar" class="text-xs font-extrabold text-brand-maroon hover:underline">Kelola di Tabel Pendaftar &rarr;</a>
                </div>
                <div class="p-4 rounded-2xl bg-neutral-bg border border-neutral-border text-xs flex items-center justify-between">
                    <div>
                        <span class="font-black text-brand-maroon">PPDB-2027-0001</span> — <span class="font-bold text-neutral-text">Aisyah Azzahra</span> (SDIT Al-Ihsan Tangerang)
                        <span class="block text-[11px] text-neutral-muted">Pilihan: Tahfidz Al-Qur'an 30 Juz | Jalur Prestasi</span>
                    </div>
                    <a href="/admin/santri/1" class="px-3.5 py-1.5 bg-brand-maroon hover:bg-brand-dark text-white font-bold text-xs rounded-lg transition-smooth">
                        Periksa & Verifikasi &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- ================= MASTER DATA SECTIONS ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            
            <!-- Manajemen Jurusan -->
            <div id="jurusan-section" class="bg-white p-6 rounded-3xl border border-neutral-border shadow-card">
                <div class="flex items-center justify-between pb-3 border-b border-neutral-border mb-4">
                    <h3 class="text-xs font-black uppercase text-brand-maroon tracking-wider">Manajemen Jurusan (3 Program Aktif)</h3>
                    <span class="px-2 py-0.5 bg-status-success/10 text-status-success text-[10px] font-bold rounded">TA 2027/2028</span>
                </div>
                <div class="space-y-3 text-xs">
                    <div class="p-3 rounded-xl bg-neutral-bg border border-neutral-border flex justify-between items-center">
                        <div>
                            <span class="font-bold text-brand-dark">THFQ — Tahfidz Al-Qur'an & Ulumul Syar'iyyah</span>
                            <span class="block text-[11px] text-neutral-muted">Kuota: 60 Santriwati | Status: Aktif</span>
                        </div>
                        <span class="text-status-success font-bold text-[11px]">✓ Aktif</span>
                    </div>
                    <div class="p-3 rounded-xl bg-neutral-bg border border-neutral-border flex justify-between items-center">
                        <div>
                            <span class="font-bold text-brand-dark">MAK — Madrasah Aliyah Keagamaan / IPA Terpadu</span>
                            <span class="block text-[11px] text-neutral-muted">Kuota: 90 Santriwati | Status: Aktif</span>
                        </div>
                        <span class="text-status-success font-bold text-[11px]">✓ Aktif</span>
                    </div>
                    <div class="p-3 rounded-xl bg-neutral-bg border border-neutral-border flex justify-between items-center">
                        <div>
                            <span class="font-bold text-brand-dark">BHS — Bahasa & Humaniora Islam</span>
                            <span class="block text-[11px] text-neutral-muted">Kuota: 60 Santriwati | Status: Aktif</span>
                        </div>
                        <span class="text-status-success font-bold text-[11px]">✓ Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Pengaturan Informasi Sekolah -->
            <div class="bg-white p-6 rounded-3xl border border-neutral-border shadow-card">
                <div class="flex items-center justify-between pb-3 border-b border-neutral-border mb-4">
                    <h3 class="text-xs font-black uppercase text-brand-maroon tracking-wider">Pengaturan Informasi Sekolah</h3>
                    <span class="text-[10px] text-neutral-muted">Tersinkronisasi ke Landing</span>
                </div>
                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-neutral-muted text-[10px] font-bold uppercase mb-1">Nama Lembaga:</label>
                        <p class="font-black text-brand-dark p-2.5 bg-neutral-bg rounded-xl border border-neutral-border">Pondok Pesantren Nusaibah Binti Kaab</p>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-neutral-muted text-[10px] font-bold uppercase mb-1">WhatsApp Resmi:</label>
                            <p class="font-bold text-status-success p-2.5 bg-neutral-bg rounded-xl border border-neutral-border">+62 895-4284-89532</p>
                        </div>
                        <div>
                            <label class="block text-neutral-muted text-[10px] font-bold uppercase mb-1">Email Resmi:</label>
                            <p class="font-bold text-brand-dark p-2.5 bg-neutral-bg rounded-xl border border-neutral-border truncate">kecedamara@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

</div>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>
