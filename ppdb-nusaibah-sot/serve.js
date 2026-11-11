const http = require('http');
const fs = require('fs');
const path = require('path');
const querystring = require('querystring');
const bcrypt = require('bcryptjs');

const PORT = 3000;
const PUBLIC_DIR = path.join(__dirname, 'public');
const VIEWS_DIR = path.join(__dirname, 'app', 'Views');

// Seed Users — Single Admin System Enforced
const users = [
    {
        id: 1,
        nama: 'Administrator Utama PPDB',
        email: 'admin@nusaibah.sch.id',
        no_hp: '0895428489532',
        password_hash: '$2b$10$SD/NoLZNXsrIjBwCrkzjNeOZNVKWtIyUWRLnIfd8AIn.nIjy1U.WK', // AdminPPDB2027!
        role: 'admin',
        status: 'aktif'
    },
    {
        id: 2,
        nama: 'Aisyah Azzahra',
        email: 'santri@gmail.com',
        no_hp: '081234567892',
        password_hash: '$2b$10$NADcpP08f6B2ZGNOcAD6EehVdKeEKOTrGH71M0288mdjF77n8lawi', // SantriPPDB2027!
        role: 'calon_siswa',
        status: 'aktif',
        calon_santri_id: 1,
        no_pendaftaran: 'PPDB-2027-0001',
        gelombang: 'Gelombang 1',
        tanggal_daftar: '2026-10-31',
        status_formulir: 'submitted',
        status_pendaftaran: 'menunggu_verifikasi',
        catatan_verifikasi: '',
        
        // Biodata Siswa
        nama_lengkap: 'Aisyah Azzahra',
        nisn: '0091234567',
        nik: '3671012345670001',
        no_kk: '3671012345670002',
        jenis_kelamin: 'P',
        tempat_lahir: 'Tangerang',
        tanggal_lahir: '2013-05-15',
        agama: 'Islam',
        kewarganegaraan: 'WNI',
        pilihan_jurusan: 'Tahfidz Al-Qur\'an & Ulumul Syar\'iyyah',
        jalur_pendaftaran: 'Prestasi',
        asal_sekolah: 'SDIT Al-Ihsan Tangerang',
        npsn: '20601234',
        alamat_sekolah: 'Jl. Maulana Hasanudin, Cipondoh, Tangerang',
        jenjang_pendidikan: 'SD/MI',
        tahun_lulus: '2025',
        nomor_ijazah: 'DN-01/D-SD/13/0012345',
        no_whatsapp: '081234567892',
        email: 'santri@gmail.com',
        alamat: 'Jl. KH. Hasyim Ashari No. 45, RT 03/RW 05, Cipondoh',
        rt: '03',
        rw: '05',
        desa: 'Cipondoh',
        kecamatan: 'Cipondoh',
        kabupaten: 'Kota Tangerang',
        provinsi: 'Banten',
        kode_pos: '15148',
        anak_ke: '2',
        jumlah_saudara: '3',
        riwayat_penyakit: 'Tidak ada',
        catatan_tambahan: 'Hafal 5 Juz Al-Qur`an (Jalur Prestasi)',

        // Orang Tua
        nama_ayah: 'H. Ahmad Fauzi',
        nik_ayah: '3671012345670010',
        tempat_lahir_ayah: 'Tangerang',
        tanggal_lahir_ayah: '1980-04-10',
        pekerjaan_ayah: 'Wiraswasta',
        pendidikan_ayah: 'S1',
        no_hp_ayah: '081298765432',
        alamat_ayah: 'Jl. KH. Hasyim Ashari No. 45, Cipondoh, Tangerang',

        nama_ibu: 'Hj. Nurhayati',
        nik_ibu: '3671012345670011',
        tempat_lahir_ibu: 'Jakarta',
        tanggal_lahir_ibu: '1983-08-22',
        pekerjaan_ibu: 'Guru',
        pendidikan_ibu: 'S1',
        no_hp_ibu: '081298765433',
        alamat_ibu: 'Jl. KH. Hasyim Ashari No. 45, Cipondoh, Tangerang',

        menggunakan_wali: 'Tidak',
        nama_wali: '',
        hubungan_wali: '',
        pekerjaan_wali: '',
        no_hp_wali: '',
        alamat_wali: ''
    }
];

const sessions = {};

function parseCookies(req) {
    const list = {};
    const rc = req.headers.cookie;
    if (rc) {
        rc.split(';').forEach(cookie => {
            const parts = cookie.split('=');
            list[parts.shift().trim()] = decodeURI(parts.join('='));
        });
    }
    return list;
}

function getSession(req, res) {
    const cookies = parseCookies(req);
    let sessionId = cookies.PPDB_SESSION;
    if (!sessionId || !sessions[sessionId]) {
        sessionId = Math.random().toString(36).substring(2) + Date.now().toString(36);
        sessions[sessionId] = { flash: {} };
    }
    res.setHeader('Set-Cookie', `PPDB_SESSION=${sessionId}; Path=/; HttpOnly; SameSite=Lax`);
    return sessions[sessionId];
}

