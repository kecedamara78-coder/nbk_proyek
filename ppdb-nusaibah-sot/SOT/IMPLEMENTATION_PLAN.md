# IMPLEMENTATION_PLAN — PPDB Online Nusaibah Binti Kaab

**Status:** Baseline plan  
**Tujuan:** Rencana implementasi yang dapat dieksekusi bertahap. Coding dimulai hanya setelah persetujuan dokumen dan stack.

## 1. Baseline teknologi
- Frontend: HTML, CSS, JavaScript, Tailwind CSS.
- Backend: PHP; pilihan framework final harus dikonfirmasi. Default: PHP Native untuk lingkup akademik sederhana.
- Database: MySQL.
- Local server: XAMPP (Apache + MySQL).
- Grafik: Chart.js.
- PDF: DomPDF.
- Excel: PhpSpreadsheet.
- Desain: Figma.
- Version control: Git (jika tersedia).

Jangan menggabungkan Laravel dan PHP Native dalam satu implementasi. Jika Laravel dipilih, struktur dan langkah harus disesuaikan sebelum coding.

## 2. Modul dan urutan
### M0 — Project foundation
- Konfirmasi keputusan yang belum final.
- Siapkan repo/folder, konfigurasi lokal, environment example, dan README.
- Tentukan aturan coding, naming, dan struktur.

### M1 — Database dan autentikasi
- Rancang tabel users, applicant_profiles, applications, documents, verification_logs, selection_records, announcements, payments (jika aktif), settings.
- Tetapkan relasi, foreign keys, indeks, status enum/lookup, dan migration/schema.
- Implementasi login, logout, registrasi, reset password sesuai konfigurasi.
- Implementasi role authorization dan ownership checks.

### M2 — Public website
- Navbar, landing, profil, visi-misi, informasi PPDB, pengumuman publik, kontak.
- Konten resmi harus berasal dari data yang disediakan; gunakan placeholder bertanda jelas jika belum tersedia.

### M3 — Applicant portal
- Dashboard calon santri.
- Formulir multi-section dengan validasi.
- Upload dokumen dengan whitelist tipe, batas ukuran, nama file aman, penyimpanan non-public, dan pemeriksaan server.
- Nomor pendaftaran unik.
- Status, catatan revisi, dan bukti pendaftaran.

### M4 — Admin dan verifikator
- Dashboard KPI dan grafik.
- Daftar/detail pendaftar, pencarian/filter, tambah/edit sesuai izin.
- Verifikasi dokumen, catatan revisi, histori tindakan.
- Manajemen seleksi dan hasil sesuai otorisasi.
- Manajemen pengumuman dan konfigurasi dasar.

### M5 — Pembayaran dan laporan
- Implementasi hanya jika kebijakan biaya disetujui.
- Verifikasi pembayaran manual.
- Laporan/filter periode dan ekspor Excel/PDF.

### M6 — QA, hardening, delivery
- Uji alur role, validasi, upload, status, dan responsive.
- Periksa keamanan, error handling, empty/loading states.
- Siapkan instruksi instalasi, akun demo lokal, dan data dummy non-pribadi.
- Review scope terhadap PRD; hapus fitur yang tidak disetujui.

## 3. Struktur folder usulan — PHP Native
```text
project/
├── app/
│   ├── Controllers/
│   ├── Middleware/
│   ├── Models/
│   ├── Services/
│   └── Views/
├── config/
├── database/
│   ├── schema.sql
│   └── seeds/
├── public/
│   ├── assets/
│   └── index.php
├── routes/
├── storage/
│   └── uploads/
├── tests/
├── .env.example
├── AGENTS.md
└── README.md
```
Uploads harus berada di luar direktori yang dapat dieksekusi/diakses langsung; jika hosting membatasi, atur server agar akses dilakukan melalui endpoint berizin.

## 4. Prinsip arsitektur
- Pisahkan route/controller, validasi, business logic, akses data, dan view.
- Gunakan PDO prepared statements.
- Otorisasi server-side pada setiap endpoint.
- Gunakan session aman, regenerasi session ID saat login, dan logout yang menghapus session.
- CSRF token untuk request yang mengubah data.
- Escape output HTML; jangan percaya input browser.
- Validasi file server-side; jangan menggunakan nama file pengguna sebagai path.
- Rahasia hanya di environment, bukan repository.
- Gunakan transaksi database untuk proses yang harus atomik.
- Simpan timestamp dan histori perubahan status secara konsisten.

## 5. Tahap kerja dan gate persetujuan
Setiap milestone menghasilkan preview/demo, daftar file yang berubah, tes, dan catatan kendala.
1. Rancang dan tampilkan rencana milestone.
2. Minta persetujuan pengguna.
3. Implementasi milestone yang disetujui saja.
4. Jalankan tes dan laporkan hasil sebenarnya.
5. Minta persetujuan untuk milestone berikutnya.

Jangan menyatakan tes berhasil jika belum dijalankan.

## 6. QA minimum
- Registrasi/login/logout dan validasi input.
- Role: calon santri tidak dapat membuka data orang lain.
- Admin dan verifikator memiliki batas akses sesuai PRD.
- Upload: tipe salah, file terlalu besar, file valid, akses tanpa izin.
- Status: transisi yang tidak sah ditolak.
- Nomor pendaftaran: unik saat pendaftaran bersamaan.
- CSRF, XSS, SQL injection, session, dan akses langsung endpoint.
- Responsif pada mobile dan desktop.
- Empty/loading/success/error states.
- Ekspor dan PDF sesuai data yang diizinkan.

## 7. Definition of Done
- Sesuai PRD dan UI-GUIDELINE yang disetujui.
- Tidak ada scope tambahan tanpa izin.
- Validasi frontend dan backend tersedia.
- Hak akses dan keamanan dasar diuji.
- Instruksi setup lokal jelas dan dapat diikuti.
- Tidak ada credential, data santri nyata, atau file upload sensitif di repo.
- Milestone ditinjau dan disetujui pengguna.
