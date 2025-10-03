<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

class KomponenGajiController extends ResourceController
{
    protected $modelName = 'App\Models\KomponenGajiModel';
    protected $format    = 'html';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'komponen_gaji' => $this->model->findAll()
        ];
        return view('admin/komponen_gaji/index', $data);
    }

    /**
     * Return a new resource object, with default properties
     * (FUNGSI INI YANG SEBELUMNYA HILANG ATAU BELUM DITAMBAHKAN)
     * @return mixed
     */
    public function new()
    {
        return view('admin/komponen_gaji/new');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori'      => $this->request->getPost('kategori'),
            'jabatan'       => $this->request->getPost('jabatan'),
            'nominal'       => $this->request->getPost('nominal'),
            'satuan'        => $this->request->getPost('satuan'),
        ];

        if ($this->model->insert($data)) {
            session()->setFlashdata('success', 'Data komponen gaji berhasil ditambahkan.');
            return redirect()->to('/admin/komponen-gaji');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan data komponen gaji.');
            return redirect()->back();
        }
    }

    public function edit($id = null)
    {
        $data = [
            'komponen' => $this->model->find($id)
        ];
        if (!$data['komponen']) {
            session()->setFlashdata('error', 'Data komponen gaji tidak ditemukan.');
            return redirect()->to('/admin/komponen-gaji');
        }
        return view('admin/komponen_gaji/edit', $data);
    }

    public function update($id = null)
    {
        $data = [
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori'      => $this->request->getPost('kategori'),
            'jabatan'       => $this->request->getPost('jabatan'),
            'nominal'       => $this->request->getPost('nominal'),
            'satuan'        => $this->request->getPost('satuan'),
        ];

        if ($this->model->update($id, $data)) {
            session()->setFlashdata('success', 'Data komponen gaji berhasil diperbarui.');
            return redirect()->to('/admin/komponen-gaji');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data komponen gaji.');
            return redirect()->back();
        }
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            session()->setFlashdata('success', 'Data komponen gaji berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data komponen gaji.');
        }
        return redirect()->to('/admin/komponen-gaji');
    }
}