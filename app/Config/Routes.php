<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/', 'AuthController::login'); // Arahkan halaman utama ke login
$routes->get('/login', 'AuthController::login');
$routes->post('/login/process', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');