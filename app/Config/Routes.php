<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('auth', 'Admin\Auth::index');
$routes->get('auth/login', 'Admin\Auth::login');
$routes->get('auth/logout', 'Admin\Auth::logout');
$routes->get('auth/callback', 'Admin\Auth::callback');

$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->get('/', 'Home::index', ["filter" => "user"]);
$routes->get('mulai', 'Home::mulai', ["filter" => "user"]);
$routes->get('cat', 'Cat::index', ["filter" => "user"]);
$routes->post('cat/save', 'Cat::save', ["filter" => "user"]);
$routes->get('cat/selesai', 'Cat::selesai', ["filter" => "user"]);
$routes->get('catess', 'CatEssay::index', ["filter" => "user"]);
$routes->post('catess/save', 'CatEssay::save', ["filter" => "user"]);
$routes->get('catess/selesai', 'CatEssay::selesai', ["filter" => "user"]);

$routes->group("ajax", ["filter" => "auth"], function ($routes) {
    $routes->get('soal/(:num)', 'Ajax::soal/$1');
});

$routes->group("admin", ["filter" => "auth"], function ($routes) {
    $routes->get('', 'Admin\Home::index');

    $routes->get('ujian', 'Admin\Ujian::index');

    $routes->get('ujian/add', 'Admin\Ujian::add');
    $routes->post('ujian/add', 'Admin\Ujian::save');
    $routes->get('ujian/edit/(:any)', 'Admin\Ujian::edit/$1');
    $routes->post('ujian/edit/(:any)', 'Admin\Ujian\Home::edit/$1');

    $routes->get('ujian/detail/(:any)', 'Admin\Ujian\Home::detail/$1');

    $routes->get('ujian/lokasi/delete/(:any)', 'Admin\Ujian\Lokasi::delete/$1');
    $routes->get('ujian/lokasi/(:any)', 'Admin\Ujian\Lokasi::index/$1');
    $routes->post('ujian/lokasi/add/(:any)', 'Admin\Ujian\Lokasi::add/$1');

    $routes->get('ujian/sesi/(:any)', 'Admin\Ujian\Sesi::index/$1');
    $routes->post('ujian/sesi/add/(:any)', 'Admin\Ujian\Sesi::add/$1');
    $routes->get('ujian/sesi/delete/(:any)/(:any)', 'Admin\Ujian::delete/$1/$2');

    $routes->get('ujian/peserta/detail/(:any)', 'Admin\Ujian\Peserta::detail/$1');
    $routes->get('ujian/peserta/(:any)', 'Admin\Ujian\Peserta::index/$1');
    $routes->post('ujian/peserta/add/(:any)', 'Admin\Ujian\Peserta::add/$1');
    $routes->get('ujian/peserta/delete/(:any)/(:any)', 'Admin\Peserta::delete/$1/$2');

    $routes->get('ujian/soal/(:any)', 'Admin\Ujian\Soal::index/$1');
    $routes->get('ujian/soal/delete/(:any)', 'Admin\Ujian\Soal::delete/$1');
    $routes->post('ujian/soal/add/(:any)', 'Admin\Ujian\Soal::add/$1');
    
    $routes->get('ujian/hasil/(:any)', 'Admin\Ujian\Hasil::index/$1');

    $routes->get('banksoal/category', 'Admin\Banksoal::index');
    $routes->post('banksoal/category/add', 'Admin\Banksoal::categoryAdd');
    $routes->get('banksoal/category/edit/(:any)', 'Admin\Banksoal::categoryEdit/$1');
    $routes->delete('banksoal/category/delete/(:any)', 'Admin\Banksoal::categoryDelete/$1');
    $routes->get('banksoal/category/soal/(:any)', 'Admin\Banksoal::categorySoal/$1');


    $routes->get('banksoal/choice', 'Admin\Banksoal::choice');
    $routes->get('banksoal/addchoice', 'Admin\Banksoal::addchoice');
    $routes->get('banksoal/deletechoice/(:num)', 'Admin\Banksoal::deletechoice/$1');
    $routes->post('banksoal/addchoice', 'Admin\Banksoal::savechoice');
    $routes->post('banksoal/editchoice', 'Admin\Banksoal::savechoice');

    $routes->get('banksoal/essay', 'Admin\Banksoal::essay');
    $routes->get('banksoal/addessay', 'Admin\Banksoal::addessay');
    $routes->get('banksoal/deleteessay/(:num)', 'Admin\Banksoal::deleteessay/$1');
    $routes->post('banksoal/addessay', 'Admin\Banksoal::saveessay');

    $routes->get('wawancara', 'Admin\Wawancara::index');
    $routes->get('api/peserta/(:any)', 'Admin\Api::peserta/$1');
    $routes->get('wawancara/test/(:any)', 'Admin\Wawancara::test/$1');
    $routes->get('wawancara/getsoal/(:num)', 'Admin\Wawancara::getsoal/$1');
    $routes->post('wawancara/test/(:any)', 'Admin\Wawancara::savenilai/$1');

    $routes->get('users', 'Admin\Users::index');
    $routes->get('api/peserta/(:any)', 'Admin\Api::peserta/$1');
    $routes->get('wawancara/test/(:any)', 'Admin\Wawancara::test/$1');
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
