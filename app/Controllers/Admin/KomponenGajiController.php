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
}