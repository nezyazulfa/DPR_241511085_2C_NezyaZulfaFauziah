<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianDetailModel extends Model
{
    protected $table            = 'penggajian_detail';
    protected $primaryKey       = 'id_detail';
    protected $allowedFields    = ['id_penggajian', 'id_komponen'];

    // TAMBAHKAN FUNGSI INI
    public function getDetailByIdPenggajian($id_penggajian)
    {
        return $this->select('komponen_gaji.*')
                    ->join('komponen_gaji', 'komponen_gaji.id_komponen = penggajian_detail.id_komponen')
                    ->where('penggajian_detail.id_penggajian', $id_penggajian)
                    ->findAll();
    }
}
