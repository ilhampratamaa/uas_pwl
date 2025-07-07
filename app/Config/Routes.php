<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');
$routes->post('/buyer/cart/clear', 'Buyer\CartController::clear');



// Rute untuk halaman utama pembeli (daftar produk)
// Ini akan menangani '/' dan '/buyer'
$routes->get('/', 'Buyer\ProductController::index');
$routes->get('/buyer', 'Buyer\ProductController::index'); // Tambahkan baris ini

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:admin'], function ($routes) {
    $routes->get('products', 'ProductController::index');
    $routes->get('products/create', 'ProductController::create');
    $routes->post('products/store', 'ProductController::store');
    $routes->get('products/edit/(:num)', 'ProductController::edit/$1');
    $routes->post('products/update/(:num)', 'ProductController::update/$1');
    $routes->get('products/delete/(:num)', 'ProductController::delete/$1');
});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:admin'], function ($routes) {
    $routes->get('users', 'UserController::index');
    $routes->get('users/create', 'UserController::create');
    $routes->post('users/store', 'UserController::store');
    $routes->get('users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('users/update/(:num)', 'UserController::update/$1');
    $routes->get('users/delete/(:num)', 'UserController::delete/$1');
});


$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:admin'], function ($routes) {
    $routes->get('transactions', 'TransactionController::index');
    $routes->get('transactions/confirm/(:num)', 'TransactionController::confirm/$1');
    $routes->post('transactions/update/(:num)', 'TransactionController::update/$1');
    $routes->get('transactions/detail/(:num)', 'TransactionController::detail/$1');
    $routes->get('transactions/cancel/(:num)', 'TransactionController::cancel/$1');
    $routes->get('transactions/delete/(:num)', 'TransactionController::delete/$1'); 

    $routes->get('', 'DashboardController::index');
    $routes->get('export-pdf', 'DashboardController::exportPdf');
});

$routes->get('product/(:num)', 'Buyer\ProductController::detail/$1');

$routes->group('buyer', ['namespace' => 'App\Controllers\Buyer', 'filter' => 'auth:buyer'], function($routes) {

    $routes->get('cart', 'CartController::index');
    $routes->post('cart/add/(:num)', 'CartController::add/$1');
    $routes->get('cart/remove/(:num)', 'CartController::remove/$1');
    $routes->get('cart/clear', 'CartController::clear');

    $routes->get('checkout', 'CheckoutController::index');
    $routes->post('checkout/process', 'CheckoutController::process');

    $routes->get('transactions', 'TransactionController::index');
    $routes->get('transactions/(:num)', 'TransactionController::detail/$1');
});
