<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel; // Pastikan Model ini terbaca
use CodeIgniter\Session\Session;

class AuthController extends BaseController
{
    protected Session $session;
    protected $userModel; // Properti untuk model

    public function __construct()
    {
        $this->session = \Config\Services::session();
        // INISIALISASI MODEL SEKALI DI CONSTRUCTOR (Model Anda sudah benar)
        $this->userModel = new UserModel(); 
    }

    public function loginForm() // Method untuk menampilkan form
    {
        return view('login');
    }

    public function doLogin() // Method untuk proses login
    {
        // Gunakan properti yang sudah diinisialisasi
        $userModel = $this->userModel; 
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            
            // Ambil Role Asli: 'Admin' atau 'Client'
            $userRoleActual = $user['role']; 

            $sessionData = [
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $userRoleActual,
                'isLoggedIn'=> true,
            ];
            $this->session->set($sessionData);

            // Redirect berdasarkan Role yang sudah benar
            if ($userRoleActual === 'Admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                // Redirect ke Dashboard Publik yang BEBAS filter
                return redirect()->to('/anggota/dashboard'); 
            }
        } else {
            $this->session->setFlashdata('error', 'Username atau Password salah!');
            return redirect()->to('/login'); 
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
