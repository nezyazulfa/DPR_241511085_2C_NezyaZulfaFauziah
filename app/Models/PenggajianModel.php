<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    protected $table            = 'penggajian';
    protected $primaryKey       = 'id_penggajian';
    protected $allowedFields    = ['id_anggota', 'tanggal_penggajian', 'take_home_pay'];

    public function getAllPenggajianWithAnggota()
    {
        return $this->select('penggajian.*, anggota.nama_depan, anggota.nama_belakang, anggota.jabatan')
                    ->join('anggota', 'anggota.id_anggota = penggajian.id_anggota')
                    ->findAll();
    }
}