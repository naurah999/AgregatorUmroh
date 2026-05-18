<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/tambah', 'Admin::tambah');
$routes->post('/admin/simpan', 'Admin::simpan');
$routes->get('/admin/hapus/(:num)', 'Admin::hapus/$1');
$routes->get('admin/paket_edit', 'Admin::paket_edit');          // Jalur cadangan aman jika ID kosong
$routes->get('admin/paket_edit/(:num)', 'Admin::paket_edit/$1'); // Jalur utama dengan ID Angka
$routes->post('/admin/update/(:num)', 'Admin::update/$1');
$routes->get('/paket/(:num)', 'Home::detail/$1');
$routes->get('/travel/(:num)', 'Home::travel/$1');
$routes->get('/paket/(:num)', 'Home::detail/$1');
$routes->get('/login', 'Auth::login');
$routes->post('/proses_login', 'Auth::proses_login');
$routes->get('/logout', 'Auth::logout');
$routes->post('/proses_daftar', 'Auth::proses_daftar');
$routes->get('/admin/travel', 'Admin::travel_index');
$routes->post('/admin/travel/simpan', 'Admin::travel_simpan');
$routes->post('/admin/travel/ubah/(:num)', 'Admin::travel_ubah/$1');
$routes->get('/admin/travel/hapus/(:num)', 'Admin::travel_hapus/$1');
$routes->get('/detail_paket/(:num)', 'Home::detail_paket/$1');