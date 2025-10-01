<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AnggotaModel;

class AnggotaController extends ResourceController
{
    protected $modelName = 'App\Models\AnggotaModel';
    protected $format    = 'json';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'anggota' => $this->model->findAll()
        ];
        // Ubah format ke html agar bisa di-render
        $this->format = 'html';
        return view('admin/anggota/index', $data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        // Ubah format ke html agar bisa di-render
        $this->format = 'html';
        return view('admin/anggota/new');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'id_anggota' => $this->request->getPost('id_anggota'),
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'nama_depan' => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'jabatan' => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_anak' => $this->request->getPost('jumlah_anak'),
        ];

        // Menggunakan model untuk menyimpan data
        if ($this->model->insert($data)) {
            // Jika berhasil, set pesan sukses dan redirect
            session()->setFlashdata('success', 'Data anggota berhasil ditambahkan.');
            return redirect()->to('/admin/anggota');
        } else {
            // Jika gagal, set pesan error dan redirect kembali
            session()->setFlashdata('error', 'Gagal menambahkan data anggota.');
            return redirect()->back();
        }
    }
}