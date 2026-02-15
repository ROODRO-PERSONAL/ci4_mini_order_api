<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); // enable auto routing for learning phase

// Default web route
$routes->get('/', 'Home::index');

// API Route Group
// $routes->group('api', function ($routes) {
//     $routes->get('test', 'Api\TestController::index');
// });

$routes->group('api', function ($routes) {
    $routes->get('products', 'Api\ProductController::getAllProd');
    $routes->get('products/in-stock', 'Api\ProductController::getAllActiveProd');
    $routes->get('products/(:num)', 'Api\ProductController::fetchById/$1');
    $routes->post('products', 'Api\ProductController::insert');
    $routes->post('products/(:num)', 'Api\ProductController::updateProductAllData/$1');
    $routes->delete('products/(:num)', 'Api\ProductController::deleteProd/$1');
    // get cal from service
    $routes->get('products/(:num)/total-value', 'Api\ProductController::calCulateTotalProdValue/$1');
    $routes->get('products/total-inv-val', 'Api\ProductController::calCulateTotalInv');
    $routes->get('products/total-active-inv-val', 'Api\ProductController::calculateTotalActiveInv');

    // check patch how it works
    $routes->patch('products/(:num)', 'Api\ProductController::setDelete/$1');

});