<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PenggajianModel;
use App\Models\AnggotaModel; // <-- TAMBAHKAN
use App\Models\KomponenGajiModel; // <-- TAMBAHKAN

class PenggajianController extends ResourceController
{
    protected $modelName = 'App\Models\PenggajianModel';
    protected $format    = 'html';

    // Tambahkan properti untuk model lain
    protected $anggotaModel;
    protected $komponenGajiModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->komponenGajiModel = new KomponenGajiModel();
    }

     public function new()
    {
        $data = [
            'anggota' => $this->anggotaModel->findAll(),
        ];
        return view('admin/penggajian/new', $data);
    }

    public function getKomponenByJabatan($jabatan)
    {
        $komponen = $this->komponenGajiModel
            ->where('jabatan', $jabatan)
            ->orWhere('jabatan', 'Semua')
            ->findAll();
        return $this->response->setJSON($komponen);
    }

    public function create()
    {
        // 1. Ambil data dari form
        $id_anggota = $this->request->getPost('id_anggota');
        $tanggal_penggajian = $this->request->getPost('tanggal_penggajian');
        $id_komponen_array = $this->request->getPost('id_komponen');

        // 2. Ambil detail anggota untuk perhitungan
        $anggota = $this->anggotaModel->find($id_anggota);
        $total_gaji = 0;

        // 3. Hitung total gaji dari komponen yang dipilih
        if (!empty($id_komponen_array)) {
            $komponen_terpilih = $this->komponenGajiModel->whereIn('id_komponen', $id_komponen_array)->findAll();

            foreach ($komponen_terpilih as $komponen) {
                // Logika perhitungan tunjangan anak dan istri
                if ($komponen['nama_komponen'] == 'Tunjangan Istri/Suami') {
                    if ($anggota['status_pernikahan'] == 'Kawin') {
                        $total_gaji += $komponen['nominal'];
                    }
                } elseif ($komponen['nama_komponen'] == 'Tunjangan Anak') {
                    $jumlah_anak_dihitung = min($anggota['jumlah_anak'], 2); // Maksimal 2 anak
                    $total_gaji += $komponen['nominal'] * $jumlah_anak_dihitung;
                } else {
                    $total_gaji += $komponen['nominal'];
                }
            }
        }

        // 4. Simpan data ke tabel penggajian
        $data_penggajian = [
            'id_anggota' => $id_anggota,
            'tanggal_penggajian' => $tanggal_penggajian,
            'take_home_pay' => $total_gaji
        ];

        $this->model->insert($data_penggajian);
        $id_penggajian_baru = $this->model->getInsertID();

        // 5. Simpan detail ke tabel penggajian_detail
        if (!empty($id_komponen_array)) {
            $detailModel = new \App\Models\PenggajianDetailModel();
            foreach ($id_komponen_array as $id_komp) {
                $detailModel->insert([
                    'id_penggajian' => $id_penggajian_baru,
                    'id_komponen' => $id_komp
                ]);
            }
        }

        session()->setFlashdata('success', 'Data penggajian berhasil ditambahkan.');
        return redirect()->to('/admin/penggajian');
    }

    public function index()
    {
        $data = [
            'penggajian' => $this->model->getAllPenggajianWithAnggota()
        ];
        return view('admin/penggajian/index', $data);
    }
}