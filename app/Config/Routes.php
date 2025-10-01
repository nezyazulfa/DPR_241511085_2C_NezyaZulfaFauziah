<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Arahkan halaman utama ('/') langsung ke halaman login.
$routes->get('/', 'AuthController::login');

// Rute untuk proses Autentikasi (Login & Logout)
$routes->get('login', 'AuthController::login');
$routes->post('login/process', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');

// --- RUTE UNTUK ADMIN ---
// Semua rute di dalam grup ini akan memiliki awalan URL 'admin'
// dan dilindungi oleh filter 'auth' yang sudah kita buat.
// Contoh: /admin/dashboard, /admin/anggota
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // Rute untuk halaman dashboard admin
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // Rute 'resource' untuk Anggota.
    // Ini secara otomatis membuat semua rute yang dibutuhkan untuk CRUD:
    // GET /admin/anggota         -> index()
    // GET /admin/anggota/new     -> new()
    // POST /admin/anggota        -> create()
    // GET /admin/anggota/(:num)  -> show($id)
    // GET /admin/anggota/(:num)/edit -> edit($id)
    // PUT/PATCH /admin/anggota/(:num) -> update($id)
    // DELETE /admin/anggota/(:num)  -> delete($id)
    $routes->resource('anggota', ['controller' => 'Admin\AnggotaController']);
});

// Anda bisa menambahkan rute untuk publik/client di bawah sini nantinya
// --- RUTE UNTUK CLIENT ---
// $routes->group('client', ...);