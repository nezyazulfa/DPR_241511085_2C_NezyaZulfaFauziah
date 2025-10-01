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
}