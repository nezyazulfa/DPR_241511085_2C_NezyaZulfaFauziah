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
        // Jika user belum login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Jika role bukan 'Admin'
        if ($session->get('role') != 'Admin') {
            // Bisa diarahkan ke halaman 'access denied' atau kembali ke login
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini!');
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}