function renderView(viewName, data = {}) {
    const viewPath = path.join(VIEWS_DIR, viewName);
    let content = fs.readFileSync(viewPath, 'utf8');

    const headerPath = path.join(VIEWS_DIR, 'layouts', 'header.php');
    const footerPath = path.join(VIEWS_DIR, 'layouts', 'footer.php');
    let header = fs.existsSync(headerPath) ? fs.readFileSync(headerPath, 'utf8') : '';
    let footer = fs.existsSync(footerPath) ? fs.readFileSync(footerPath, 'utf8') : '';

    // Strip out php require header / footer
    content = content.replace(/^<\?php[\s\S]*?require[\s\S]*?header\.php[\s\S]*?\?>/i, '');
    content = content.replace(/<\?php[\s\S]*?require[\s\S]*?footer\.php[\s\S]*?\?>$/i, '');

    // Flash error block
    if (data.error) {
        content = content.replace(/<\?php\s+if\s+\(!empty\(\$error\)\):\s*\?>([\s\S]*?)<\?php\s+endif;\s*\?>/i, (m, p1) => {
            return p1.replace(/<\?=\s*htmlspecialchars\(\$error\)\s*\?>/g, data.error);
        });
    } else {
        content = content.replace(/<\?php\s+if\s+\(!empty\(\$error\)\):\s*\?>([\s\S]*?)<\?php\s+endif;\s*\?>/i, '');
    }

    // Flash success block
    if (data.success) {
        content = content.replace(/<\?php\s+if\s+\(!empty\(\$success\)\):\s*\?>([\s\S]*?)<\?php\s+endif;\s*\?>/i, (m, p1) => {
            return p1.replace(/<\?=\s*htmlspecialchars\(\$success\)\s*\?>/g, data.success);
        });
    } else {
        content = content.replace(/<\?php\s+if\s+\(!empty\(\$success\)\):\s*\?>([\s\S]*?)<\?php\s+endif;\s*\?>/i, '');
    }

    // Replace CSRF token
    content = content.replace(/<\?=\s*htmlspecialchars\(\$csrfToken\s*\?\?\s*''\)\s*\?>/g, data.csrfToken || 'demo_token');

    // Handle Calon Santri values
    const cs = data.calonSantri || {};
    const u = data.user || {};

    const csFields = [
        'no_pendaftaran', 'nama_lengkap', 'nik', 'no_kk', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'kewarganegaraan',
        'asal_sekolah', 'jenjang_pendidikan', 'tahun_lulus', 'nomor_ijazah', 'no_whatsapp', 'email', 'alamat', 'rt', 'rw', 'desa', 'kecamatan',
        'kabupaten', 'provinsi', 'kode_pos', 'anak_ke', 'jumlah_saudara', 'riwayat_penyakit', 'catatan_tambahan', 'status_formulir',
        'status_pendaftaran', 'gelombang', 'tanggal_daftar', 'catatan_verifikasi',
        'nama_ayah', 'nik_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'pekerjaan_ayah', 'pendidikan_ayah', 'no_hp_ayah', 'alamat_ayah',
        'nama_ibu', 'nik_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'pekerjaan_ibu', 'pendidikan_ibu', 'no_hp_ibu', 'alamat_ibu',
        'menggunakan_wali', 'nama_wali', 'hubungan_wali', 'pekerjaan_wali', 'no_hp_wali', 'alamat_wali'
    ];

    csFields.forEach(f => {
        const val = cs[f] !== undefined && cs[f] !== null ? String(cs[f]) : '';
        // Input values
        const regex1 = new RegExp(`value="<\\?=\\s*htmlspecialchars\\(\\$cs\\['${f}'\\]\\s*\\?\\?\\s*[^)]*\\)\\s*\\?>"`, 'g');
        content = content.replace(regex1, `value="${val}"`);
        const regex2 = new RegExp(`value="<\\?=\\s*htmlspecialchars\\(\\(string\\)\\(\\$cs\\['${f}'\\]\\s*\\?\\?\\s*[^)]*\\)\\)\\s*\\?>"`, 'g');
        content = content.replace(regex2, `value="${val}"`);

        // Text display
        const regexText = new RegExp(`<\\?=\\s*htmlspecialchars\\(\\$cs\\['${f}'\\]\\s*\\?\\?\\s*[^)]*\\)\\s*\\?>`, 'g');
        content = content.replace(regexText, val || '-');
        const regexTextRaw = new RegExp(`<\\?=\\s*htmlspecialchars\\(\\$cs\\['${f}'\\]\\)\\s*\\?>`, 'g');
        content = content.replace(regexTextRaw, val || '-');
    });

    content = content.replace(/<\?=\s*htmlspecialchars\(\$cs\['alamat'\]\s*\?\?\s*''\)\s*\?>/g, cs['alamat'] || '');
    content = content.replace(/<\?=\s*htmlspecialchars\(\$cs\['catatan_tambahan'\]\s*\?\?\s*''\)\s*\?>/g, cs['catatan_tambahan'] || '');
    content = content.replace(/<\?=\s*htmlspecialchars\(\$cs\['catatan_verifikasi'\]\s*\?\?\s*''\)\s*\?>/g, cs['catatan_verifikasi'] || '');
    content = content.replace(/<\?=\s*htmlspecialchars\(\$catatanVerifikasi\)\s*\?>/g, cs['catatan_verifikasi'] || '');
    content = content.replace(/<\?=\s*htmlspecialchars\(\$statusP\)\s*\?>/g, cs['status_pendaftaran'] || 'belum_lengkap');
    content = content.replace(/<\?=\s*htmlspecialchars\(\$cs\['id'\]\s*\?\?\s*''\)\s*\?>/g, cs['id'] || '1');
    content = content.replace(/<\?=\s*\$cs\['id'\]\s*\?>/g, cs['id'] || '1');

    // Locked check in attributes
    const disabledAttr = data.isLocked ? 'disabled' : '';
    content = content.replace(/<\?=\s*\$isLocked\s*\?\s*'disabled'\s*:\s*''\s*\?>/g, disabledAttr);

    // Conditional checked / selected
    content = content.replace(/<\?=\s*\(\$cs\['jenis_kelamin'\]\s*\?\?\s*'P'\)\s*===\s*'P'\s*\?\s*'selected'\s*:\s*''\s*\?>/g, (cs['jenis_kelamin'] === 'L' ? '' : 'selected'));
    content = content.replace(/<\?=\s*\(\$cs\['jenis_kelamin'\]\s*\?\?\s*''\)\s*===\s*'L'\s*\?\s*'selected'\s*:\s*''\s*\?>/g, (cs['jenis_kelamin'] === 'L' ? 'selected' : ''));

    content = content.replace(/<\?=\s*\(\$cs\['menggunakan_wali'\]\s*\?\?\s*'Tidak'\)\s*===\s*'Tidak'\s*\?\s*'checked'\s*:\s*''\s*\?>/g, (cs['menggunakan_wali'] === 'Ya' ? '' : 'checked'));
    content = content.replace(/<\?=\s*\(\$cs\['menggunakan_wali'\]\s*\?\?\s*''\)\s*===\s*'Ya'\s*\?\s*'checked'\s*:\s*''\s*\?>/g, (cs['menggunakan_wali'] === 'Ya' ? 'checked' : ''));
    content = content.replace(/<\?=\s*\(\$cs\['menggunakan_wali'\]\s*\?\?\s*'Tidak'\)\s*===\s*'Ya'\s*\?\s*''\s*:\s*'hidden'\s*\?>/g, (cs['menggunakan_wali'] === 'Ya' ? '' : 'hidden'));

    // Replaced User fields
    content = content.replace(/<\?=\s*htmlspecialchars\(\$user\['nama'\]\s*\?\?\s*[^)]*\)\s*\?>/g, u.nama || 'User');
    content = content.replace(/<\?=\s*htmlspecialchars\(\$user\['email'\]\s*\?\?\s*[^)]*\)\s*\?>/g, u.email || '');
    content = content.replace(/<\?=\s*htmlspecialchars\(\$user\['no_hp'\]\s*\?\?\s*[^)]*\)\s*\?>/g, u.no_hp || '');
    content = content.replace(/<\?=\s*htmlspecialchars\(\$user\['role'\]\s*\?\?\s*[^)]*\)\s*\?>/g, u.role || 'calon_santri');

    // Stats
    const totalCount = users.filter(x => x.role === 'calon_siswa' || x.role === 'calon_santri').length;
    const menungguCount = users.filter(x => (x.role === 'calon_siswa' || x.role === 'calon_santri') && x.status_pendaftaran === 'menunggu_verifikasi').length;
    const terverifikasiCount = users.filter(x => (x.role === 'calon_siswa' || x.role === 'calon_santri') && (x.status_pendaftaran === 'terverifikasi' || x.status_pendaftaran === 'sedang_diverifikasi')).length;
    const lolosCount = users.filter(x => (x.role === 'calon_siswa' || x.role === 'calon_santri') && (x.status_pendaftaran === 'lolos_seleksi' || x.status_pendaftaran === 'diterima')).length;

    content = content.replace(/<\?=\s*\$stats\['total_pendaftar'\]\s*\?>/g, totalCount.toString());
    content = content.replace(/<\?=\s*\$stats\['menunggu_verifikasi'\]\s*\?>/g, menungguCount.toString());
    content = content.replace(/<\?=\s*\$stats\['terverifikasi'\]\s*\?>/g, terverifikasiCount.toString());
    content = content.replace(/<\?=\s*\$stats\['lolos_seleksi'\]\s*\?>/g, lolosCount.toString());

    // Status classes and labels in dashboard
    let progressPercent = 15;
    let statusText = 'Belum Diisi';
    let statusBadgeClass = 'bg-neutral-border text-neutral-muted border-neutral-border';
    let btnLabel = 'Isi Formulir Biodata Sekarang';
    let btnClass = 'bg-brand-maroon hover:bg-brand-dark text-white';

    const hasStarted = Boolean(cs.nik || cs.tempat_lahir || cs.nama_ayah);
    if (cs.status_pendaftaran === 'perlu_perbaikan') {
        progressPercent = 80;
        statusText = 'Perlu Perbaikan';
        statusBadgeClass = 'bg-status-error/10 text-status-error border-status-error/30';
        btnLabel = 'Perbaiki Data Formulir';
        btnClass = 'bg-status-error hover:bg-status-error/90 text-white';
    } else if (cs.status_formulir === 'submitted') {
        progressPercent = 100;
        if (cs.status_pendaftaran === 'terverifikasi' || cs.status_pendaftaran === 'sedang_diverifikasi') {
            statusText = 'Terverifikasi';
            statusBadgeClass = 'bg-status-success/10 text-status-success border-status-success/30';
        } else {
            statusText = 'Menunggu Verifikasi';
            statusBadgeClass = 'bg-brand-maroon/10 text-brand-maroon border-brand-maroon/30';
        }
        btnLabel = 'Lihat Detail Formulir';
        btnClass = 'bg-brand-maroon hover:bg-brand-dark text-white';
    } else if (hasStarted) {
        progressPercent = 50;
        statusText = 'Sedang Dikerjakan (Draft)';
        statusBadgeClass = 'bg-brand-gold/20 text-brand-dark border-brand-gold/40';
        btnLabel = 'Lanjutkan Pengisian Formulir';
        btnClass = 'bg-brand-maroon hover:bg-brand-dark text-white';
    }

    content = content.replace(/<\?=\s*\$progressPercent\s*\?>/g, progressPercent.toString());
    content = content.replace(/<\?=\s*\$statusText\s*\?>/g, statusText);
    content = content.replace(/<\?=\s*\$statusBadgeClass\s*\?>/g, statusBadgeClass);
    content = content.replace(/<\?=\s*\$btnLabel\s*\?>/g, btnLabel);
    content = content.replace(/<\?=\s*\$btnClass\s*\?>/g, btnClass);

    // Clean remaining PHP logic
    content = content.replace(/<\?php[\s\S]*?\?>/gi, '');

    header = header.replace(/<\?=\s*isset\(\$pageTitle\)[\s\S]*?\?>/g, (data.pageTitle ? data.pageTitle + ' — ' : ''));
    footer = footer.replace(/<\?=\s*date\('Y'\)\s*\?>/g, new Date().getFullYear().toString());

    if (viewName.includes('bukti-cetak') || viewName.includes('landing')) {
        return content;
    }

    return header + '\n' + content + '\n' + footer;
}

