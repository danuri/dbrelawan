<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('auth', 'Auth::index');
 $routes->get('auth/login', 'Auth::login');
 $routes->post('auth/ajaxlogin', 'Auth::ajaxLogin');
 $routes->get('auth/logout', 'Auth::logout');

 $routes->get('/', 'Home::index',['filter' => 'auth']);
 $routes->get('home', 'Home::index',['filter' => 'auth']);

 $routes->group("ajax", ["filter" => "auth"], function ($routes) {
    $routes->get('searchnik/(:any)', 'Ajax::searchnik/$1');
    $routes->get('searchrelawan/(:any)', 'Ajax::searchrelawan/$1');
    $routes->get('getrelawan/(:any)', 'Ajax::detailRelawan/$1');
 });

 $routes->group("relawan", ["filter" => "auth"], function ($routes) {
    $routes->get('/', 'Relawan::index');
    $routes->post('getdata', 'Relawan::getdata');
    $routes->post('add', 'Relawan::add');
    $routes->post('edit', 'Relawan::update');
    $routes->get('delete/(:any)', 'Relawan::delete/$1');
    $routes->get('wilayah', 'Relawan::wilayah');
    $routes->get('kecamatan/(:any)', 'Relawan::kecamatan/$1');
    $routes->get('kelurahan/(:any)', 'Relawan::kelurahan/$1');
    $routes->get('rt/(:any)', 'Relawan::rt/$1');
 });
