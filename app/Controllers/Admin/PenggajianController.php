<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PenggajianModel;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianDetailModel;

/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */
class PenggajianController extends ResourceController
{
    protected $modelName = 'App\Models\PenggajianModel';

    protected $anggotaModel;
    protected $komponenGajiModel;
    protected $penggajianDetailModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->komponenGajiModel = new KomponenGajiModel();
        $this->penggajianDetailModel = new PenggajianDetailModel();
    }

    public function index()
    {
        $data = ['penggajian' => $this->model->getAllPenggajianWithAnggota()];
        return view('admin/penggajian/index', $data);
    }

    public function new()
    {
        $data = ['anggota' => $this->anggotaModel->findAll()];
        return view('admin/penggajian/new', $data);
    }
    
    public function getKomponenByJabatan()
    {
        $jabatan = $this->request->getVar('jabatan'); // Ambil jabatan dari data POST
        $komponen = $this->komponenGajiModel
            ->where('jabatan', $jabatan)
            ->orWhere('jabatan', 'Semua')
            ->findAll();
        return $this->response->setJSON($komponen);
    }

    public function create()
    {
        $id_anggota = $this->request->getVar('id_anggota');
        $tanggal_penggajian = $this->request->getVar('tanggal_penggajian');
        $id_komponen_array = $this->request->getVar('id_komponen');

        if (empty($id_komponen_array)) {
            session()->setFlashdata('error', 'Gagal, Anda harus memilih minimal satu komponen gaji.');
            return redirect()->back();
        }

        $anggota = $this->anggotaModel->find($id_anggota);
        $total_gaji = 0;
        $komponen_terpilih = $this->komponenGajiModel->whereIn('id_komponen', $id_komponen_array)->findAll();
        
        foreach ($komponen_terpilih as $komponen) {
            if (strpos($komponen['nama_komponen'], 'Tunjangan Istri') !== false) {
                if ($anggota['status_pernikahan'] == 'Kawin') {
                    $total_gaji += $komponen['nominal'];
                }
            } elseif (strpos($komponen['nama_komponen'], 'Tunjangan Anak') !== false) {
                if ($anggota['jumlah_anak'] > 0) {
                    $jumlah_anak_dihitung = min((int)$anggota['jumlah_anak'], 2);
                    $total_gaji += $komponen['nominal'] * $jumlah_anak_dihitung;
                }
            } else {
                $total_gaji += $komponen['nominal'];
            }
        }
        
        $data_penggajian = [
            'id_anggota' => $id_anggota,
            'tanggal_penggajian' => $tanggal_penggajian,
            'take_home_pay' => $total_gaji
        ];
        
        $this->model->insert($data_penggajian);
        $id_penggajian_baru = $this->model->getInsertID();

        foreach ($id_komponen_array as $id_komp) {
            $this->penggajianDetailModel->insert([
                'id_penggajian' => $id_penggajian_baru,
                'id_komponen' => $id_komp
            ]);
        }

        session()->setFlashdata('success', 'Data penggajian berhasil ditambahkan.');
        return redirect()->to('/admin/penggajian');
    }
}