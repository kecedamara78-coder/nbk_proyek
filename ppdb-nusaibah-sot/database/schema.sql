-- ===================================================================
-- SISTEM PPDB ONLINE PONDOK PESANTREN NUSAIBAH BINTI KAAB TANGERANG
-- Tahun Ajaran 2027/2028
-- Database Schema & Single-Admin Seeder
-- Charset: utf8mb4 | Collation: utf8mb4_unicode_ci | Engine: InnoDB
-- ===================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- 1. TABEL ROLES
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `label` VARCHAR(100) NOT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `label`, `description`) VALUES
(1, 'admin', 'Administrator Utama', 'Akses penuh ke seluruh sistem PPDB (Hanya 1 akun tunggal)'),
(2, 'calon_siswa', 'Calon Siswa / Santri', 'Akun pendaftar untuk melengkapi biodata dan mengunggah dokumen');

-- 2. TABEL PENGGUNA (USERS)
-- Catatan Keamanan: Sistem ini menerapkan kebijakan SINGLE ADMIN UTAMA.
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `role_id` INT UNSIGNED NOT NULL DEFAULT 2,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(191) NOT NULL UNIQUE,
  `phone_number` VARCHAR(25) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'calon_siswa') NOT NULL DEFAULT 'calon_siswa',
  `status` ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `remember_token` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_users_role` (`role`),
  INDEX `idx_users_status` (`status`),
  CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. TABEL JURUSAN / PROGRAM PENDIDIKAN (MAJORS)
DROP TABLE IF EXISTS `majors`;
CREATE TABLE `majors` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `code` VARCHAR(20) NOT NULL UNIQUE,
  `name` VARCHAR(150) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `quota` INT UNSIGNED NOT NULL DEFAULT 60,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `majors` (`id`, `code`, `name`, `description`, `quota`, `is_active`) VALUES
(1, 'THFQ', 'Tahfidz Al-Qur\'an & Ulumul Syar\'iyyah', 'Program unggulan fokus mutqin hafalan 30 Juz Al-Qur\'an bersanad, bahasa Arab aktif, tafsir, hadits, dan fiqh nisai.', 60, 1),
(2, 'MAK', 'Madrasah Aliyah Keagamaan / IPA Terpadu', 'Kurikulum terpadu Kemenag & Kemendikbudristek memadukan sains, matematika, biologi terapan dengan nilai-nilai tauhid.', 90, 1),
(3, 'BHS', 'Bahasa & Humaniora Islam', 'Penguasaan dwibahasa internasional (Arab & Inggris) secara intensif dengan persiapan studi lanjut ke Timur Tengah dan PTN.', 60, 1);

-- 4. TABEL DATA PRIBADI SISWA (STUDENT_PROFILES)
DROP TABLE IF EXISTS `student_profiles`;
CREATE TABLE `student_profiles` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL UNIQUE,
  `registration_number` VARCHAR(50) NOT NULL UNIQUE,
  `full_name` VARCHAR(150) NOT NULL,
  `nisn` VARCHAR(20) DEFAULT NULL,
  `nik` VARCHAR(20) DEFAULT NULL,
  `birth_place` VARCHAR(100) DEFAULT NULL,
  `birth_date` DATE DEFAULT NULL,
  `gender` ENUM('L', 'P') NOT NULL DEFAULT 'P',
  `religion` VARCHAR(50) NOT NULL DEFAULT 'Islam',
  `address` TEXT DEFAULT NULL,
  `phone_number` VARCHAR(25) DEFAULT NULL,
  `email` VARCHAR(191) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_sp_reg_number` (`registration_number`),
  INDEX `idx_sp_nisn` (`nisn`),
  INDEX `idx_sp_nik` (`nik`),
  CONSTRAINT `fk_student_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. TABEL DATA ORANG TUA (PARENT_PROFILES)
DROP TABLE IF EXISTS `parent_profiles`;
CREATE TABLE `parent_profiles` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `student_profile_id` INT UNSIGNED NOT NULL UNIQUE,
  `father_name` VARCHAR(150) DEFAULT NULL,
  `father_occupation` VARCHAR(100) DEFAULT NULL,
  `father_phone` VARCHAR(25) DEFAULT NULL,
  `mother_name` VARCHAR(150) DEFAULT NULL,
  `mother_occupation` VARCHAR(100) DEFAULT NULL,
  `mother_phone` VARCHAR(25) DEFAULT NULL,
  `parent_address` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_parent_student` FOREIGN KEY (`student_profile_id`) REFERENCES `student_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. TABEL DATA PENDIDIKAN ASAL (EDUCATION_PROFILES)
DROP TABLE IF EXISTS `education_profiles`;
CREATE TABLE `education_profiles` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `student_profile_id` INT UNSIGNED NOT NULL UNIQUE,
  `previous_school_name` VARCHAR(150) DEFAULT NULL,
  `npsn` VARCHAR(30) DEFAULT NULL,
  `graduation_year` VARCHAR(10) DEFAULT NULL,
  `school_address` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_education_student` FOREIGN KEY (`student_profile_id`) REFERENCES `student_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. TABEL PENDAFTARAN (REGISTRATIONS)
DROP TABLE IF EXISTS `registrations`;
CREATE TABLE `registrations` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `student_profile_id` INT UNSIGNED NOT NULL UNIQUE,
  `major_id` INT UNSIGNED DEFAULT NULL,
  `registration_number` VARCHAR(50) NOT NULL UNIQUE,
  `admission_path` ENUM('prestasi', 'reguler', 'afirmasi') NOT NULL DEFAULT 'reguler',
  `academic_year` VARCHAR(20) NOT NULL DEFAULT '2027/2028',
  `status` ENUM('draft', 'menunggu_verifikasi', 'terverifikasi', 'perlu_perbaikan', 'diterima', 'ditolak') NOT NULL DEFAULT 'draft',
  `revision_notes` TEXT DEFAULT NULL,
  `verified_by` INT UNSIGNED DEFAULT NULL,
  `verified_at` DATETIME DEFAULT NULL,
  `submitted_at` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_reg_status` (`status`),
  INDEX `idx_reg_path` (`admission_path`),
  CONSTRAINT `fk_reg_student` FOREIGN KEY (`student_profile_id`) REFERENCES `student_profiles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reg_major` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_reg_verifier` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. TABEL DOKUMEN PENDAFTARAN (REGISTRATION_DOCUMENTS)
DROP TABLE IF EXISTS `registration_documents`;
CREATE TABLE `registration_documents` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `student_profile_id` INT UNSIGNED NOT NULL,
  `document_type` ENUM('foto_siswa', 'kartu_keluarga', 'akta_kelahiran', 'ijazah_skl', 'ktp_orang_tua') NOT NULL,
  `file_name` VARCHAR(255) NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `file_size` INT UNSIGNED NOT NULL,
  `mime_type` VARCHAR(50) NOT NULL,
  `verification_status` ENUM('pending', 'valid', 'invalid') NOT NULL DEFAULT 'pending',
  `notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_doc_student` (`student_profile_id`),
  INDEX `idx_doc_type` (`document_type`),
  INDEX `idx_doc_status` (`verification_status`),
  CONSTRAINT `fk_doc_student` FOREIGN KEY (`student_profile_id`) REFERENCES `student_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. TABEL PENGUMUMAN (ANNOUNCEMENTS)
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `content` TEXT NOT NULL,
  `published_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `author_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_announcement_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `announcements` (`id`, `title`, `slug`, `content`, `author_id`) VALUES
