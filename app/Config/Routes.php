<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

$routes->get("/", "HomeController::index");
$routes->get("/about", "HomeController::about");
$routes->get("/contact", "HomeController::contact");
$routes->get("/siswa", "StudentController::index");
$routes->get("/siswa/(:any)", "StudentController::show/$1");
$routes->post("/siswa/buat", "StudentController::store");
$routes->patch("/siswa/(:any)", "StudentController::update/$1");
$routes->delete("/siswa/(:num)", "StudentController::delete/$1");
$routes->post("/siswa/search", "StudentController::search");

// Tutorial CI4
// $routes->get('/', 'Home::index'); # penulisan normal route

# Untuk menerma data dari route, maka penulisan route :
$routes->get("/about/(:alpha)/(:alpha)", "CobaController::about/$1/$2");

# menggunakan clouser untuk isi route, Jadi jika user mengunjungi route dibawah, maka closure function akan dijalankan..
$routes->get("/closure", function () {
    echo "ini adalah fungsi clousure";
});

# Memanggil controller yang ada didalam folder..
$routes->get("/folder", "Folder\DidalamFolderController::index");
# kita harus menambahkan nama folder dan diikuti oleh nama controler dengan dipisahkan dengan \ seperti kita membuat namespace.
# kenapa ditulis seperti ini? karena controller yang dimiliki oleh ci4 memiliki default namespace App\Controllers, sehingga jika file controller kita tidak meletakanya difolder controllers maka ci4 tidak akan mengenalinya.

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