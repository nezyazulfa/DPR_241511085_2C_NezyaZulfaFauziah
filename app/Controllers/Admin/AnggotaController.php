<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */

class AnggotaController extends ResourceController
{
    protected $modelName = 'App\Models\AnggotaModel';
    protected $format    = 'html';

    public function index()
    {
        $data = ['anggota' => $this->model->findAll()];
        return view('admin/anggota/index', $data);
    }

    public function show($id = null)
    {
        $anggota = $this->model->find($id);
        if (!$anggota) {
            session()->setFlashdata('error', 'Data anggota tidak ditemukan.');
            return redirect()->to('/admin/anggota');
        }
        $data = ['anggota' => $anggota];
        return view('admin/anggota/show', $data);
    }
    
    public function new()
    {
        return view('admin/anggota/new');
    }

    public function create()
    {
        $data = [
            'id_anggota'        => $this->request->getVar('id_anggota'),
            'gelar_depan'       => $this->request->getVar('gelar_depan'),
            'nama_depan'        => $this->request->getVar('nama_depan'),
            'nama_belakang'     => $this->request->getVar('nama_belakang'),
            'gelar_belakang'    => $this->request->getVar('gelar_belakang'),
            'jabatan'           => $this->request->getVar('jabatan'),
            'status_pernikahan' => $this->request->getVar('status_pernikahan'),
            'jumlah_anak'       => $this->request->getVar('jumlah_anak'),
        ];

        $this->model->insert($data);
        session()->setFlashdata('success', 'Data anggota berhasil ditambahkan.');
        return redirect()->to('/admin/anggota');
    }

    public function edit($id = null)
    {
        $anggota = $this->model->find($id);
        if (!$anggota) {
            session()->setFlashdata('error', 'Data anggota tidak ditemukan.');
            return redirect()->to('/admin/anggota');
        }
        $data = ['anggota' => $anggota];
        return view('admin/anggota/edit', $data);
    }

    public function update($id = null)
    {
        $data = [
            'gelar_depan'       => $this->request->getVar('gelar_depan'),
            'nama_depan'        => $this->request->getVar('nama_depan'),
            'nama_belakang'     => $this->request->getVar('nama_belakang'),
            'gelar_belakang'    => $this->request->getVar('gelar_belakang'),
            'jabatan'           => $this->request->getVar('jabatan'),
            'status_pernikahan' => $this->request->getVar('status_pernikahan'),
            'jumlah_anak'       => $this->request->getVar('jumlah_anak'),
        ];

        $this->model->update($id, $data);
        session()->setFlashdata('success', 'Data anggota berhasil diperbarui.');
        return redirect()->to('/admin/anggota');
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        session()->setFlashdata('success', 'Data anggota berhasil dihapus.');
        return redirect()->to('/admin/anggota');
    }
}