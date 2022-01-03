<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::login');
// $routes->post('/login', 'Login::process');
// $routes->get('/logout', 'Login::logout');
$routes->group('', ['filter' => 'authFilter'], function($routes) {
    $routes->get('/admin/home', 'Home::index');
    $routes->get('/ticket','Tiket::index');
    $routes->get('/ticket/show','Tiket::show/$1');
    $routes->get('/ticket/edit','Tiket::edit/$1');
    $routes->get('/user/home', 'Home::index_user');
    $routes->get('/contact','Contact::index');

    $routes->get('/status','Status::index');
    $routes->get('/status/edit', 'Status::edit');
    $routes->get('/status/delete', 'Status::delete');
    $routes->get('/status/add', 'Status::add');

    $routes->get('/category','Category::index');
    $routes->get('/category/edit', 'Category::edit');
    $routes->get('/category/delete', 'Category::delete');
    $routes->get('/category/add', 'Category::add');

    $routes->get('/priority','Priority::index');
    $routes->get('/priority/edit', 'Priority::edit');
    $routes->get('/priority/delete', 'Priority::delete');
    $routes->get('/priority/add', 'Priority::add');
});


$routes->get('/pesan/','SendMail::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
