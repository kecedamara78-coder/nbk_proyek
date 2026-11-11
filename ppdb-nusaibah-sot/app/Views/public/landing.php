<?php
$pageTitle = 'PPDB Online TA 2027/2028 — Nusaibah Binti Kaab';
require dirname(__DIR__) . '/layouts/header.php';
?>

<!-- ================= TOP CONTACT BAR ================= -->
<div class="bg-brand-dark text-white text-[11px] py-2 border-b border-brand-maroon/40 hidden sm:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <span class="flex items-center space-x-1.5 text-white/90">
                <svg class="w-3.5 h-3.5 text-brand-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                <span>Cipondoh, Kota Tangerang, Banten</span>
            </span>
            <a href="mailto:kecedamara@gmail.com" class="flex items-center space-x-1.5 text-white/90 hover:text-brand-gold transition-smooth">
                <svg class="w-3.5 h-3.5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span>kecedamara@gmail.com</span>
            </a>
            <a href="https://wa.me/62895428489532" target="_blank" class="flex items-center space-x-1.5 text-white/90 hover:text-brand-gold transition-smooth">
                <svg class="w-3.5 h-3.5 text-brand-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                <span>+62 895-4284-89532</span>
            </a>
        </div>
        <div class="flex items-center space-x-3 font-semibold text-brand-gold">
            <span>Tahun Ajaran 2027/2028</span>
            <span class="text-white/40">|</span>
            <a href="/login" class="hover:underline text-white">Login Admin / Santri &rarr;</a>
        </div>
    </div>
</div>

<!-- ================= NAVBAR ================= -->
<header class="sticky top-0 z-50 bg-brand-maroon text-white shadow-md transition-smooth">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- Logo & Brand Name -->
            <a href="/" class="flex items-center space-x-3.5 group">
                <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-brand-maroon shadow-md group-hover:scale-105 transition-smooth">
                    <svg class="w-7 h-7 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-base sm:text-lg font-black text-white leading-tight tracking-tight uppercase">Nusaibah Binti Kaab</h1>
                    <p class="text-[11px] font-bold text-brand-gold tracking-wider uppercase">Sistem PPDB Online TA 2027/2028</p>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden lg:flex items-center space-x-6 text-xs font-bold text-white/90">
                <a href="#beranda" class="hover:text-brand-gold transition-smooth">Beranda</a>
                <a href="#profil" class="hover:text-brand-gold transition-smooth">Profil Sekolah</a>
                <a href="#informasi" class="hover:text-brand-gold transition-smooth">Informasi PPDB</a>
                <a href="#jurusan" class="hover:text-brand-gold transition-smooth">Jurusan</a>
                <a href="#pengumuman" class="hover:text-brand-gold transition-smooth">Pengumuman</a>
                <a href="#kontak" class="hover:text-brand-gold transition-smooth">Kontak</a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-3">
                <!-- Tombol Cek Status Pendaftaran -->
                <a href="/login" class="hidden sm:inline-flex items-center px-4 py-2.5 rounded-xl border-2 border-brand-gold text-brand-gold hover:bg-brand-gold hover:text-brand-maroon text-xs font-extrabold transition-smooth">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Cek Status</span>
                </a>

                <!-- Tombol DAFTAR SEKARANG: Kuning dengan Tulisan Maroon -->
                <a href="/register" class="px-5 py-2.5 rounded-xl bg-brand-gold hover:bg-yellow-400 text-brand-maroon font-black text-xs shadow-md hover:shadow-lg transition-smooth flex items-center space-x-2">
                    <span>DAFTAR SEKARANG</span>
                    <svg class="w-4 h-4 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- ================= HERO SECTION ================= -->
