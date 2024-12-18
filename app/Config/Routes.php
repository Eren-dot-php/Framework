<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/', function () {
    return view('dashboard');
});

$routes->group('user',  function ($routes) {
    $routes->get('home', 'UserController::index', ['as' => 'user.home']);
    $routes->get('profile', 'UserController::profile', ['as' => 'user.profile']);
});

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Rute Dashboard
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');

// Rute untuk Buku
$routes->get('/buku', 'Buku::index');               // Menampilkan daftar buku
$routes->get('/buku/create', 'Buku::create');       // Form tambah buku
$routes->post('/buku/store', 'Buku::store');        // Simpan data buku baru
$routes->get('/buku/edit/(:num)', 'Buku::edit/$1'); // Form edit buku berdasarkan ID
$routes->post('/buku/update/(:num)', 'Buku::update/$1'); // Update data buku
$routes->get('/buku/delete/(:num)', 'Buku::delete/$1'); // Hapus buku

// Rute untuk Anggota
$routes->get('/anggota', 'Anggota::index');                 // Menampilkan daftar anggota
$routes->get('/anggota/create', 'Anggota::create');         // Form tambah anggota
$routes->post('/anggota/store', 'Anggota::store');          // Simpan data anggota baru
$routes->get('/anggota/edit/(:num)', 'Anggota::edit/$1');   // Form edit anggota
$routes->post('/anggota/update/(:num)', 'Anggota::update/$1'); // Update data anggota
$routes->get('/anggota/delete/(:num)', 'Anggota::delete/$1'); // Hapus anggota

// Rute untuk Peminjaman
// Routes untuk Peminjaman
$routes->get('peminjaman', 'Peminjaman::index'); // Halaman index
$routes->get('peminjaman/create', 'Peminjaman::create'); // Halaman create form
$routes->post('/peminjaman/store', 'Peminjaman::store');



// Rute untuk Pengembalian
$routes->get('pengembalian', 'Pengembalian::index');
$routes->match(['get', 'post'], 'pengembalian/create', 'Pengembalian::create'); // Mendukung GET dan POST

// Rute untuk Autentikasi
$routes->get('/login', 'Auth::login');           // Form login
$routes->post('/login', 'Auth::doLogin');        // Proses login
$routes->get('/logout', 'Auth::logout');         // Logout