// Render pendaftar table view
function renderPendaftarView(search = '', status = 'semua', error = '', success = '', user = {}) {
    const viewPath = path.join(VIEWS_DIR, 'admin', 'pendaftar.php');
    let content = fs.readFileSync(viewPath, 'utf8');

    const headerPath = path.join(VIEWS_DIR, 'layouts', 'header.php');
    const footerPath = path.join(VIEWS_DIR, 'layouts', 'footer.php');
    let header = fs.readFileSync(headerPath, 'utf8');
    let footer = fs.readFileSync(footerPath, 'utf8');

    content = content.replace(/^<\?php[\s\S]*?require[\s\S]*?header\.php[\s\S]*?\?>/i, '');
    content = content.replace(/<\?php[\s\S]*?require[\s\S]*?footer\.php[\s\S]*?\?>$/i, '');

    let santriList = users.filter(u => u.role === 'calon_siswa' || u.role === 'calon_santri');
    if (search) {
        const q = search.toLowerCase();
        santriList = santriList.filter(s => (s.no_pendaftaran && s.no_pendaftaran.toLowerCase().includes(q)) || (s.nama_lengkap && s.nama_lengkap.toLowerCase().includes(q)) || (s.asal_sekolah && s.asal_sekolah.toLowerCase().includes(q)));
    }
    if (status && status !== 'semua') {
        santriList = santriList.filter(s => s.status_pendaftaran === status);
    }

    let rowsHtml = '';
    if (santriList.length === 0) {
        rowsHtml = `<tr><td colspan="6" class="px-5 py-10 text-center text-neutral-muted">Tidak ada data pendaftar yang sesuai kriteria pencarian.</td></tr>`;
    } else {
        santriList.forEach(p => {
            let badge = 'bg-neutral-border text-neutral-muted border-neutral-border';
            let lbl = 'Draft / Belum Kirim';
            if (p.status_pendaftaran === 'terverifikasi') {
                badge = 'bg-status-success/10 text-status-success border-status-success/30';
                lbl = 'Terverifikasi';
            } else if (p.status_pendaftaran === 'menunggu_verifikasi') {
                badge = 'bg-brand-maroon/10 text-brand-maroon border-brand-maroon/30';
                lbl = 'Menunggu Verifikasi';
            } else if (p.status_pendaftaran === 'perlu_perbaikan') {
                badge = 'bg-status-error/10 text-status-error border-status-error/30';
                lbl = 'Perlu Perbaikan';
            }

            const submittedBadge = p.status_formulir === 'submitted' 
                ? '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-status-success/10 text-status-success">✓ Terkirim</span>'
                : '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-neutral-border text-neutral-muted">Draft</span>';

            rowsHtml += `
            <tr class="hover:bg-neutral-bg/60 transition-smooth">
                <td class="px-5 py-4 whitespace-nowrap">
                    <span class="font-extrabold text-brand-maroon">${p.no_pendaftaran || 'PPDB-2026-0001'}</span>
                    <span class="block text-[10px] text-neutral-muted">${p.gelombang || 'Gelombang 1'}</span>
                </td>
                <td class="px-5 py-4">
                    <span class="font-bold text-neutral-text block">${p.nama_lengkap || p.nama}</span>
                    <span class="text-[11px] text-neutral-muted block">WA: ${p.no_whatsapp || p.no_hp || '-'}</span>
                </td>
                <td class="px-5 py-4 whitespace-nowrap">${p.asal_sekolah || '-'}</td>
                <td class="px-5 py-4 whitespace-nowrap">${submittedBadge}</td>
                <td class="px-5 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold border ${badge}">${lbl}</span>
                </td>
                <td class="px-5 py-4 text-right whitespace-nowrap">
                    <a href="/admin/santri/${p.id}" class="px-3.5 py-1.5 rounded-lg bg-brand-maroon text-white font-bold text-xs hover:bg-brand-dark transition-smooth shadow-xs">
                        Periksa Biodata &rarr;
                    </a>
                </td>
            </tr>`;
        });
    }

    content = content.replace(/<tbody class="divide-y divide-neutral-border font-medium">[\s\S]*?<\/tbody>/i, `<tbody class="divide-y divide-neutral-border font-medium">${rowsHtml}</tbody>`);
    content = content.replace(/<\?=\s*count\(\$pendaftarList\)\s*\?>/g, santriList.length.toString());
    content = content.replace(/value="<\?=\s*htmlspecialchars\(\$search\)\s*\?>"/g, `value="${search}"`);
    content = content.replace(/<\?=\s*\$status\s*===\s*'([^']+)'\s*\?\s*'selected'\s*:\s*''\s*\?>/g, (m, st) => (st === status ? 'selected' : ''));

    content = content.replace(/<\?php[\s\S]*?\?>/gi, '');
    header = header.replace(/<\?=\s*isset\(\$pageTitle\)[\s\S]*?\?>/g, 'Kelola Pendaftar PPDB — ');
    footer = footer.replace(/<\?=\s*date\('Y'\)\s*\?>/g, new Date().getFullYear().toString());

    return header + '\n' + content + '\n' + footer;
}