(1, 'Pembukaan Pendaftaran Santriwati Baru TA 2027/2028 Gelombang 1', 'pembukaan-pendaftaran-2027-2028', 'Pondok Pesantren Putri Nusaibah Binti Kaab Tangerang secara resmi membuka pendaftaran santriwati baru Tahun Ajaran 2027/2028. Pendaftaran dilakukan secara mandiri melalui portal ini.', 1);

-- 10. TABEL JADWAL PPDB (SCHEDULES)
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `wave_name` VARCHAR(50) NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `description` TEXT DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `schedules` (`id`, `wave_name`, `title`, `start_date`, `end_date`, `description`, `is_active`) VALUES
(1, 'Gelombang 1', 'Pendaftaran & Pengisian Berkas', '2026-10-01', '2026-12-31', 'Pendaftaran online akun, pengisian biodata siswa & orang tua, serta upload berkas administrasi.', 1),
(2, 'Gelombang 1', 'Ujian Seleksi & Wawancara', '2027-01-10', '2027-01-12', 'Tes membaca Al-Qur\'an, tes dasar keagamaan, dan wawancara orang tua/wali.', 1),
(3, 'Gelombang 1', 'Pengumuman Hasil Seleksi', '2027-01-20', '2027-01-20', 'Pengumuman kelulusan resmi melalui dashboard akun pendaftar masing-masing.', 1),
(4, 'Gelombang 2', 'Pendaftaran Reguler Gelombang 2', '2027-02-01', '2027-04-30', 'Pendaftaran gelombang kedua dibuka jika kuota utama masih tersedia.', 0);

