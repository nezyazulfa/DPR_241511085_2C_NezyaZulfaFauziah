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
    public function edit($id = null)
    {
        // Cari data anggota berdasarkan ID
        $anggota = $this->model->find($id);

        if ($anggota) {
            $data = [
                'anggota' => $anggota
            ];
            // Ubah format ke html agar bisa di-render
            $this->format = 'html';
            return view('admin/anggota/edit', $data);
        } else {
            session()->setFlashdata('error', 'Data anggota tidak ditemukan.');
            return redirect()->to('/admin/anggota');
        }
    }

    public function update($id = null)
    {
        $data = [
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'nama_depan' => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'jabatan' => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_anak' => $this->request->getPost('jumlah_anak'),
        ];

        // Menggunakan model untuk mengupdate data
        if ($this->model->update($id, $data)) {
            session()->setFlashdata('success', 'Data anggota berhasil diperbarui.');
            return redirect()->to('/admin/anggota');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data anggota.');
            return redirect()->back();
        }
    }
    public function delete($id = null)
    {
        // Menggunakan model untuk menghapus data
        if ($this->model->delete($id)) {
            session()->setFlashdata('success', 'Data anggota berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data anggota.');
        }
        return redirect()->to('/admin/anggota');
    }
}