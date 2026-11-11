<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\Database;
use PDO;

class CalonSantri
{
    public static function generateNoPendaftaran(): string
    {
        $year = date('Y');
        $db = Database::getConnection();
        $stmt = $db->query('SELECT COUNT(*) as total FROM calon_santri');
        $row = $stmt->fetch();
        $count = (int) ($row['total'] ?? 0) + 1;

        return sprintf('PPDB-%s-%04d', $year, $count);
    }

    public static function createInitial(int $userId, string $namaLengkap, string $email = '', string $noHp = ''): int
    {
        $db = Database::getConnection();
        $db->beginTransaction();

        try {
            $noPendaftaran = self::generateNoPendaftaran();

            // 1. Insert Calon Santri
            $stmt1 = $db->prepare('INSERT INTO calon_santri (user_id, no_pendaftaran, nama_lengkap, email, no_whatsapp, status_formulir) 
                                   VALUES (:user_id, :no_pendaftaran, :nama_lengkap, :email, :no_whatsapp, :status_formulir)');
            $stmt1->execute([
                'user_id' => $userId,
                'no_pendaftaran' => $noPendaftaran,
                'nama_lengkap' => $namaLengkap,
                'email' => $email,
                'no_whatsapp' => $noHp,
                'status_formulir' => 'draft',
            ]);
            $calonSantriId = (int) $db->lastInsertId();

            // 2. Insert Data Orang Tua placeholder
            $stmt2 = $db->prepare('INSERT INTO data_orang_tua (calon_santri_id, menggunakan_wali) VALUES (:calon_santri_id, "Tidak")');
            $stmt2->execute(['calon_santri_id' => $calonSantriId]);

            // 3. Insert Pendaftaran entry
            $stmt3 = $db->prepare('INSERT INTO pendaftaran (calon_santri_id, no_pendaftaran, gelombang, status) 
                                   VALUES (:calon_santri_id, :no_pendaftaran, :gelombang, :status)');
            $stmt3->execute([
                'calon_santri_id' => $calonSantriId,
                'no_pendaftaran' => $noPendaftaran,
                'gelombang' => 'Gelombang 1',
                'status' => 'belum_lengkap',
            ]);

            $db->commit();
            return $calonSantriId;
        } catch (\Throwable $e) {
            $db->rollBack();
            throw $e;
        }
    }

    public static function findByUserId(int $userId): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT cs.*, 
                                     p.status as status_pendaftaran, p.gelombang, p.catatan_verifikasi, p.tanggal_daftar,
                                     ot.nama_ayah, ot.nik_ayah, ot.tempat_lahir_ayah, ot.tanggal_lahir_ayah, ot.pekerjaan_ayah, ot.pendidikan_ayah, ot.no_hp_ayah, ot.alamat_ayah,
                                     ot.nama_ibu, ot.nik_ibu, ot.tempat_lahir_ibu, ot.tanggal_lahir_ibu, ot.pekerjaan_ibu, ot.pendidikan_ibu, ot.no_hp_ibu, ot.alamat_ibu,
                                     ot.menggunakan_wali, ot.nama_wali, ot.hubungan_wali, ot.pekerjaan_wali, ot.no_hp_wali, ot.alamat_wali
                              FROM calon_santri cs
                              LEFT JOIN pendaftaran p ON p.calon_santri_id = cs.id
                              LEFT JOIN data_orang_tua ot ON ot.calon_santri_id = cs.id
                              WHERE cs.user_id = :user_id LIMIT 1');
        $stmt->execute(['user_id' => $userId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function findById(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT cs.*, 
                                     p.status as status_pendaftaran, p.gelombang, p.catatan_verifikasi, p.tanggal_daftar,
                                     ot.nama_ayah, ot.nik_ayah, ot.tempat_lahir_ayah, ot.tanggal_lahir_ayah, ot.pekerjaan_ayah, ot.pendidikan_ayah, ot.no_hp_ayah, ot.alamat_ayah,
                                     ot.nama_ibu, ot.nik_ibu, ot.tempat_lahir_ibu, ot.tanggal_lahir_ibu, ot.pekerjaan_ibu, ot.pendidikan_ibu, ot.no_hp_ibu, ot.alamat_ibu,
                                     ot.menggunakan_wali, ot.nama_wali, ot.hubungan_wali, ot.pekerjaan_wali, ot.no_hp_wali, ot.alamat_wali
                              FROM calon_santri cs
                              LEFT JOIN pendaftaran p ON p.calon_santri_id = cs.id
                              LEFT JOIN data_orang_tua ot ON ot.calon_santri_id = cs.id
                              WHERE cs.id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function getAllWithFilters(?string $search = null, ?string $status = null): array
    {
        $db = Database::getConnection();
        $sql = 'SELECT cs.id, cs.no_pendaftaran, cs.nama_lengkap, cs.asal_sekolah, cs.status_formulir, cs.tanggal_submit,
                       p.status as status_pendaftaran, p.gelombang, p.catatan_verifikasi,
                       u.email, u.no_hp
                FROM calon_santri cs
                INNER JOIN users u ON u.id = cs.user_id
                LEFT JOIN pendaftaran p ON p.calon_santri_id = cs.id
                WHERE 1=1';
        $params = [];

        if ($search) {
            $sql .= ' AND (cs.no_pendaftaran LIKE :search OR cs.nama_lengkap LIKE :search OR cs.asal_sekolah LIKE :search)';
            $params['search'] = '%' . $search . '%';
        }

        if ($status && $status !== 'semua') {
            $sql .= ' AND p.status = :status';
            $params['status'] = $status;
        }

        $sql .= ' ORDER BY cs.id DESC';

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function updateBiodata(int $calonSantriId, array $data, bool $isSubmit = false): bool
    {
        $db = Database::getConnection();
        $db->beginTransaction();

        try {
            // Update calon_santri
            $sqlCs = 'UPDATE calon_santri SET 
                nama_lengkap = :nama_lengkap,
                nik = :nik,
                no_kk = :no_kk,
                jenis_kelamin = :jenis_kelamin,
                tempat_lahir = :tempat_lahir,
                tanggal_lahir = :tanggal_lahir,
                agama = :agama,
                kewarganegaraan = :kewarganegaraan,
                asal_sekolah = :asal_sekolah,
                jenjang_pendidikan = :jenjang_pendidikan,
                tahun_lulus = :tahun_lulus,
                nomor_ijazah = :nomor_ijazah,
                no_whatsapp = :no_whatsapp,
                email = :email,
                alamat = :alamat,
                rt = :rt,
                rw = :rw,
                desa = :desa,
                kecamatan = :kecamatan,
                kabupaten = :kabupaten,
                provinsi = :provinsi,
                kode_pos = :kode_pos,
                anak_ke = :anak_ke,
                jumlah_saudara = :jumlah_saudara,
                riwayat_penyakit = :riwayat_penyakit,
                catatan_tambahan = :catatan_tambahan,
                status_formulir = :status_formulir,
                tanggal_submit = :tanggal_submit
                WHERE id = :id';

            $stmtCs = $db->prepare($sqlCs);
            $stmtCs->execute([
                'nama_lengkap' => trim($data['nama_lengkap'] ?? ''),
                'nik' => trim($data['nik'] ?? ''),
                'no_kk' => trim($data['no_kk'] ?? ''),
                'jenis_kelamin' => $data['jenis_kelamin'] ?? 'P',
                'tempat_lahir' => trim($data['tempat_lahir'] ?? ''),
                'tanggal_lahir' => !empty($data['tanggal_lahir']) ? $data['tanggal_lahir'] : null,
                'agama' => $data['agama'] ?? 'Islam',
                'kewarganegaraan' => $data['kewarganegaraan'] ?? 'WNI',
                'asal_sekolah' => trim($data['asal_sekolah'] ?? ''),
                'jenjang_pendidikan' => trim($data['jenjang_pendidikan'] ?? ''),
                'tahun_lulus' => trim($data['tahun_lulus'] ?? ''),
                'nomor_ijazah' => trim($data['nomor_ijazah'] ?? ''),
                'no_whatsapp' => trim($data['no_whatsapp'] ?? ''),
                'email' => trim($data['email'] ?? ''),
                'alamat' => trim($data['alamat'] ?? ''),
                'rt' => trim($data['rt'] ?? ''),
                'rw' => trim($data['rw'] ?? ''),
                'desa' => trim($data['desa'] ?? ''),
                'kecamatan' => trim($data['kecamatan'] ?? ''),
                'kabupaten' => trim($data['kabupaten'] ?? ''),
                'provinsi' => trim($data['provinsi'] ?? ''),
                'kode_pos' => trim($data['kode_pos'] ?? ''),
                'anak_ke' => !empty($data['anak_ke']) ? (int)$data['anak_ke'] : null,
                'jumlah_saudara' => !empty($data['jumlah_saudara']) ? (int)$data['jumlah_saudara'] : null,
                'riwayat_penyakit' => trim($data['riwayat_penyakit'] ?? ''),
                'catatan_tambahan' => trim($data['catatan_tambahan'] ?? ''),
                'status_formulir' => $isSubmit ? 'submitted' : 'draft',
                'tanggal_submit' => $isSubmit ? date('Y-m-d H:i:s') : null,
                'id' => $calonSantriId
            ]);

            // Update or Insert data_orang_tua
            $sqlOt = 'INSERT INTO data_orang_tua (
                calon_santri_id, nama_ayah, nik_ayah, tempat_lahir_ayah, tanggal_lahir_ayah, pekerjaan_ayah, pendidikan_ayah, no_hp_ayah, alamat_ayah,
                nama_ibu, nik_ibu, tempat_lahir_ibu, tanggal_lahir_ibu, pekerjaan_ibu, pendidikan_ibu, no_hp_ibu, alamat_ibu,
                menggunakan_wali, nama_wali, hubungan_wali, pekerjaan_wali, no_hp_wali, alamat_wali
            ) VALUES (
                :calon_santri_id, :nama_ayah, :nik_ayah, :tempat_lahir_ayah, :tanggal_lahir_ayah, :pekerjaan_ayah, :pendidikan_ayah, :no_hp_ayah, :alamat_ayah,
                :nama_ibu, :nik_ibu, :tempat_lahir_ibu, :tanggal_lahir_ibu, :pekerjaan_ibu, :pendidikan_ibu, :no_hp_ibu, :alamat_ibu,
                :menggunakan_wali, :nama_wali, :hubungan_wali, :pekerjaan_wali, :no_hp_wali, :alamat_wali
            ) ON DUPLICATE KEY UPDATE
                nama_ayah = VALUES(nama_ayah),
                nik_ayah = VALUES(nik_ayah),
                tempat_lahir_ayah = VALUES(tempat_lahir_ayah),
                tanggal_lahir_ayah = VALUES(tanggal_lahir_ayah),
                pekerjaan_ayah = VALUES(pekerjaan_ayah),
                pendidikan_ayah = VALUES(pendidikan_ayah),
                no_hp_ayah = VALUES(no_hp_ayah),
                alamat_ayah = VALUES(alamat_ayah),
                nama_ibu = VALUES(nama_ibu),
                nik_ibu = VALUES(nik_ibu),
                tempat_lahir_ibu = VALUES(tempat_lahir_ibu),
                tanggal_lahir_ibu = VALUES(tanggal_lahir_ibu),
                pekerjaan_ibu = VALUES(pekerjaan_ibu),
                pendidikan_ibu = VALUES(pendidikan_ibu),
                no_hp_ibu = VALUES(no_hp_ibu),
                alamat_ibu = VALUES(alamat_ibu),
                menggunakan_wali = VALUES(menggunakan_wali),
                nama_wali = VALUES(nama_wali),
                hubungan_wali = VALUES(hubungan_wali),
                pekerjaan_wali = VALUES(pekerjaan_wali),
                no_hp_wali = VALUES(no_hp_wali),
                alamat_wali = VALUES(alamat_wali)';

            $stmtOt = $db->prepare($sqlOt);
            $stmtOt->execute([
                'calon_santri_id' => $calonSantriId,
                'nama_ayah' => trim($data['nama_ayah'] ?? ''),
                'nik_ayah' => trim($data['nik_ayah'] ?? ''),
                'tempat_lahir_ayah' => trim($data['tempat_lahir_ayah'] ?? ''),
                'tanggal_lahir_ayah' => !empty($data['tanggal_lahir_ayah']) ? $data['tanggal_lahir_ayah'] : null,
                'pekerjaan_ayah' => trim($data['pekerjaan_ayah'] ?? ''),
                'pendidikan_ayah' => trim($data['pendidikan_ayah'] ?? ''),
                'no_hp_ayah' => trim($data['no_hp_ayah'] ?? ''),
                'alamat_ayah' => trim($data['alamat_ayah'] ?? ''),
                'nama_ibu' => trim($data['nama_ibu'] ?? ''),
                'nik_ibu' => trim($data['nik_ibu'] ?? ''),
                'tempat_lahir_ibu' => trim($data['tempat_lahir_ibu'] ?? ''),
                'tanggal_lahir_ibu' => !empty($data['tanggal_lahir_ibu']) ? $data['tanggal_lahir_ibu'] : null,
                'pekerjaan_ibu' => trim($data['pekerjaan_ibu'] ?? ''),
                'pendidikan_ibu' => trim($data['pendidikan_ibu'] ?? ''),
                'no_hp_ibu' => trim($data['no_hp_ibu'] ?? ''),
                'alamat_ibu' => trim($data['alamat_ibu'] ?? ''),
                'menggunakan_wali' => ($data['menggunakan_wali'] ?? 'Tidak') === 'Ya' ? 'Ya' : 'Tidak',
                'nama_wali' => trim($data['nama_wali'] ?? ''),
                'hubungan_wali' => trim($data['hubungan_wali'] ?? ''),
                'pekerjaan_wali' => trim($data['pekerjaan_wali'] ?? ''),
                'no_hp_wali' => trim($data['no_hp_wali'] ?? ''),
                'alamat_wali' => trim($data['alamat_wali'] ?? ''),
            ]);

            // Update status pendaftaran if submitted
            if ($isSubmit) {
                $stmtP = $db->prepare('UPDATE pendaftaran SET status = "menunggu_verifikasi" WHERE calon_santri_id = :id');
                $stmtP->execute(['id' => $calonSantriId]);
            } else {
                $stmtP = $db->prepare('UPDATE pendaftaran SET status = "belum_lengkap" WHERE calon_santri_id = :id AND status != "menunggu_verifikasi"');
                $stmtP->execute(['id' => $calonSantriId]);
            }

            $db->commit();
            return true;
        } catch (\Throwable $e) {
            $db->rollBack();
            error_log('Error saving biodata: ' . $e->getMessage());
            return false;
        }
    }

    public static function updateVerifikasi(int $calonSantriId, string $status, ?string $catatan, int $adminId): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE pendaftaran SET 
            status = :status, 
            catatan_verifikasi = :catatan,
            tanggal_diverifikasi = NOW(),
            diverifikasi_oleh = :admin_id 
            WHERE calon_santri_id = :id');
        return $stmt->execute([
            'status' => $status,
            'catatan' => $catatan,
            'admin_id' => $adminId,
            'id' => $calonSantriId
        ]);
    }
}
