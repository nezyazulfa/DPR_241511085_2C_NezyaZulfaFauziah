<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel; // Model Anggota DPR
use App\Models\PenggajianModel; // Model Penggajian (Asumsi Anda punya)

class PublicController extends BaseController
{
    /**
     * Rute: GET /anggota/dashboard
     * Fungsi: Halaman pendaratan Public SETELAH login berhasil.
     * Rute ini HARUS BEBAS FILTER di Routes.php untuk memutus loop redirect.
     */
    public function anggotaDashboard()
    {
        // Tampilkan view dashboard Public yang berisi navigasi
        $data = [
            'title' => 'Dashboard Publik & Transparansi Gaji DPR'
        ];
        return view('public/dashboard', $data); 
    }

    /**
     * Rute: GET /anggota
     * Fungsi: Menampilkan daftar data anggota DPR (Read Only).
     * Rute ini dilindungi oleh filter auth:public.
     */
    public function anggotaIndex()
    {
        $anggotaModel = new AnggotaModel();
        
        // Logika untuk fetch data anggota DPR
        $data = [
            'anggota' => $anggotaModel->findAll(), // Sesuaikan jika perlu JOIN
            'title'   => 'Data Anggota DPR'
        ];
        
        // Pastikan Anda membuat view di: app/Views/public/anggota/index.php
        return view('public/anggota/index', $data);
    }
    
    /**
     * Rute: GET /anggota/(:segment)
     * Fungsi: Menampilkan detail data anggota.
     * Rute ini dilindungi oleh filter auth:public.
     */
    public function anggotaDetail($id = null)
    {
        $anggotaModel = new AnggotaModel();
        
        $data = [
            'anggota' => $anggotaModel->find($id),
            'title'   => 'Detail Anggota DPR'
        ];
        
        // Pastikan Anda membuat view di: app/Views/public/anggota/detail.php
        return view('public/anggota/detail', $data);
    }

    /**
     * Rute: GET /penggajian
     * Fungsi: Menampilkan daftar data penggajian (Take Home Pay) (Read Only).
     * Rute ini dilindungi oleh filter auth:public.
     */
    public function gajiIndex()
    {
        $penggajianModel = new PenggajianModel(); // Ganti dengan Model Penggajian yang sesuai
        
        // Logika untuk fetch data penggajian (Challenge: Join Tables & Grouping)
        // Disini Anda akan melakukan JOIN antara tabel users, anggota, dan detail_gaji
        // ... (Implementasi query kompleks) ...

        $data = [
            'penggajian' => $penggajianModel->getGroupedTakeHomePay(), // Contoh method kustom
            'title'      => 'Data Transparansi Gaji DPR'
        ];
        
        // Pastikan Anda membuat view di: app/Views/public/gaji/index.php
        return view('public/gaji/index', $data);
    }

    /**
     * Rute: GET /penggajian/(:segment)
     * Fungsi: Menampilkan detail data penggajian.
     * Rute ini dilindungi oleh filter auth:public.
     */
    public function gajiDetail($id = null)
    {
        // Logika untuk menampilkan detail penggajian, termasuk komponen gaji
        // ...
        
        $data = [
            // ... data detail ...
            'title' => 'Detail Gaji Anggota'
        ];
        
        // Pastikan Anda membuat view di: app/Views/public/gaji/detail.php
        return view('public/gaji/detail', $data);
    }
}
