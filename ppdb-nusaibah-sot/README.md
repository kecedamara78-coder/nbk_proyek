# PPDB Online Pondok Pesantren Nusaibah Binti Kaab Tangerang

Sistem Penerimaan Peserta Didik Baru (PPDB) Online berbasis web untuk Pondok Pesantren Nusaibah Binti Kaab Tangerang. Proyek ini dikembangkan secara modular dan terukur dengan mengacu ketat pada dokumen *Source of Truth* (SOT).

---

## 1. Dokumen Acuan (Source of Truth)
Seluruh pengerjaan dan batasan ruang lingkup mengacu pada berkas berikut:
- [`SOT/PRD.md`](SOT/PRD.md) — Kebutuhan produk, spesifikasi fitur, role, dan kriteria penerimaan.
- [`SOT/UI-GUIDELINE.md`](SOT/UI-GUIDELINE.md) — Panduan desain UI/UX, palet warna, tipografi, dan layout.
- [`SOT/IMPLEMENTATION_PLAN.md`](SOT/IMPLEMENTATION_PLAN.md) — Arsitektur teknologi, tahapan milestone (M0–M6), dan standar QA.
- [`AGENTS.md`](AGENTS.md) — Aturan rekayasa perangkat lunak dan kontrak kerja AI agent.

---

## 2. Struktur Direktori Proyek (M0 Skeleton)

```text
ppdb-nusaibah-sot/
├── app/
│   ├── Controllers/          # Controller HTTP (akan diisi di M1+)
│   ├── Middleware/           # Middleware autentikasi & otorisasi role (M1+)
│   ├── Models/               # Model data & query database (M1+)
│   ├── Services/             # Business logic & validasi (M1+)
│   └── Views/                # Template antarmuka pengguna
├── config/
│   └── app.php               # Konfigurasi aplikasi, env loader, dan limit upload
├── database/
│   ├── schema.sql            # Skema database MySQL (M1+)
│   └── seeds/                # Data awal / dummy development
├── public/
│   ├── assets/
│   │   ├── css/              # Output Tailwind CSS (app.css)
│   │   └── js/               # Script client-side
│   └── index.php             # Front controller & routing entry point
├── resources/
│   └── css/
│       └── app.css           # Sumber Tailwind CSS (@theme visual guideline)
├── routes/
│   └── web.php               # Registry rute web & health check
├── storage/
│   └── uploads/              # Direktori upload terlindungi (.htaccess + index.html)
├── tests/                    # Pengujian fungsional dan unit
├── SOT/                      # Dokumen spesifikasi resmi
├── .env.example              # Template variabel lingkungan
├── .gitignore                # Pengecualian berkas rahasia & build assets
├── package.json              # Tooling Tailwind CSS via npm
└── README.md                 # Dokumentasi proyek
```

---

## 3. Prasyarat Sistem

- **Web Server & PHP**: Apache (XAMPP / standalone) dengan PHP versi 8.1 ke atas dan ekstensi `pdo_mysql`, `mbstring`.
- **Database**: MySQL 8.0+ / MariaDB 10.4+.
- **Node.js & npm**: Node.js v18+ dan npm untuk kompilasi Tailwind CSS.

---

## 4. Panduan Setup Lokal

1. **Persiapan Berkas Lingkungan**:
   Salin berkas `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Sesuaikan parameter `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai konfigurasi XAMPP / MySQL lokal Anda.

2. **Instalasi Dependency & Build Styling**:
   Instal paket npm dan kompilasi Tailwind CSS:
   ```bash
   npm install
   npm run build:css
   ```
   Untuk mode pengembangan aktif:
   ```bash
   npm run dev:css
   ```

3. **Menjalankan Web Server**:
   - **Opsi A (XAMPP)**: Tempatkan proyek di folder `htdocs/` atau arahkan VirtualHost Apache ke folder `public/`.
   - **Opsi B (PHP Built-in Server)**: Jika PHP CLI sudah tersedia di PATH, jalankan perintah dari dalam direktori ini:
     ```bash
     php -S localhost:8000 -t public
     ```
   - Buka browser pada alamat `http://localhost:8000` atau URL lokal Anda.

---

## 5. Status Milestone Saat Ini

* **M0 — Project Foundation**: ✅ **Selesai**.
  - Skeleton direktori modular PHP Native telah terpasang.
  - Template konfigurasi aman `.env.example` dan `.gitignore` tersedia.
  - Proteksi direktori `storage/uploads` aktif (.htaccess & 403 index).
  - Tooling Tailwind CSS terkonfigurasi dengan palet resmi (Marun `#7A1830`, Kuning `#F4C542`, dll.) dan berhasil dikompilasi.
  - Front controller `public/index.php` dan health check endpoint `/health` siap.
* **M1 — Database & Autentikasi**: ⏳ **Menunggu Persetujuan Pengguna**.
  - Sesuai kontrak `AGENTS.md`, fitur produk seperti tabel database, pendaftaran akun, login/logout, form biodata, dan upload berkas **belum diimplementasikan** pada M0 dan memerlukan approval gate sebelum masuk ke M1.
