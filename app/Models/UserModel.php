<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table          = 'users';
    protected $primaryKey     = 'id';
    protected $allowedFields  = ['nama', 'username', 'password', 'role'];

    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        // Akses array data di bawah kunci 'data' (standar CI4)
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function getUserByUsername($username)
    {
        // Pastikan hasilnya berupa array asosiatif (default first())
        return $this->where('username', $username)->first();
    }
}