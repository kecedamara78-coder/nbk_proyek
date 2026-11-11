<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\Database;
use PDO;

class User
{
    public static function findByEmail(string $email): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function findById(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT id, nama, email, no_hp, role, status, created_at FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function findByNoHp(string $noHp): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE no_hp = :no_hp LIMIT 1');
        $stmt->execute(['no_hp' => $noHp]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function create(array $data): int
    {
        $db = Database::getConnection();
        $sql = 'INSERT INTO users (nama, email, no_hp, password, role, status) 
                VALUES (:nama, :email, :no_hp, :password, :role, :status)';
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'nama' => trim($data['nama']),
            'email' => strtolower(trim($data['email'])),
            'no_hp' => trim($data['no_hp']),
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'role' => $data['role'] ?? 'calon_santri',
            'status' => $data['status'] ?? 'aktif',
        ]);

        return (int) $db->lastInsertId();
    }
}

