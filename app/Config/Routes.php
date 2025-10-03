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
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // Rute untuk halaman dashboard admin
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // Rute 'resource' untuk Anggota.
    $routes->resource('anggota', ['controller' => 'Admin\AnggotaController']);

    // Rute 'resource' untuk Komponen Gaji
    $routes->resource('komponen-gaji', ['controller' => 'Admin\KomponenGajiController']);

    // BARIS YANG HILANG: Rute 'resource' untuk Penggajian
    $routes->resource('penggajian', ['controller' => 'Admin\PenggajianController']);
});