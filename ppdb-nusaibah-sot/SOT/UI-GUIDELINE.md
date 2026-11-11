# UI-GUIDELINE — PPDB Online Nusaibah Binti Kaab

**Status:** Baseline visual  
**Arah:** Modern futuristic SaaS, tetap hangat, terpercaya, dan sesuai konteks pesantren. Hindari tampilan berlebihan atau cyberpunk.

## 1. Identitas visual
Palet kontras marun, kuning, putih, dan hijau. Gunakan warna secara terukur:
- **Marun utama:** `#7A1830` — brand, sidebar, CTA utama.
- **Marun gelap:** `#4B1020` — heading/area gelap.
- **Kuning aksen:** `#F4C542` — highlight, indikator penting.
- **Putih:** `#FFFFFF` — permukaan utama.
- **Hijau sukses:** `#218653` — status berhasil/lolos.
- **Merah error:** `#B42332` — error/ditolak.
- **Latar netral:** `#F7F7F9`.
- **Teks utama:** `#24232A`; teks sekunder `#686873`; border `#E6E4E8`.

Warna status harus disertai label teks/icon, bukan warna saja. Pastikan kontras teks terbaca; hindari teks kuning di atas putih.

## 2. Tipografi
- Font UI: Inter atau system sans-serif.
- H1: 32–44 px desktop, 28–32 px mobile; weight 700.
- H2: 24–30 px; weight 650/700.
- H3: 18–22 px; weight 600.
- Body: 14–16 px; line-height 1.5–1.65.
- Label/helper: 12–14 px.
Gunakan hirarki konsisten; hindari terlalu banyak ukuran dan weight.

## 3. Layout dan grid
- Desktop dashboard: sidebar tetap, topbar, area konten dengan max-width yang sesuai.
- Publik: navbar sederhana, hero, section berurutan, footer.
- Formulir: satu kolom pada mobile; dua kolom hanya untuk field yang berpasangan dan layar lebar.
- Gunakan spacing berbasis 4/8 px.
- Radius: 8 px untuk input, 12 px untuk card, 16–20 px untuk panel/hero.
- Border tipis; shadow lembut dan jarang.
- Jangan menumpuk terlalu banyak card atau gradient.

## 4. Komponen
- **Button:** primary marun; secondary outline; danger merah; disabled jelas.
- **Input:** label di atas, hint opsional, error di bawah; fokus terlihat.
- **Card:** permukaan putih, border netral, heading jelas.
- **Badge/status:** Menunggu = kuning; Verifikasi = marun/amber; Revisi = merah lembut; Lolos = hijau; Tidak lolos = merah.
- **Table:** header jelas, row hover, aksi tidak memenuhi kolom; mobile memakai overflow atau list layout yang tetap terbaca.
- **Upload:** area drag/drop opsional, tombol browse, daftar file, tipe/ukuran yang diterima, progress dan error.
- **Modal/dialog:** hanya untuk konfirmasi atau tugas singkat; aksi destruktif wajib konfirmasi.
- **Toast/alert:** feedback singkat, jangan menjadi satu-satunya lokasi untuk error penting.

## 5. Halaman inti
### Public landing
1. Navbar: logo/nama pesantren, navigasi, tombol Masuk/Daftar.
2. Hero: judul penerimaan, deskripsi, CTA daftar dan lihat informasi.
3. Profil, sambutan, visi-misi, keunggulan.
4. Alur dan ringkasan persyaratan/jadwal.
5. FAQ/kontak jika datanya disediakan.
6. Footer.

### Applicant portal
- Layout bersih dengan navigasi: Ringkasan, Formulir, Dokumen, Status, Bukti.
- Progress pendaftaran terlihat.
- Status dan catatan revisi tampil dekat bagian atas.
- Draft dan submit memiliki feedback jelas.

### Admin/verifikator
- Sidebar: Dashboard, Pendaftar, Verifikasi, Seleksi, Pengumuman, Pembayaran, Laporan, Pengaturan (menu sesuai role).
- Dashboard memakai KPI cards dan grafik yang tidak menyesatkan.
- Detail pendaftar memisahkan biodata, dokumen, timeline/status, dan tindakan.
- Aksi penting memerlukan konfirmasi dan feedback.

## 6. Responsivitas
- Mobile-first; dukung lebar 320 px ke atas.
- Navbar mobile ringkas.
- Sidebar menjadi drawer/menu mobile.
- Tabel lebar dapat digulir horizontal dengan affordance.
- Target sentuh sekitar 44×44 px.
- Hindari fixed element yang menutupi CTA atau form.

## 7. Aksesibilitas dan UX
- Label form selalu terlihat; placeholder bukan label.
- Semua kontrol dapat digunakan dengan keyboard.
- Fokus keyboard jelas.
- Error menjelaskan masalah dan cara memperbaiki.
- Jangan mengandalkan warna saja.
- Loading, empty, success, error, dan disabled states disediakan.
- Konfirmasi untuk hapus, publish, dan keputusan seleksi.
- Tanggal, rupiah, dan istilah menggunakan format Indonesia.

## 8. Motion
- Transisi 150–220 ms untuk hover/focus.
- Animasi dekoratif minimal; hormati reduced-motion.
- Tidak menggunakan parallax atau animasi yang mengganggu proses pendaftaran.

## 9. Larangan visual
- Tidak memakai warna neon berlebihan.
- Tidak menampilkan data pribadi asli dalam mockup.
- Tidak menambahkan halaman/fitur di luar PRD.
- Tidak memakai ikon tanpa label untuk aksi penting.
- Tidak membuat status seleksi tampak final sebelum backend mengonfirmasi.
