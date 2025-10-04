<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */

class KomponenGajiController extends ResourceController
{
    protected $modelName = 'App\Models\KomponenGajiModel';
    protected $format    = 'html';

    public function index()
    {
        $data = ['komponen_gaji' => $this->model->findAll()];
        return view('admin/komponen_gaji/index', $data);
    }

    public function new()
    {
        return view('admin/komponen_gaji/new');
    }

    public function create()
    {
        $data = [
            'nama_komponen' => $this->request->getVar('nama_komponen'),
            'kategori'      => $this->request->getVar('kategori'),
            'jabatan'       => $this->request->getVar('jabatan'),
            'nominal'       => $this->request->getVar('nominal'),
            'satuan'        => $this->request->getVar('satuan'),
        ];

        $this->model->insert($data);
        session()->setFlashdata('success', 'Data komponen gaji berhasil ditambahkan.');
        return redirect()->to('/admin/komponen-gaji');
    }

    public function edit($id = null)
    {
        $komponen = $this->model->find($id);
        if (!$komponen) {
            session()->setFlashdata('error', 'Data komponen gaji tidak ditemukan.');
            return redirect()->to('/admin/komponen-gaji');
        }
        $data = ['komponen' => $komponen];
        return view('admin/komponen_gaji/edit', $data);
    }

    public function update($id = null)
    {
        $data = [
            'nama_komponen' => $this->request->getVar('nama_komponen'),
            'kategori'      => $this->request->getVar('kategori'),
            'jabatan'       => $this->request->getVar('jabatan'),
            'nominal'       => $this->request->getVar('nominal'),
            'satuan'        => $this->request->getVar('satuan'),
        ];

        $this->model->update($id, $data);
        session()->setFlashdata('success', 'Data komponen gaji berhasil diperbarui.');
        return redirect()->to('/admin/komponen-gaji');
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        session()->setFlashdata('success', 'Data komponen gaji berhasil dihapus.');
        return redirect()->to('/admin/komponen-gaji');
    }
}