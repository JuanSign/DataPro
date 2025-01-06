<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about','About::index');
$routes->get('/blog','Blog::index');
$routes->get('/user_check', 'UserCheckController::index');

$routes->get('/authentication', 'LoginController::index'); // Menampilkan halaman login
$routes->get('/logout', 'LoginController::logout'); // Logout dan redirect ke halaman login
$routes->post('/login_action', 'LoginController::login_action'); // Proses login dengan POST request


$routes->get('/customer','CustomerController::index');
$routes->get('/customerAPI','CustomerController::indexAPI');
$routes->get('/customer/(:any)','CustomerController::viewAPI/$1');
// $routes->get('/customerAPI/(:any)', 'CustomerController::API/$1/$2');
$routes->get('/customerAPI/(:any)/(:any)','customerAPI::index/$1/$2');

$routes->get('/coba', 'CobaController::index'); // Halaman utama tabel coba
$routes->get('/cobaAPI', 'CobaController::indexAPI'); // API untuk semua data
$routes->get('/coba/edit/(:num)', 'CobaController::edit/$1'); // Form edit data
$routes->post('/coba/update/(:num)', 'CobaController::update/$1'); // Proses update
$routes->get('/coba/delete/(:num)', 'CobaController::delete/$1'); // Hapus data

// Route untuk form tambah data
$routes->post('/coba/add', 'CobaController::insert'); // Proses tambah data
$routes->get('/coba/add', 'CobaController::add'); // Form tambah data


// Route lebih umum harus diletakkan di bawah
$routes->get('/coba/(:any)', 'CobaController::insert/$1'); // Menambahkan data langsung dari URL
$routes->get('/cobacustom/(:any)', 'CobaController::viewAPI/$1'); // Menampilkan data berdasarkan parameter
$routes->get('/cobacustomAPI/(:any)', 'CobaController::API/$1'); // API untuk data berdasarkan parameter



