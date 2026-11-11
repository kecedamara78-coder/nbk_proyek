# PRD — PPDB Online Pondok Pesantren Nusaibah Binti Kaab Tangerang

**Status:** Approved baseline  
**Product:** Website penerimaan santri baru (PPDB)  
**Source of Truth:** Dokumen ini mengikat ruang lingkup produk. Fitur di luar dokumen tidak boleh dibuat tanpa persetujuan.

## 1. Ringkasan
Website untuk calon santri melakukan pendaftaran, mengirim dokumen, memantau status, dan melihat hasil seleksi. Admin dan panitia mengelola pendaftaran melalui dashboard sesuai hak akses.

## 2. Tujuan
- Digitalisasi proses penerimaan santri.
- Memusatkan biodata, dokumen, verifikasi, seleksi, dan pelaporan.
- Memberikan status proses yang dapat dipantau calon santri.
- Menjaga data dan tindakan sesuai role.

## 3. Role dan izin
| Role | Izin utama |
|---|---|
| Admin | Akses penuh: data pendaftar, panitia, seleksi, pengumuman, pembayaran, laporan, konfigurasi |
| Calon Santri | Mengelola pendaftaran sendiri, mengunggah dokumen, melihat status/catatan, mencetak bukti |
| Panitia/Verifikator | Melihat pendaftar yang ditugaskan, memeriksa dokumen, memberi catatan, memproses seleksi sesuai izin |

Semua akses harus diperiksa di sisi server. Menyembunyikan menu saja bukan kontrol akses.

## 4. Ruang lingkup fitur

### 4.1 Website publik
- Landing page: profil pesantren, sambutan pimpinan, visi-misi, keunggulan, CTA daftar.
- Informasi PPDB: persyaratan, jadwal, biaya, alur, kuota.
- Pengumuman, kontak, dan navigasi profil.
- Informasi publik hanya menampilkan data yang telah dipublikasikan.

### 4.2 Akun calon santri
- Registrasi dengan email atau nomor HP dan password.
- Login, logout, dan alur lupa password.
- Validasi input dan pesan kesalahan yang jelas.

### 4.3 Formulir dan dokumen
- Biodata: nama lengkap, NIK/NISN (jika tersedia), tempat/tanggal lahir, jenis kelamin, alamat, asal sekolah, data orang tua/wali, nomor telepon orang tua.
- Upload KK, akta kelahiran, ijazah/SKL, pas foto, dan dokumen tambahan.
- Validasi tipe dan ukuran file; batas final ditentukan pada konfigurasi/implementation plan.
- Nomor pendaftaran unik dibuat otomatis.
- Pendaftar dapat menyimpan/melengkapi data dan melihat status.

### 4.4 Status pendaftaran
Status yang ditampilkan:
- Menunggu verifikasi
- Sedang diverifikasi
- Perlu perbaikan berkas
- Lolos seleksi
- Tidak lolos seleksi

Perubahan status harus tercatat dan hanya dapat dilakukan oleh role berwenang.

### 4.5 Bukti pendaftaran
- Menampilkan nomor pendaftaran, identitas, program yang dipilih (jika program ditetapkan), dan ringkasan pendaftaran.
- Dapat dicetak atau diunduh sebagai PDF.
- QR code merupakan fitur lanjutan dan bukan syarat MVP.

### 4.6 Dashboard admin/panitia
- Dashboard statistik: total pendaftar, diterima, ditolak, menunggu verifikasi, serta grafik.
- Manajemen pendaftar: daftar, detail, pencarian, filter, tambah/edit/hapus sesuai izin.
- Verifikasi dokumen: lihat file, tandai lengkap/tidak valid, beri catatan revisi.
- Seleksi: jadwal tes/wawancara jika diberlakukan, input nilai bila diperlukan, tetapkan hasil sesuai kewenangan.
- Pengumuman: kelola dan publikasikan hasil pada waktu yang ditetapkan.
- Pembayaran: lihat bukti, status, dan riwayat; konfirmasi manual.
- Laporan: seluruh pendaftar, diterima, ditolak, periode, ekspor Excel/PDF.
- Pengaturan: akun admin/panitia, tahun ajaran, gelombang, persyaratan, informasi pesantren, dan konfigurasi PPDB.