<section id="beranda" class="relative overflow-hidden pt-12 pb-20 lg:pt-16 lg:pb-28 bg-gradient-to-b from-brand-maroon via-brand-dark to-brand-maroon text-white">
    <!-- Subtle Background Elements -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#FFC928_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
    <div class="absolute top-10 right-10 w-96 h-96 bg-brand-gold/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Headline -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <!-- Badge Tahun Ajaran -->
                <div class="inline-flex items-center space-x-2.5 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-brand-gold/40 shadow-xs">
                    <span class="flex h-2.5 w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-gold opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-brand-gold"></span>
                    </span>
                    <span class="text-xs font-black text-brand-gold tracking-widest uppercase">
                        PENERIMAAN PESERTA DIDIK BARU TA 2027/2028
                    </span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight">
                    Penerimaan Peserta Didik Baru <br>
                    <span class="text-brand-gold underline decoration-white/30 decoration-wavy">Nusaibah Binti Kaab</span>
                </h1>

                <p class="text-sm sm:text-base text-white/90 max-w-2xl leading-relaxed">
                    Mencetak generasi santriwati unggul yang hafal Al-Qur'an 30 Juz, beraqidah salimah, beradab islami, menguasai ilmu pengetahuan umum dan bahasa internasional dalam naungan pondok pesantren modern terakreditasi.
                </p>

                <!-- Action CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-3">
                    <!-- Tombol DAFTAR SEKARANG Kuning Text Maroon -->
                    <a href="/register" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-brand-gold hover:bg-yellow-400 text-brand-maroon font-black text-sm shadow-xl hover:scale-105 transition-smooth flex items-center justify-center space-x-3">
                        <span>DAFTAR SEKARANG</span>
                        <svg class="w-5 h-5 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                    <!-- Tombol CEK STATUS PENDAFTARAN -->
                    <a href="/login" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-white hover:bg-gray-100 text-brand-maroon font-extrabold text-sm shadow-md transition-smooth flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>CEK STATUS PENDAFTARAN</span>
                    </a>
                </div>

                <!-- Highlight Metrics -->
                <div class="grid grid-cols-3 gap-3 pt-6 border-t border-white/20 max-w-lg mx-auto lg:mx-0 text-left">
                    <div class="p-3 bg-white/10 backdrop-blur-md rounded-xl border border-white/15">
                        <p class="text-xl font-black text-brand-gold">30 Juz</p>
                        <p class="text-[11px] text-white/80 font-semibold">Target Tahfidz Mutqin</p>
                    </div>
                    <div class="p-3 bg-white/10 backdrop-blur-md rounded-xl border border-white/15">
                        <p class="text-xl font-black text-white">1:15</p>
                        <p class="text-[11px] text-white/80 font-semibold">Rasio Pengajar Santri</p>
                    </div>
                    <div class="p-3 bg-white/10 backdrop-blur-md rounded-xl border border-white/15">
                        <p class="text-xl font-black text-brand-gold">100%</p>
                        <p class="text-[11px] text-white/80 font-semibold">Asrama Putri Kondusif</p>
                    </div>
                </div>

            </div>

            <!-- Right Interactive Card Banner -->
            <div class="lg:col-span-5">
                <div class="relative mx-auto max-w-md">
                    <!-- Glow Behind -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-brand-gold to-yellow-400 rounded-3xl blur-md opacity-40"></div>
                    
                    <div class="relative bg-white text-neutral-text rounded-3xl p-7 shadow-2xl border border-neutral-border">
                        <div class="flex items-center justify-between pb-4 border-b border-neutral-border">
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-wider text-brand-maroon bg-brand-maroon/10 px-2.5 py-1 rounded-full">Informasi Resmi</span>
                                <h3 class="text-base font-extrabold text-brand-dark mt-1">PPDB TA 2027/2028</h3>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-brand-gold text-brand-maroon flex items-center justify-center font-black text-xs shadow-sm">
                                2027
                            </div>
                        </div>

                        <!-- Schedule Highlights -->
                        <div class="mt-5 space-y-3.5 text-xs">
                            <div class="flex items-start space-x-3 p-3 rounded-xl bg-neutral-bg border border-neutral-border">
                                <div class="w-8 h-8 rounded-lg bg-brand-maroon text-brand-gold flex items-center justify-center font-bold shrink-0">1</div>
                                <div>
                                    <p class="font-bold text-brand-dark">Pendaftaran Gelombang 1</p>
                                    <p class="text-neutral-muted text-[11px]">01 Oktober 2026 - 31 Desember 2026</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 p-3 rounded-xl bg-neutral-bg border border-neutral-border">
                                <div class="w-8 h-8 rounded-lg bg-brand-maroon text-brand-gold flex items-center justify-center font-bold shrink-0">2</div>
                                <div>
                                    <p class="font-bold text-brand-dark">Tes Seleksi & Wawancara</p>
                                    <p class="text-neutral-muted text-[11px]">10 - 12 Januari 2027</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 p-3 rounded-xl bg-neutral-bg border border-neutral-border">
                                <div class="w-8 h-8 rounded-lg bg-brand-maroon text-brand-gold flex items-center justify-center font-bold shrink-0">3</div>
                                <div>
                                    <p class="font-bold text-brand-dark">Pengumuman Hasil Seleksi</p>
                                    <p class="text-neutral-muted text-[11px]">20 Januari 2027</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-5 border-t border-neutral-border">
                            <a href="/register" class="w-full py-3.5 px-4 rounded-xl bg-brand-maroon hover:bg-brand-dark text-white font-extrabold text-xs shadow-md transition-smooth flex items-center justify-center space-x-2">
                                <span>Mulai Registrasi Santriwati</span>
                                <span class="text-brand-gold">&rarr;</span>
                            </a>
                            <p class="text-center text-[11px] text-neutral-muted mt-2">
                                Sudah memiliki akun? <a href="/login" class="text-brand-maroon font-bold underline">Masuk di sini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= PROFIL SEKOLAH & KEUNGGULAN ================= -->
