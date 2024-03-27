<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('dashboard', ['filter' => 'role:admin,panitia'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->post('start', 'Dashboard::start');

    $routes->group('peserta', ['filter' => 'role:admin,panitia'], function ($routes) {
        $routes->get('/', 'Peserta::index', ['filter' => 'role:admin']);
        $routes->post('pagination', 'Peserta::pagination', ['filter' => 'role:admin']);
        $routes->post('addKelompok', 'Peserta::addKelompok', ['filter' => 'role:admin']);
        $routes->post('removePeserta', 'Peserta::removePeserta', ['filter' => 'role:admin']);
        $routes->post('removeKelompok', 'Peserta::removeKelompok', ['filter' => 'role:admin']);
    });

    $routes->resource('soal', ['controller' => 'Soal']);
    $routes->resource('topik', ['controller' => 'Topik']);
    $routes->resource('ujian', ['controller' => 'Ujian']);
    $routes->resource('nilai', ['controller' => 'Nilai']);
});

$routes->group('/examp', ['filter' => 'role:examp'], function ($routes) {
    $routes->get('/', 'Examps::index');
    $routes->get('ujian/(:any)', 'Examps::ujian/$1');
    $routes->post('selesai', 'Examps::selesai');
});