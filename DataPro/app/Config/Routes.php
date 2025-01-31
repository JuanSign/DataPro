<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/data_processor', 'DataProcessor::index');
$routes->get('/blog', 'Blog::index');
$routes->get('/user_check', 'UserCheckController::index');

$routes->get('/authentication', 'AuthController::index'); // Menampilkan halaman login
$routes->get('/logout', 'AuthController::logout'); // Logout dan redirect ke halaman login
$routes->post('/login_action', 'AuthController::login_action'); // Proses login dengan POST request
$routes->post('/register_action', 'AuthController::register_action'); // Proses login dengan POST request

$routes->post('/upload-file', 'FileController::Upload');