<section id="profil" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-black uppercase tracking-widest text-brand-maroon bg-brand-maroon/10 px-3.5 py-1.5 rounded-full">
                Profil & Keunggulan
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-brand-dark mt-3 tracking-tight">
                Pondok Pesantren Nusaibah Binti Kaab
            </h2>
            <div class="w-20 h-1.5 bg-brand-gold mx-auto my-3.5 rounded-full"></div>
            <p class="text-xs sm:text-sm text-neutral-muted leading-relaxed">
                Lembaga pendidikan Islam khusus putri yang berdedikasi melahirkan hafizhah Al-Qur'an mutqinah, berkarakter mulia, cerdas berwawasan sains modern, dan siap mengabdi kepada umat.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Keunggulan 1 -->
            <div class="p-7 rounded-2xl bg-neutral-bg border border-neutral-border hover:border-brand-maroon hover:shadow-card transition-smooth group">
                <div class="w-14 h-14 rounded-2xl bg-brand-maroon text-brand-gold flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-smooth">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-base font-extrabold text-brand-dark mb-2">Tahfidz 30 Juz Bersanad</h3>
                <p class="text-xs text-neutral-muted leading-relaxed">
                    Metode talaqqi & tasmi' terstruktur dengan bimbingan ustadzah hafidzah mutqinah berijazah sanad qira'ah.
                </p>
            </div>

            <!-- Keunggulan 2 -->
            <div class="p-7 rounded-2xl bg-neutral-bg border border-neutral-border hover:border-brand-maroon hover:shadow-card transition-smooth group">
                <div class="w-14 h-14 rounded-2xl bg-brand-maroon text-brand-gold flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-smooth">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-base font-extrabold text-brand-dark mb-2">Penanaman Adab & Akhlak</h3>
                <p class="text-xs text-neutral-muted leading-relaxed">
                    Penerapan keteladanan akhlak nabawiyah, adab terhadap Al-Qur'an, orang tua, ustadzah, dan sesama santriwati setiap saat.
                </p>
            </div>

            <!-- Keunggulan 3 -->
            <div class="p-7 rounded-2xl bg-neutral-bg border border-neutral-border hover:border-brand-maroon hover:shadow-card transition-smooth group">
                <div class="w-14 h-14 rounded-2xl bg-brand-maroon text-brand-gold flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-smooth">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                </div>
                <h3 class="text-base font-extrabold text-brand-dark mb-2">Bahasa Arab & Inggris Aktif</h3>
                <p class="text-xs text-neutral-muted leading-relaxed">
                    Lingkungan berbahasa aktif (bi'ah lughawiyyah) membiasakan santriwati mahir berkomunikasi dalam dua bahasa dunia.
                </p>
            </div>

            <!-- Keunggulan 4 -->
            <div class="p-7 rounded-2xl bg-neutral-bg border border-neutral-border hover:border-brand-maroon hover:shadow-card transition-smooth group">
                <div class="w-14 h-14 rounded-2xl bg-brand-maroon text-brand-gold flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-smooth">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <h3 class="text-base font-extrabold text-brand-dark mb-2">Kurikulum Nasional & Diniyah</h3>
                <p class="text-xs text-neutral-muted leading-relaxed">
                    Ijazah formal terakreditasi resmi Kemenag & Kemendikbudristek berpadu kokoh dengan kurikulum kepesantrenan terpadu.
                </p>
            </div>

            <!-- Keunggulan 5 -->
            <div class="p-7 rounded-2xl bg-neutral-bg border border-neutral-border hover:border-brand-maroon hover:shadow-card transition-smooth group">
                <div class="w-14 h-14 rounded-2xl bg-brand-maroon text-brand-gold flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-smooth">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-base font-extrabold text-brand-dark mb-2">Lingkungan Khusus Putri Asri</h3>
                <p class="text-xs text-neutral-muted leading-relaxed">
                    Kawasan asrama yang aman, terjaga privasinya, bersih, nyaman, dengan pengawasan pembina asrama selama 24 jam penuh.
                </p>
            </div>

            <!-- Keunggulan 6 -->
            <div class="p-7 rounded-2xl bg-neutral-bg border border-neutral-border hover:border-brand-maroon hover:shadow-card transition-smooth group">
                <div class="w-14 h-14 rounded-2xl bg-brand-maroon text-brand-gold flex items-center justify-center shadow-md mb-5 group-hover:scale-105 transition-smooth">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-base font-extrabold text-brand-dark mb-2">Pengembangan Minat & Bakat</h3>
                <p class="text-xs text-neutral-muted leading-relaxed">
                    Ekstrakurikuler keputrian, khitabah, tata boga halal, kaligrafi Islam, dan literasi digital beradab islami.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- ================= PROGRAM JURUSAN ================= -->
<section id="jurusan" class="py-20 bg-neutral-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-black uppercase tracking-widest text-brand-maroon bg-brand-maroon/10 px-3.5 py-1.5 rounded-full">
                Pilihan Pendidikan
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-brand-dark mt-3 tracking-tight">
                Program Jurusan TA 2027/2028
            </h2>
            <div class="w-20 h-1.5 bg-brand-gold mx-auto my-3.5 rounded-full"></div>
            <p class="text-xs sm:text-sm text-neutral-muted">
                Pilih jenjang dan peminatan yang sesuai dengan minat serta cita-cita calon santriwati.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Jurusan 1: Tahfidz -->
            <div class="bg-white rounded-3xl p-8 border-2 border-brand-maroon shadow-card relative flex flex-col justify-between">
                <span class="absolute -top-3.5 right-6 px-3.5 py-1 bg-brand-gold text-brand-maroon text-[11px] font-black rounded-full uppercase tracking-wider shadow-sm">
                    Program Unggulan
                </span>
                <div>
                    <div class="w-12 h-12 rounded-xl bg-brand-maroon text-brand-gold flex items-center justify-center font-black text-sm mb-5">
                        THFQ
                    </div>
                    <h3 class="text-lg font-black text-brand-dark mb-2">Tahfidz Al-Qur'an & Ulumul Syar'iyyah</h3>
                    <p class="text-xs text-neutral-muted leading-relaxed mb-6">
                        Fokus intensif hafalan Al-Qur'an 30 Juz mutqin, talaqqi sanad, pendalaman tajwid qira'ah, fiqh wanita, dan aqidah ahlussunnah wal jama'ah.
                    </p>
                    <ul class="space-y-2.5 text-xs text-neutral-text font-semibold mb-8">
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>Target Khatam 30 Juz Mutqin</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>Ijazah Sanad Hafalan</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>Kajian Kitab Kuning Dasar</span>
                        </li>
                    </ul>
                </div>
                <a href="/register" class="w-full py-3 rounded-xl bg-brand-maroon hover:bg-brand-dark text-white font-bold text-xs text-center transition-smooth">
                    Pilih Program Ini &rarr;
                </a>
            </div>

            <!-- Jurusan 2: IPA Terpadu -->
            <div class="bg-white rounded-3xl p-8 border border-neutral-border hover:border-brand-maroon shadow-card transition-smooth flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-brand-dark text-white flex items-center justify-center font-black text-sm mb-5">
                        MAK
                    </div>
                    <h3 class="text-lg font-black text-brand-dark mb-2">Madrasah Aliyah Keagamaan / IPA Terpadu</h3>
                    <p class="text-xs text-neutral-muted leading-relaxed mb-6">
                        Mengintegrasikan sains alam (Biologi, Fisika, Kimia, Matematika) dengan ilmu syariat dan tahfidz Al-Qur'an proporsional.
                    </p>
                    <ul class="space-y-2.5 text-xs text-neutral-text font-semibold mb-8">
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>Target Hafalan 10 - 15 Juz</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>Laboratorium IPA & Komputer</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>Bimbingan Lolos PTN Sains & Kedokteran</span>
                        </li>
                    </ul>
                </div>
                <a href="/register" class="w-full py-3 rounded-xl bg-neutral-bg hover:bg-brand-maroon hover:text-white text-brand-dark font-bold text-xs text-center transition-smooth">
                    Pilih Program Ini &rarr;
                </a>
            </div>

            <!-- Jurusan 3: Bahasa & Humaniora -->
            <div class="bg-white rounded-3xl p-8 border border-neutral-border hover:border-brand-maroon shadow-card transition-smooth flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-brand-maroon text-brand-gold flex items-center justify-center font-black text-sm mb-5">
                        BHS
                    </div>
                    <h3 class="text-lg font-black text-brand-dark mb-2">Bahasa & Humaniora Islam</h3>
                    <p class="text-xs text-neutral-muted leading-relaxed mb-6">
                        Penguatan dwibahasa internasional (Arab & Inggris) aktif harian, literasi sastra islami, dan persiapan studi ke luar negeri.
                    </p>
                    <ul class="space-y-2.5 text-xs text-neutral-text font-semibold mb-8">
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>TOEFL & TOAFL Preparation</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>Target Hafalan 10 Juz</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-brand-gold font-bold">✓</span>
                            <span>Bimbingan Beasiswa Timur Tengah</span>
                        </li>
                    </ul>
                </div>
                <a href="/register" class="w-full py-3 rounded-xl bg-neutral-bg hover:bg-brand-maroon hover:text-white text-brand-dark font-bold text-xs text-center transition-smooth">
                    Pilih Program Ini &rarr;
                </a>
            </div>

        </div>

    </div>
</section>

<!-- ================= ALUR PENDAFTARAN ================= -->
<section id="informasi" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-black uppercase tracking-widest text-brand-maroon bg-brand-maroon/10 px-3.5 py-1.5 rounded-full">
                Alur Mudah & Transparan
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-brand-dark mt-3 tracking-tight">
                Alur Pendaftaran PPDB Online
            </h2>
            <div class="w-20 h-1.5 bg-brand-gold mx-auto my-3.5 rounded-full"></div>
            <p class="text-xs sm:text-sm text-neutral-muted">
                5 langkah mudah mendaftarkan calon santriwati secara online dari rumah.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            
            <div class="bg-neutral-bg p-6 rounded-2xl border border-neutral-border text-center hover:border-brand-maroon transition-smooth">
                <div class="w-12 h-12 mx-auto rounded-full bg-brand-maroon text-brand-gold font-black flex items-center justify-center text-sm mb-4">1</div>
                <h4 class="text-xs font-extrabold text-brand-dark mb-1">Buat Akun</h4>
                <p class="text-[11px] text-neutral-muted">Registrasi online untuk mendapatkan nomor pendaftaran otomatis.</p>
            </div>

            <div class="bg-neutral-bg p-6 rounded-2xl border border-neutral-border text-center hover:border-brand-maroon transition-smooth">
                <div class="w-12 h-12 mx-auto rounded-full bg-brand-maroon text-brand-gold font-black flex items-center justify-center text-sm mb-4">2</div>
                <h4 class="text-xs font-extrabold text-brand-dark mb-1">Lengkapi Biodata</h4>
                <p class="text-[11px] text-neutral-muted">Isi formulir data diri siswa, orang tua/wali, dan riwayat sekolah.</p>
            </div>

            <div class="bg-neutral-bg p-6 rounded-2xl border border-neutral-border text-center hover:border-brand-maroon transition-smooth">
                <div class="w-12 h-12 mx-auto rounded-full bg-brand-maroon text-brand-gold font-black flex items-center justify-center text-sm mb-4">3</div>
                <h4 class="text-xs font-extrabold text-brand-dark mb-1">Upload Dokumen</h4>
                <p class="text-[11px] text-neutral-muted">Unggah scan KK, Akta Kelahiran, Ijazah/SKL, dan pas foto resmi.</p>
            </div>

            <div class="bg-neutral-bg p-6 rounded-2xl border border-neutral-border text-center hover:border-brand-maroon transition-smooth">
                <div class="w-12 h-12 mx-auto rounded-full bg-brand-maroon text-brand-gold font-black flex items-center justify-center text-sm mb-4">4</div>
                <h4 class="text-xs font-extrabold text-brand-dark mb-1">Tes & Wawancara</h4>
                <p class="text-[11px] text-neutral-muted">Mengikuti ujian membaca Al-Qur'an dan wawancara calon santri & wali.</p>
            </div>

            <div class="bg-neutral-bg p-6 rounded-2xl border border-neutral-border text-center hover:border-brand-maroon transition-smooth">
                <div class="w-12 h-12 mx-auto rounded-full bg-brand-gold text-brand-maroon font-black flex items-center justify-center text-sm mb-4">5</div>
                <h4 class="text-xs font-extrabold text-brand-dark mb-1">Pengumuman</h4>
                <p class="text-[11px] text-neutral-muted">Cek status kelulusan di dashboard portal dan cetak bukti pendaftaran.</p>
            </div>

        </div>

    </div>
</section>

<!-- ================= PENGUMUMAN & JADWAL ================= -->
<section id="pengumuman" class="py-20 bg-neutral-bg border-y border-neutral-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Jadwal Gelombang -->
            <div class="bg-white p-8 rounded-3xl border border-neutral-border shadow-card">
                <span class="text-xs font-black uppercase tracking-wider text-brand-maroon bg-brand-maroon/10 px-3 py-1 rounded-full">
                    Jadwal Gelombang
                </span>
                <h3 class="text-xl font-black text-brand-dark mt-2 mb-6">Jadwal Seleksi PPDB TA 2027/2028</h3>

                <div class="space-y-4">
                    <div class="p-4 rounded-2xl bg-neutral-bg border-l-4 border-brand-maroon flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-black uppercase text-brand-maroon">Gelombang 1 (Utama)</span>
                            <h4 class="text-xs font-extrabold text-brand-dark mt-0.5">Pendaftaran & Penyerahan Berkas</h4>
                            <p class="text-[11px] text-neutral-muted mt-0.5">01 Oktober 2026 s/d 31 Desember 2026</p>
                        </div>
                        <span class="px-2.5 py-1 bg-status-success/15 text-status-success text-[10px] font-black rounded-full">
                            Aktif
                        </span>
                    </div>

                    <div class="p-4 rounded-2xl bg-neutral-bg border-l-4 border-brand-gold flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-black uppercase text-brand-gold">Ujian Seleksi</span>
                            <h4 class="text-xs font-extrabold text-brand-dark mt-0.5">Tes Al-Qur'an & Wawancara</h4>
                            <p class="text-[11px] text-neutral-muted mt-0.5">10 - 12 Januari 2027</p>
                        </div>
                        <span class="px-2.5 py-1 bg-neutral-border text-neutral-muted text-[10px] font-bold rounded-full">
                            Mendatang
                        </span>
                    </div>

                    <div class="p-4 rounded-2xl bg-neutral-bg border-l-4 border-neutral-border flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-black uppercase text-neutral-muted">Pengumuman Resmi</span>
                            <h4 class="text-xs font-extrabold text-brand-dark mt-0.5">Pengumuman Kelulusan Portal</h4>
                            <p class="text-[11px] text-neutral-muted mt-0.5">20 Januari 2027</p>
                        </div>
                        <span class="px-2.5 py-1 bg-neutral-border text-neutral-muted text-[10px] font-bold rounded-full">
                            Mendatang
                        </span>
                    </div>
                </div>
            </div>

            <!-- Persyaratan Pendaftaran -->
            <div class="bg-white p-8 rounded-3xl border border-neutral-border shadow-card">
                <span class="text-xs font-black uppercase tracking-wider text-brand-maroon bg-brand-maroon/10 px-3 py-1 rounded-full">
                    Syarat Pendaftaran
                </span>
                <h3 class="text-xl font-black text-brand-dark mt-2 mb-6">Persyaratan Calon Santriwati</h3>

                <ul class="space-y-3 text-xs text-neutral-text font-medium">
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 rounded-full bg-brand-gold text-brand-maroon flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                        <span>Muslimah, berkelakuan baik, dan siap tinggal di asrama pesantren selama masa studi.</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 rounded-full bg-brand-gold text-brand-maroon flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                        <span>Memiliki NISN (Nomor Induk Siswa Nasional) yang valid dan terdaftar di Dapodik/EMIS.</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 rounded-full bg-brand-gold text-brand-maroon flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                        <span>Scan Kartu Keluarga (KK) dan Akta Kelahiran resmi.</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 rounded-full bg-brand-gold text-brand-maroon flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                        <span>Scan Ijazah / Surat Keterangan Lulus (SKL) dari sekolah jenjang sebelumnya.</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 rounded-full bg-brand-gold text-brand-maroon flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                        <span>Pas foto formal santriwati berjilbab rapi berlatar belakang merah / biru.</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="w-5 h-5 rounded-full bg-brand-gold text-brand-maroon flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">✓</span>
                        <span>Surat persetujuan orang tua/wali untuk mentaati tata tertib pondok pesantren.</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <span class="text-xs font-black uppercase tracking-widest text-brand-maroon bg-brand-maroon/10 px-3.5 py-1.5 rounded-full">
                Tanya Jawab
            </span>
            <h2 class="text-2xl sm:text-3xl font-black text-brand-dark mt-3">Pertanyaan yang Sering Diajukan</h2>
            <div class="w-16 h-1 bg-brand-gold mx-auto my-3 rounded-full"></div>
        </div>

        <div class="space-y-4 text-xs">
            
            <details class="group bg-neutral-bg border border-neutral-border rounded-2xl p-5 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between font-bold text-neutral-text cursor-pointer">
                    <span>Apakah pendaftaran santriwati bisa dilakukan sepenuhnya secara online?</span>
                    <span class="text-brand-maroon group-open:rotate-180 transition-smooth font-extrabold">&darr;</span>
                </summary>
                <p class="text-neutral-muted mt-3 leading-relaxed">
                    Ya, seluruh tahapan registrasi akun, pengisian biodata siswa dan orang tua, serta upload berkas dokumen dilakukan secara online melalui portal PPDB ini.
                </p>
            </details>

            <details class="group bg-neutral-bg border border-neutral-border rounded-2xl p-5 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between font-bold text-neutral-text cursor-pointer">
                    <span>Bagaimana jika calon santriwati belum memiliki ijazah resmi saat mendaftar?</span>
                    <span class="text-brand-maroon group-open:rotate-180 transition-smooth font-extrabold">&darr;</span>
                </summary>
                <p class="text-neutral-muted mt-3 leading-relaxed">
                    Calon santriwati dapat menggunakan Surat Keterangan Lulus (SKL) sementara atau fotokopi rapor semester akhir yang telah dilegalisir pihak sekolah asal.
                </p>
            </details>

            <details class="group bg-neutral-bg border border-neutral-border rounded-2xl p-5 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between font-bold text-neutral-text cursor-pointer">
                    <span>Apakah ada jalur beasiswa atau prestasi?</span>
                    <span class="text-brand-maroon group-open:rotate-180 transition-smooth font-extrabold">&darr;</span>
                </summary>
                <p class="text-neutral-muted mt-3 leading-relaxed">
                    Tersedia Jalur Prestasi khusus bagi santriwati yang memiliki hafalan Al-Qur'an minimal 5 Juz bersanad atau juara lomba keagamaan/sains tingkat kota/provinsi.
                </p>
            </details>

        </div>

    </div>
</section>

<!-- ================= INFORMASI KONTAK RESMI & FOOTER ================= -->
<footer id="kontak" class="bg-brand-dark text-white pt-16 pb-12 border-t-4 border-brand-gold">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-12 border-b border-white/10 text-xs">
            
            <!-- Identitas Sekolah -->
            <div class="md:col-span-2 space-y-4">
                <div class="flex items-center space-x-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-brand-maroon font-black shadow-md">
                        <svg class="w-7 h-7 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h4 class="text-base font-black tracking-tight text-white uppercase">Nusaibah Binti Kaab</h4>
                        <p class="text-xs text-brand-gold font-bold">Pondok Pesantren Putri Tangerang</p>
                    </div>
                </div>
                <p class="text-white/80 max-w-md leading-relaxed">
                    Membina pribadi muslimah sholihah, hafal Al-Qur'an 30 Juz, berakhlak mulia, cerdas berwawasan sains, dan siap berkontribusi nyata bagi keluarga, agama, serta bangsa.
                </p>
                <div class="pt-2">
                    <p class="text-[11px] font-bold text-brand-gold uppercase tracking-wider mb-1">Alamat Lembaga:</p>
                    <p class="text-white/80">Jl. KH. Hasyim Ashari No. 45, Cipondoh, Kota Tangerang, Banten 15148</p>
                </div>
            </div>

            <!-- Tautan Navigasi -->
            <div>
                <h5 class="text-xs font-black text-brand-gold uppercase tracking-wider mb-3.5">Navigasi Portal</h5>
                <ul class="space-y-2 text-white/80 font-medium">
                    <li><a href="#beranda" class="hover:text-brand-gold transition-smooth">Beranda Utama</a></li>
                    <li><a href="#profil" class="hover:text-brand-gold transition-smooth">Profil Sekolah</a></li>
                    <li><a href="#jurusan" class="hover:text-brand-gold transition-smooth">Program Jurusan</a></li>
                    <li><a href="#informasi" class="hover:text-brand-gold transition-smooth">Informasi PPDB</a></li>
                    <li><a href="/login" class="hover:text-brand-gold transition-smooth">Login Portal</a></li>
                    <li><a href="/register" class="hover:text-brand-gold transition-smooth">Daftar Akun Siswa</a></li>
                </ul>
            </div>

            <!-- Kontak Resmi -->
            <div>
                <h5 class="text-xs font-black text-brand-gold uppercase tracking-wider mb-3.5">Kontak Resmi PPDB</h5>
                
                <div class="space-y-3">
                    <!-- Tombol WhatsApp Resmi -->
                    <a href="https://wa.me/62895428489532" target="_blank" class="p-3 rounded-xl bg-white/10 hover:bg-white/20 border border-brand-gold/40 flex items-center space-x-3 transition-smooth group">
                        <div class="w-8 h-8 rounded-lg bg-status-success text-white flex items-center justify-center shrink-0 shadow-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[10px] text-brand-gold font-bold uppercase">WhatsApp Resmi</span>
                            <span class="font-extrabold text-white text-xs group-hover:text-brand-gold transition-smooth">+62 895-4284-89532</span>
                        </div>
                    </a>

                    <!-- Tombol Email Resmi -->
                    <a href="mailto:kecedamara@gmail.com" class="p-3 rounded-xl bg-white/10 hover:bg-white/20 border border-brand-gold/40 flex items-center space-x-3 transition-smooth group">
                        <div class="w-8 h-8 rounded-lg bg-brand-maroon text-brand-gold flex items-center justify-center shrink-0 shadow-sm border border-brand-gold/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[10px] text-brand-gold font-bold uppercase">Email Resmi</span>
                            <span class="font-extrabold text-white text-xs group-hover:text-brand-gold transition-smooth truncate block">kecedamara@gmail.com</span>
                        </div>
                    </a>
                </div>

            </div>

        </div>

        <div class="pt-6 text-center text-[11px] text-white/60 flex flex-col sm:flex-row items-center justify-between">
            <p>&copy; <?= date('Y') ?> Pondok Pesantren Nusaibah Binti Kaab Tangerang. Seluruh hak cipta dilindungi.</p>
            <p class="mt-2 sm:mt-0 font-bold text-brand-gold">Sistem PPDB Online Terpadu TA 2027/2028</p>
        </div>

    </div>
</footer>

<!-- Floating WhatsApp CTA Button (Format Internasional) -->
<a href="https://wa.me/62895428489532" target="_blank" rel="noopener noreferrer"
   class="fixed bottom-6 right-6 z-50 p-3.5 rounded-full bg-status-success hover:bg-green-600 text-white shadow-2xl flex items-center space-x-2.5 transition-smooth hover:scale-110">
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
    </svg>
    <span class="text-xs font-black pr-1 hidden sm:inline">Tanya Panitia PPDB</span>
</a>

</body>
</html>
