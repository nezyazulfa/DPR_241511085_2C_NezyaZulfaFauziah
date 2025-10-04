<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===============================================
// RUTE UMUM: LOGIN & LOGOUT
// ===============================================

$routes->get('/', 'AuthController::loginForm');
$routes->get('login', 'AuthController::loginForm'); 
$routes->post('login', 'AuthController::doLogin'); 
$routes->get('logout', 'AuthController::logout');


// ===============================================
// RUTE LANDING PAGE PUBLIC
// ===============================================

$routes->get('anggota/dashboard', 'PublicController::anggotaDashboard');


// ===============================================
// RUTE PUBLIK (TERLINDUNGI)
// ===============================================

$routes->group('', ['filter' => 'auth:client'], function ($routes) {
    // Data Anggota (Read Only)
    $routes->get('anggota', 'PublicController::anggotaIndex');
    $routes->get('anggota/(:segment)', 'PublicController::anggotaDetail/$1');
    
    // Data Penggajian (Read Only)
    $routes->get('penggajian', 'PublicController::gajiIndex');
    $routes->get('penggajian/(:segment)', 'PublicController::gajiDetail/$1');
});


// ...
// ===============================================
// RUTE UNTUK ADMIN (TERLINDUNGI)
// ===============================================
// Filter 'auth:admin'
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    // Rute utama Admin
    $routes->get('dashboard', 'Admin\DashboardController::index');
    
    // Rute pengelolaan data (CRUD) - ANGGOTA
    $routes->get('anggota', 'Admin\AnggotaController::index');
    $routes->get('anggota/new', 'Admin\AnggotaController::new');
    $routes->post('anggota/create', 'Admin\AnggotaController::create');
    $routes->get('anggota/(:segment)/edit', 'Admin\AnggotaController::edit/$1');
    
    // FIX KRITIS: Ganti POST menjadi PUT agar sesuai dengan method spoofing di form EDIT
    $routes->put('anggota/update/(:segment)', 'Admin\AnggotaController::update/$1');
    
    // Rute DELETE (Metode POST ini sudah benar untuk spoofing DELETE)
    $routes->post('anggota/delete/(:segment)', 'Admin\AnggotaController::delete/$1');
    
    $routes->get('anggota/(:segment)', 'Admin\AnggotaController::show/$1');

    $routes->resource('komponen-gaji', ['controller' => 'Admin\KomponenGajiController']); 
    
    $routes->post('penggajian/get-komponen', 'Admin\PenggajianController::getKomponenByJabatan'); 

    $routes->resource('penggajian', ['controller' => 'Admin\PenggajianController']);
});