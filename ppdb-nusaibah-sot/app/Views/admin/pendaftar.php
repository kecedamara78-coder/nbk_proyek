<?php
$pageTitle = 'Kelola Pendaftar PPDB';
require dirname(__DIR__) . '/layouts/header.php';

$search = $search ?? '';
$status = $status ?? 'semua';
$pendaftarList = $pendaftarList ?? [];
?>

<!-- Topbar -->
<header class="bg-white border-b border-neutral-border sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-brand-maroon flex items-center justify-center text-brand-gold shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h1 class="text-sm font-bold text-brand-dark">Pesantren Nusaibah</h1>
                    <p class="text-[11px] font-semibold text-brand-maroon uppercase tracking-wider">Panel Administrasi PPDB</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <a href="/admin/dashboard" class="text-xs font-bold text-neutral-muted hover:text-brand-maroon transition-smooth">Dashboard</a>
                <a href="/admin/pendaftar" class="text-xs font-bold text-brand-maroon border-b-2 border-brand-maroon pb-0.5">Daftar Santri</a>
                <form action="/logout" method="POST" class="inline">
                    <button type="submit" class="px-3 py-1.5 border border-status-error/30 text-status-error text-xs font-semibold rounded-lg hover:bg-status-error/10 transition-smooth">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1">
    
    <!-- Title & Subtitle -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs text-neutral-muted mb-1">
                <a href="/admin/dashboard" class="hover:text-brand-maroon">Dashboard</a>
                <span>&rsaquo;</span>
                <span class="text-neutral-text font-bold">Daftar Pendaftar</span>
            </div>
            <h2 class="text-xl font-extrabold text-brand-dark">Manajemen Data Calon Santri</h2>
            <p class="text-xs text-neutral-muted mt-0.5">Periksa, verifikasi biodata, dan kelola status penerimaan santri baru.</p>
        </div>
        <div class="text-right">
            <span class="text-xs font-bold text-neutral-muted">Total Ditemukan:</span>
            <span class="text-sm font-extrabold text-brand-maroon ml-1"><?= count($pendaftarList) ?> Pendaftar</span>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="bg-white rounded-2xl border border-neutral-border p-4 shadow-card mb-6">
        <form action="/admin/pendaftar" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="sm:col-span-2 relative">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                    placeholder="Cari nomor pendaftaran, nama santriwati, atau asal sekolah..."
                    class="w-full pl-10 pr-4 py-2.5 border border-neutral-border rounded-xl text-xs focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white">
                <svg class="w-4 h-4 text-neutral-muted absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <div class="flex items-center space-x-2">
                <select name="status" class="w-full px-3.5 py-2.5 border border-neutral-border rounded-xl text-xs focus:ring-2 focus:ring-brand-maroon focus:outline-none bg-white font-medium">
                    <option value="semua" <?= $status === 'semua' ? 'selected' : '' ?>>Semua Status</option>
                    <option value="menunggu_verifikasi" <?= $status === 'menunggu_verifikasi' ? 'selected' : '' ?>>Menunggu Verifikasi</option>
                    <option value="sedang_diverifikasi" <?= $status === 'sedang_diverifikasi' ? 'selected' : '' ?>>Sedang Diverifikasi</option>
                    <option value="terverifikasi" <?= $status === 'terverifikasi' ? 'selected' : '' ?>>Terverifikasi</option>
                    <option value="perlu_perbaikan" <?= $status === 'perlu_perbaikan' ? 'selected' : '' ?>>Perlu Perbaikan</option>
                    <option value="belum_lengkap" <?= $status === 'belum_lengkap' ? 'selected' : '' ?>>Belum Lengkap / Draft</option>
                </select>
                <button type="submit" class="px-4 py-2.5 bg-brand-maroon text-white font-bold text-xs rounded-xl hover:bg-brand-dark transition-smooth shrink-0">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Pendaftar Table Card -->
    <div class="bg-white rounded-2xl border border-neutral-border shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-neutral-bg border-b border-neutral-border text-neutral-muted uppercase tracking-wider font-bold">
                    <tr>
                        <th class="px-5 py-3.5">No. Pendaftaran</th>
                        <th class="px-5 py-3.5">Nama Santri & Kontak</th>
                        <th class="px-5 py-3.5">Asal Sekolah</th>
                        <th class="px-5 py-3.5">Status Formulir</th>
                        <th class="px-5 py-3.5">Status Verifikasi</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-border font-medium">
                    <?php if (empty($pendaftarList)): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-neutral-muted">
                                Tidak ada data pendaftar yang sesuai kriteria pencarian.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pendaftarList as $p): 
                            $statusP = $p['status_pendaftaran'] ?? 'belum_lengkap';
                            if ($statusP === 'terverifikasi') {
                                $badge = 'bg-status-success/10 text-status-success border-status-success/30';
                                $lbl = 'Terverifikasi';
                            } elseif ($statusP === 'menunggu_verifikasi') {
                                $badge = 'bg-brand-maroon/10 text-brand-maroon border-brand-maroon/30';
                                $lbl = 'Menunggu Verifikasi';
                            } elseif ($statusP === 'perlu_perbaikan') {
                                $badge = 'bg-status-error/10 text-status-error border-status-error/30';
                                $lbl = 'Perlu Perbaikan';
                            } else {
                                $badge = 'bg-neutral-border/60 text-neutral-muted border-neutral-border';
                                $lbl = 'Draft / Belum Kirim';
                            }
                        ?>
                            <tr class="hover:bg-neutral-bg/60 transition-smooth">
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="font-extrabold text-brand-maroon"><?= htmlspecialchars($p['no_pendaftaran']) ?></span>
                                    <span class="block text-[10px] text-neutral-muted"><?= htmlspecialchars($p['gelombang'] ?? 'Gelombang 1') ?></span>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="font-bold text-neutral-text block"><?= htmlspecialchars($p['nama_lengkap']) ?></span>
                                    <span class="text-[11px] text-neutral-muted block">WA: <?= htmlspecialchars($p['no_hp'] ?? '-') ?></span>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <?= htmlspecialchars($p['asal_sekolah'] ?? '-') ?>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <?php if (($p['status_formulir'] ?? '') === 'submitted'): ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-status-success/10 text-status-success">
                                            ✓ Terkirim
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-neutral-border text-neutral-muted">
                                            Draft
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold border <?= $badge ?>">
                                        <?= $lbl ?>
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <a href="/admin/santri/<?= $p['id'] ?>" class="px-3.5 py-1.5 rounded-lg bg-brand-maroon text-white font-bold text-xs hover:bg-brand-dark transition-smooth shadow-xs">
                                        Periksa Biodata &rarr;
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>
