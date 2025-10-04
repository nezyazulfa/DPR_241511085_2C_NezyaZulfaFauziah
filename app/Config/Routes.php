<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::login');
$routes->get('login', 'AuthController::login');
$routes->post('login/process', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->resource('anggota', ['controller' => 'Admin\AnggotaController']);
    $routes->resource('komponen-gaji', ['controller' => 'Admin\KomponenGajiController']);
    
    // Dua baris ini penting untuk Penggajian
    $routes->resource('penggajian', ['controller' => 'Admin\PenggajianController']);
    $routes->post('penggajian/get-komponen-by-jabatan', 'Admin\PenggajianController::getKomponenByJabatan');
});