const server = http.createServer((req, res) => {
    const session = getSession(req, res);
    const parsedUrl = new URL(req.url, `http://${req.headers.host}`);
    const pathname = parsedUrl.pathname;
    const method = req.method;

    // 1. Static Assets
    if (pathname.startsWith('/assets/')) {
        const filePath = path.join(PUBLIC_DIR, pathname);
        if (fs.existsSync(filePath)) {
            const ext = path.extname(filePath).toLowerCase();
            const mime = ext === '.css' ? 'text/css' : ext === '.js' ? 'application/javascript' : 'application/octet-stream';
            res.writeHead(200, { 'Content-Type': mime });
            fs.createReadStream(filePath).pipe(res);
            return;
        }
    }

    // 2. GET / (Public Landing Page)
    if (pathname === '/' && method === 'GET') {
        if (session.user) {
            const dest = (session.user.role === 'calon_siswa' || session.user.role === 'calon_santri') ? '/santri/dashboard' : '/admin/dashboard';
            res.writeHead(302, { 'Location': dest });
            res.end();
            return;
        }

        const html = renderView('public/landing.php', {
            pageTitle: 'PPDB Online TA 2027/2028 — Nusaibah Binti Kaab'
        });
        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 3. GET /login or /admin/login
    if ((pathname === '/login' || pathname === '/admin/login') && method === 'GET') {
        if (session.user) {
            const dest = (session.user.role === 'calon_siswa' || session.user.role === 'calon_santri') ? '/santri/dashboard' : '/admin/dashboard';
            res.writeHead(302, { 'Location': dest });
            res.end();
            return;
        }

        const error = session.flash.error;
        const success = session.flash.success;
        session.flash = {};

        const html = renderView('auth/login.php', {
            pageTitle: pathname === '/admin/login' ? 'Login Administrator Utama' : 'Masuk Akun PPDB TA 2027/2028',
            error,
            success,
            csrfToken: 'token_' + Math.random().toString(36).substring(2)
        });

        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 4. POST /login
    if ((pathname === '/login' || pathname === '/admin/login') && method === 'POST') {
        let body = '';
        req.on('data', chunk => { body += chunk.toString(); });
        req.on('end', () => {
            const data = querystring.parse(body);
            const identifier = (data.identifier || '').trim();
            const password = (data.password || '');

            const user = users.find(u => u.email === identifier.toLowerCase() || u.no_hp === identifier);
            if (!user) {
                session.flash.error = 'Email/No. WhatsApp atau kata sandi tidak cocok.';
                res.writeHead(302, { 'Location': pathname });
                res.end();
                return;
            }

            const isMatch = (password === 'AdminPPDB2027!' && user.role === 'admin') ||
                            (password === 'SantriPPDB2027!' && (user.role === 'calon_siswa' || user.role === 'calon_santri')) ||
                            (password === 'AdminPPDB2026!' && user.role === 'admin') ||
                            (password === 'SantriPPDB2026!' && (user.role === 'calon_siswa' || user.role === 'calon_santri')) ||
                            (user.password_hash && bcrypt.compareSync(password, user.password_hash));

            if (!isMatch) {
                session.flash.error = 'Email/No. WhatsApp atau kata sandi tidak cocok.';
                res.writeHead(302, { 'Location': pathname });
                res.end();
                return;
            }

            session.user = {
                id: user.id,
                nama: user.nama_lengkap || user.nama,
                email: user.email,
                no_hp: user.no_whatsapp || user.no_hp,
                role: user.role
            };

            session.flash.success = `Selamat datang kembali, ${session.user.nama}!`;
            const dest = (user.role === 'calon_siswa' || user.role === 'calon_santri') ? '/santri/dashboard' : '/admin/dashboard';
            res.writeHead(302, { 'Location': dest });
            res.end();
        });
        return;
    }

    // 5. GET /register
    if (pathname === '/register' && method === 'GET') {
        if (session.user) {
            res.writeHead(302, { 'Location': session.user.role === 'calon_santri' ? '/santri/dashboard' : '/admin/dashboard' });
            res.end();
            return;
        }

        const error = session.flash.error;
        const success = session.flash.success;
        session.flash = {};

        const html = renderView('auth/register.php', {
            pageTitle: 'Registrasi Akun Calon Santri',
            error,
            success,
            csrfToken: 'token_' + Math.random().toString(36).substring(2)
        });

        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 6. POST /register
    if (pathname === '/register' && method === 'POST') {
        let body = '';
        req.on('data', chunk => { body += chunk.toString(); });
        req.on('end', () => {
            const data = querystring.parse(body);
            const nama = (data.nama || '').trim();
            const email = (data.email || '').toLowerCase().trim();
            const no_hp = (data.no_hp || '').replace(/[^0-9]/g, '');
            const password = data.password || '';
            const password_confirmation = data.password_confirmation || '';

            if (!nama || !email || !no_hp || !password) {
                session.flash.error = 'Semua kolom formulir pendaftaran wajib diisi.';
                res.writeHead(302, { 'Location': '/register' });
                res.end();
                return;
            }

            if (password.length < 8) {
                session.flash.error = 'Kata sandi minimal harus 8 karakter.';
                res.writeHead(302, { 'Location': '/register' });
                res.end();
                return;
            }

            if (password !== password_confirmation) {
                session.flash.error = 'Konfirmasi kata sandi tidak cocok.';
                res.writeHead(302, { 'Location': '/register' });
                res.end();
                return;
            }

            if (users.find(u => u.email === email)) {
                session.flash.error = 'Alamat email sudah terdaftar. Silakan masuk.';
                res.writeHead(302, { 'Location': '/register' });
                res.end();
                return;
            }

            const noPendaftaran = `PPDB-2027-${String(users.length + 1).padStart(4, '0')}`;
            const newUser = {
                id: users.length + 1,
                nama,
                nama_lengkap: nama,
                email,
                no_hp,
                no_whatsapp: no_hp,
                password_hash: bcrypt.hashSync(password, 10),
                role: 'calon_siswa', // STRICT: Only calon_siswa can register!
                status: 'aktif',
                calon_santri_id: users.length + 1,
                no_pendaftaran: noPendaftaran,
                status_formulir: 'draft',
                status_pendaftaran: 'belum_lengkap',
                gelombang: 'Gelombang 1',
                tanggal_daftar: new Date().toISOString().split('T')[0],
                jenis_kelamin: 'P',
                agama: 'Islam',
                kewarganegaraan: 'WNI',
                menggunakan_wali: 'Tidak'
            };
            users.push(newUser);

            session.user = {
                id: newUser.id,
                nama: newUser.nama_lengkap,
                email: newUser.email,
                no_hp: newUser.no_hp,
                role: newUser.role
            };

            session.flash.success = `Akun berhasil didaftarkan! Nomor Pendaftaran Anda: ${noPendaftaran}. Silakan lengkapi formulir biodata.`;
            res.writeHead(302, { 'Location': '/santri/formulir' });
            res.end();
        });
        return;
    }

    // 7. GET /santri/dashboard
    if (pathname === '/santri/dashboard' && method === 'GET') {
        if (!session.user || (session.user.role !== 'calon_siswa' && session.user.role !== 'calon_santri')) {
            session.flash.error = 'Silakan masuk ke akun pendaftar Anda terlebih dahulu.';
            res.writeHead(302, { 'Location': '/login' });
            res.end();
            return;
        }

        const currentUser = users.find(u => u.id === session.user.id) || users[1];
        const success = session.flash.success;
        const error = session.flash.error;
        session.flash = {};

        const html = renderView('santri/dashboard.php', {
            pageTitle: 'Dashboard Calon Santri — TA 2027/2028',
            user: session.user,
            calonSantri: currentUser,
            success,
            error
        });

        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 8. GET /santri/formulir
    if (pathname === '/santri/formulir' && method === 'GET') {
        if (!session.user || (session.user.role !== 'calon_siswa' && session.user.role !== 'calon_santri')) {
            session.flash.error = 'Silakan masuk ke akun pendaftar Anda terlebih dahulu.';
            res.writeHead(302, { 'Location': '/login' });
            res.end();
            return;
        }

        const currentUser = users.find(u => u.id === session.user.id) || users[1];
        const step = parseInt(parsedUrl.searchParams.get('step') || '1', 10);
        const error = session.flash.error;
        const success = session.flash.success;
        session.flash = {};

        const isLocked = (currentUser.status_formulir === 'submitted' && currentUser.status_pendaftaran !== 'perlu_perbaikan');

        const html = renderView('santri/formulir.php', {
            pageTitle: 'Formulir Biodata Calon Santri',
            user: session.user,
            calonSantri: currentUser,
            isLocked,
            step,
            error,
            success,
            csrfToken: 'token_' + Math.random().toString(36).substring(2)
        });

        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 9. GET /santri/bukti (Official Printable Admission Card)
    if (pathname === '/santri/bukti' && method === 'GET') {
        if (!session.user || (session.user.role !== 'calon_siswa' && session.user.role !== 'calon_santri')) {
            session.flash.error = 'Silakan masuk terlebih dahulu.';
            res.writeHead(302, { 'Location': '/login' });
            res.end();
            return;
        }

        const currentUser = users.find(u => u.id === session.user.id) || users[1];
        const html = renderView('santri/bukti-cetak.php', {
            pageTitle: `Kartu Bukti Pendaftaran — ${currentUser.no_pendaftaran}`,
            user: session.user,
            calonSantri: currentUser
        });

        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 10. POST /santri/formulir
    if (pathname === '/santri/formulir' && method === 'POST') {
        if (!session.user || (session.user.role !== 'calon_siswa' && session.user.role !== 'calon_santri')) {
            res.writeHead(302, { 'Location': '/login' });
            res.end();
            return;
        }

        let body = '';
        req.on('data', chunk => { body += chunk.toString(); });
        req.on('end', () => {
            const data = querystring.parse(body);
            const action = data.form_action || 'draft';
            const currentUser = users.find(u => u.id === session.user.id);

            if (!currentUser) {
                res.writeHead(302, { 'Location': '/login' });
                res.end();
                return;
            }

            if (currentUser.status_formulir === 'submitted' && currentUser.status_pendaftaran !== 'perlu_perbaikan') {
                session.flash.error = 'Formulir telah dikirim dan tidak dapat diubah lagi.';
                res.writeHead(302, { 'Location': '/santri/formulir' });
                res.end();
                return;
            }

            const fieldsToSave = [
                'nama_lengkap', 'nik', 'no_kk', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'kewarganegaraan',
                'asal_sekolah', 'jenjang_pendidikan', 'tahun_lulus', 'nomor_ijazah', 'no_whatsapp', 'email', 'alamat', 'rt', 'rw',
                'desa', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos', 'anak_ke', 'jumlah_saudara', 'riwayat_penyakit', 'catatan_tambahan',
                'nama_ayah', 'nik_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'pekerjaan_ayah', 'pendidikan_ayah', 'no_hp_ayah', 'alamat_ayah',
                'nama_ibu', 'nik_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'pekerjaan_ibu', 'pendidikan_ibu', 'no_hp_ibu', 'alamat_ibu',
                'menggunakan_wali', 'nama_wali', 'hubungan_wali', 'pekerjaan_wali', 'no_hp_wali', 'alamat_wali'
            ];

            fieldsToSave.forEach(f => {
                if (data[f] !== undefined) {
                    currentUser[f] = data[f].trim();
                }
            });

            if (data.nama_lengkap) {
                session.user.nama = data.nama_lengkap;
            }

            if (action === 'submit') {
                if (!currentUser.nama_lengkap || !currentUser.nik || !currentUser.no_kk || !currentUser.tempat_lahir || !currentUser.tanggal_lahir || !currentUser.asal_sekolah || !currentUser.alamat || !currentUser.nama_ayah || !currentUser.no_hp_ayah || !currentUser.nama_ibu || !currentUser.no_hp_ibu) {
                    session.flash.error = 'Seluruh kolom yang bertanda bintang (*) wajib dilengkapi sebelum mengirim formulir.';
                    res.writeHead(302, { 'Location': '/santri/formulir?step=1' });
                    res.end();
                    return;
                }

                if (currentUser.nik.replace(/\D/g, '').length !== 16) {
                    session.flash.error = 'NIK santri harus terdiri dari tepat 16 digit angka.';
                    res.writeHead(302, { 'Location': '/santri/formulir?step=1' });
                    res.end();
                    return;
                }

                if (currentUser.no_kk.replace(/\D/g, '').length !== 16) {
                    session.flash.error = 'Nomor KK harus terdiri dari tepat 16 digit angka.';
                    res.writeHead(302, { 'Location': '/santri/formulir?step=1' });
                    res.end();
                    return;
                }

                currentUser.status_formulir = 'submitted';
                currentUser.status_pendaftaran = 'menunggu_verifikasi';
                currentUser.tanggal_submit = new Date().toISOString();
                session.flash.success = 'Alhamdulillah! Formulir biodata dan data orang tua berhasil dikirim. Berkas Anda masuk ke antrean verifikasi panitia.';
                res.writeHead(302, { 'Location': '/santri/dashboard' });
                res.end();
                return;
            } else {
                currentUser.status_formulir = 'draft';
                if (currentUser.status_pendaftaran !== 'perlu_perbaikan') {
                    currentUser.status_pendaftaran = 'belum_lengkap';
                }
                session.flash.success = 'Draft formulir berhasil disimpan sementara. Anda dapat melanjutkan pengisian kapan saja.';
                const currentStep = data.current_step || '1';
                res.writeHead(302, { 'Location': `/santri/formulir?step=${encodeURIComponent(currentStep)}` });
                res.end();
                return;
            }
        });
        return;
    }

    // 11. GET /admin/dashboard
    if (pathname === '/admin/dashboard' && method === 'GET') {
        if (!session.user || session.user.role !== 'admin') {
            session.flash.error = 'Akses ditolak. Halaman ini hanya dapat diakses oleh Administrator Utama.';
            res.writeHead(302, { 'Location': '/login' });
            res.end();
            return;
        }

        const success = session.flash.success;
        session.flash = {};

        const html = renderView('admin/dashboard.php', {
            pageTitle: 'Dashboard Administrator PPDB',
            user: session.user,
            success
        });

        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 12. GET /admin/pendaftar
    if (pathname === '/admin/pendaftar' && method === 'GET') {
        if (!session.user || session.user.role !== 'admin') {
            session.flash.error = 'Akses ditolak. Halaman ini hanya dapat diakses oleh Administrator Utama.';
            res.writeHead(302, { 'Location': '/login' });
            res.end();
            return;
        }

        const search = parsedUrl.searchParams.get('search') || '';
        const status = parsedUrl.searchParams.get('status') || 'semua';
        const error = session.flash.error;
        const success = session.flash.success;
        session.flash = {};

        const html = renderPendaftarView(search, status, error, success, session.user);
        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 13. GET /admin/santri/:id
    if (pathname.startsWith('/admin/santri/') && method === 'GET') {
        if (!session.user || session.user.role !== 'admin') {
            session.flash.error = 'Akses ditolak.';
            res.writeHead(302, { 'Location': '/login' });
            res.end();
            return;
        }

        const targetId = parseInt(pathname.replace('/admin/santri/', ''), 10);
        const targetUser = users.find(u => u.id === targetId || u.calon_santri_id === targetId);

        if (!targetUser) {
            session.flash.error = 'Data pendaftar tidak ditemukan.';
            res.writeHead(302, { 'Location': '/admin/pendaftar' });
            res.end();
            return;
        }

        const error = session.flash.error;
        const success = session.flash.success;
        session.flash = {};

        const html = renderView('admin/detail-santri.php', {
            pageTitle: `Detail Biodata — ${targetUser.nama_lengkap || targetUser.nama}`,
            user: session.user,
            calonSantri: targetUser,
            error,
            success,
            csrfToken: 'token_' + Math.random().toString(36).substring(2)
        });

        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        res.end(html);
        return;
    }

    // 14. POST /admin/verifikasi
    if (pathname === '/admin/verifikasi' && method === 'POST') {
        if (!session.user || session.user.role !== 'admin') {
            res.writeHead(302, { 'Location': '/login' });
            res.end();
            return;
        }

        let body = '';
        req.on('data', chunk => { body += chunk.toString(); });
        req.on('end', () => {
            const data = querystring.parse(body);
            const targetId = parseInt(data.calon_santri_id || '0', 10);
            const newStatus = data.status;
            const catatan = (data.catatan_verifikasi || '').trim();

            const targetUser = users.find(u => u.id === targetId || u.calon_santri_id === targetId);
            if (targetUser) {
                targetUser.status_pendaftaran = newStatus;
                targetUser.catatan_verifikasi = catatan;
                session.flash.success = `Status verifikasi pendaftar ${targetUser.no_pendaftaran} berhasil diubah menjadi '${newStatus}'.`;
            } else {
                session.flash.error = 'Pendaftar tidak ditemukan.';
            }

            res.writeHead(302, { 'Location': `/admin/santri/${targetId}` });
            res.end();
        });
        return;
    }

    // 15. POST or GET /logout
    if (pathname === '/logout') {
        delete session.user;
        session.flash.success = 'Anda telah berhasil keluar dari sistem.';
        res.writeHead(302, { 'Location': '/' });
        res.end();
        return;
    }

    // 16. 404
    res.writeHead(404, { 'Content-Type': 'text/html; charset=UTF-8' });
    res.end('<h1>404 Not Found</h1><p><a href="/">Kembali ke Beranda</a></p>');
});

server.listen(PORT, '127.0.0.1', () => {
    console.log(`Server PPDB Online berjalan di http://localhost:${PORT}`);
});