## 5. Prioritas
**MVP / Prioritas 1:** landing page dan informasi, autentikasi, formulir, upload dokumen, nomor pendaftaran, dashboard, data pendaftar, verifikasi, status, seleksi dasar, pengumuman.

**Prioritas 2:** bukti PDF, laporan, ekspor, akun panitia, pengaturan gelombang.

**Prioritas 3 / opsional:** WhatsApp, email otomatis, QR code, pembayaran online, audit log lanjutan, backup terjadwal. Tidak dibuat tanpa persetujuan scope dan konfigurasi yang diperlukan.

## 6. Alur utama
1. Pengunjung membaca informasi PPDB.
2. Calon santri membuat akun dan login.
3. Calon santri mengisi biodata dan mengunggah dokumen.
4. Sistem membuat nomor pendaftaran dan status awal.
5. Panitia memeriksa data/dokumen.
6. Jika perlu revisi, catatan dikirim/ditampilkan dan pendaftar memperbaiki.
7. Berkas lengkap masuk proses seleksi sesuai aturan yang disahkan.
8. Admin/petugas berwenang menetapkan hasil.
9. Hasil dipublikasikan dan calon santri melihat/cetak bukti.

## 7. Aturan bisnis
- Akun hanya dapat mengakses pendaftaran miliknya.
- Nomor pendaftaran bersifat unik dan tidak dapat diubah pengguna.
- Dokumen harus memenuhi validasi format dan ukuran.
- Catatan wajib ada saat dokumen diminta diperbaiki.
- Hasil seleksi hanya ditetapkan role yang berwenang.
- Pengumuman tidak terlihat sebelum dipublikasikan.
- Status dan perubahan penting harus konsisten dengan data tersimpan.
- Pembayaran pada MVP adalah verifikasi manual jika opsi pembayaran diaktifkan.

## 8. Non-functional requirements
- Responsive untuk ponsel, tablet, dan desktop.
- Aksesibilitas dasar: label input, fokus keyboard, kontras, pesan validasi.
- Password disimpan dengan hashing yang aman; jangan pernah disimpan plaintext.
- Validasi server-side untuk seluruh input dan upload.
- Proteksi autentikasi, otorisasi, CSRF, SQL injection, XSS, dan akses file.
- Data pribadi dan dokumen hanya dapat dilihat role berwenang.
- Antarmuka berbahasa Indonesia.
- Tampilkan empty, loading, success, dan error states secara jelas.

## 9. Kriteria penerimaan
- Tiga role memiliki izin yang sesuai dan teruji.
- Calon santri dapat mendaftar, mengisi formulir, mengunggah berkas, dan memantau status.
- Panitia dapat meninjau dokumen dan mengirim catatan revisi.
- Admin dapat mengelola pendaftar, seleksi, pengumuman, dan laporan sesuai scope.
- Nomor pendaftaran unik.
- Tampilan responsif dan semua halaman inti memiliki state yang memadai.
- Tidak ada fitur di luar dokumen yang dibuat tanpa persetujuan.

## 10. Keputusan yang harus dikonfirmasi sebelum production
- Pesantren menerima santri putri saja atau putra-putri.
- Online penuh atau online + offline.
- Metode seleksi: berkas, tes, wawancara, atau kombinasi.
- Apakah ada biaya pendaftaran dan metode pembayaran.
- Tahun ajaran, gelombang, jadwal, kuota, dan persyaratan resmi.
- Pilihan stack: PHP Native atau Laravel; baseline implementasi menggunakan PHP + MySQL + Tailwind CSS kecuali pengguna memilih lain.
