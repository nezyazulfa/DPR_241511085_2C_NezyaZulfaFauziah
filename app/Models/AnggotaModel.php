<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota';
    protected $primaryKey       = 'id_anggota';
    protected $allowedFields    = [
        'id_anggota', 'gelar_depan', 'nama_depan', 'nama_belakang', 'gelar_belakang',
        'jabatan', 'status_pernikahan', 'jumlah_anak'
    ];

    // Opsional: Jika primary key bukan auto-increment, set ini
    protected $useAutoIncrement = false;
}