<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota'; // Pastikan nama tabel benar
    protected $primaryKey       = 'id_anggota';
    protected $useAutoIncrement = false; // Karena id_anggota mungkin manual/non-auto-increment
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_anggota', 
        'gelar_depan', 
        'nama_depan', 
        'nama_belakang', 
        'gelar_belakang', 
        'jabatan', 
        'status_pernikahan', 
        'jumlah_anak'
    ];

    // Method untuk menampilkan nama lengkap
    public function getNamaLengkap($anggota)
    {
        $nama = trim(($anggota['gelar_depan'] ? $anggota['gelar_depan'] . '. ' : '') .
                    $anggota['nama_depan'] . ' ' .
                    $anggota['nama_belakang'] . 
                    ($anggota['gelar_belakang'] ? ', ' . $anggota['gelar_belakang'] : ''));
        return $nama;
    }
}
