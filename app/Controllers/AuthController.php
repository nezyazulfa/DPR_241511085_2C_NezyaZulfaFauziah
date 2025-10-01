<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function __construct()
    {
        // Load session service
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        return view('login');
    }

    public function processLogin()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Password cocok, set session
            $sessionData = [
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'isLoggedIn'=> true,
            ];
            $this->session->set($sessionData);

            // Redirect berdasarkan role
            if ($user['role'] == 'Admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/client/dashboard');
            }
        } else {
            // Login gagal
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