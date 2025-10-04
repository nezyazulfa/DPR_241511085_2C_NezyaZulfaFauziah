<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $isLoggedIn = $session->get('isLoggedIn');
        $userRole = $session->get('role') ?? ''; // Ambil role ASLI dari session (Admin/Client)

        // 1. Cek User Sudah Login
        if (!$isLoggedIn) {
            $session->setFlashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            return redirect()->to(base_url('login'));
        }

        // 2. Cek Hak Akses (Role)
        if ($arguments) {
            // Kita HARUS mengubah argumen rute menjadi format yang sama dengan database (misal: 'client')
            $requiredRole = ucfirst($arguments[0]); // Mengubah 'admin' menjadi 'Admin', 'public' menjadi 'Public'

            // HACK KRITIS: Ubah requiredRole 'Public' menjadi 'Client'
            if ($requiredRole === 'Public') {
                $requiredRole = 'Client';
            }

            if ($userRole !== $requiredRole) {
                
                $session->setFlashdata('error', 'Akses Ditolak. Anda tidak memiliki izin untuk halaman tersebut!');
                
                // PENGALIHAN AMAN: Menggunakan nilai role yang BENAR dari database
                if ($userRole === 'Admin') {
                    return redirect()->to(base_url('admin/dashboard'));
                } else {
                    // Jika role adalah 'Client'
                    return redirect()->to(base_url('anggota/dashboard')); 
                }
            }
        }
        
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}