-- 11. TABEL LOG AKTIVITAS (ACTIVITY_LOGS)
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `action` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_log_user` (`user_id`),
  CONSTRAINT `fk_log_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===================================================================
-- SEED DATA — SISTEM SATU ADMIN UTAMA (SINGLE ADMIN)
-- Password Admin: AdminPPDB2027!
-- Password Siswa: SantriPPDB2027!
-- ===================================================================

-- TEPAT SATU AKUN ADMIN UTAMA
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone_number`, `password`, `role`, `status`) VALUES
(1, 1, 'Administrator Utama PPDB', 'admin@nusaibah.sch.id', '0895428489532', '$2b$10$tZg/uG672k15y2Q0zK/8AOnIknwXqE5U8WqQyJ8Yy73B6Fz8lqL.a', 'admin', 'aktif');

-- SAMPLE AKUN SISWA 1
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone_number`, `password`, `role`, `status`) VALUES
(2, 2, 'Aisyah Azzahra', 'santri@gmail.com', '081234567892', '$2b$10$UoWbXhBw0yS7sN3wE0qObeoW1uG3Z9kC0YqQyJ8Yy73B6Fz8lqL.a', 'calon_siswa', 'aktif');

-- SEED DATA PROFIL SANTRI
INSERT INTO `student_profiles` (`id`, `user_id`, `registration_number`, `full_name`, `nisn`, `nik`, `birth_place`, `birth_date`, `gender`, `religion`, `address`, `phone_number`, `email`) VALUES
(1, 2, 'PPDB-2027-0001', 'Aisyah Azzahra', '0091234567', '3671012345670001', 'Tangerang', '2013-05-15', 'P', 'Islam', 'Jl. KH. Hasyim Ashari No. 45, RT 03/RW 05, Cipondoh', '081234567892', 'santri@gmail.com');

-- SEED DATA ORANG TUA
INSERT INTO `parent_profiles` (`id`, `student_profile_id`, `father_name`, `father_occupation`, `father_phone`, `mother_name`, `mother_occupation`, `mother_phone`, `parent_address`) VALUES
(1, 1, 'H. Ahmad Fauzi', 'Wiraswasta', '081298765432', 'Hj. Nurhayati', 'Guru', '081298765433', 'Jl. KH. Hasyim Ashari No. 45, RT 03/RW 05, Cipondoh, Kota Tangerang');

-- SEED DATA PENDIDIKAN ASAL
INSERT INTO `education_profiles` (`id`, `student_profile_id`, `previous_school_name`, `npsn`, `graduation_year`, `school_address`) VALUES
(1, 1, 'SDIT Al-Ihsan Tangerang', '20601234', '2025', 'Jl. Maulana Hasanudin, Cipondoh, Tangerang');

-- SEED DATA PENDAFTARAN
INSERT INTO `registrations` (`id`, `student_profile_id`, `major_id`, `registration_number`, `admission_path`, `academic_year`, `status`, `revision_notes`, `submitted_at`) VALUES
(1, 1, 1, 'PPDB-2027-0001', 'prestasi', '2027/2028', 'menunggu_verifikasi', 'Berkas biodata lengkap, menunggu verifikasi dokumen persyaratan.', '2026-10-31 10:00:00');

-- SEED DOKUMEN PENDAFTARAN DUMMY
INSERT INTO `registration_documents` (`id`, `student_profile_id`, `document_type`, `file_name`, `file_path`, `file_size`, `mime_type`, `verification_status`) VALUES
(1, 1, 'foto_siswa', 'pas_foto_aisyah.jpg', '/uploads/documents/pas_foto_aisyah.jpg', 245000, 'image/jpeg', 'valid'),
(2, 1, 'kartu_keluarga', 'kk_keluarga_fauzi.pdf', '/uploads/documents/kk_keluarga_fauzi.pdf', 850000, 'application/pdf', 'pending'),
(3, 1, 'akta_kelahiran', 'akta_aisyah.pdf', '/uploads/documents/akta_aisyah.pdf', 620000, 'application/pdf', 'pending'),
(4, 1, 'ijazah_skl', 'skl_sdit_al_ihsan.pdf', '/uploads/documents/skl_sdit_al_ihsan.pdf', 910000, 'application/pdf', 'pending'),
(5, 1, 'ktp_orang_tua', 'ktp_ortu_fauzi.pdf', '/uploads/documents/ktp_ortu_fauzi.pdf', 540000, 'application/pdf', 'pending');

SET FOREIGN_KEY_CHECKS = 1;
