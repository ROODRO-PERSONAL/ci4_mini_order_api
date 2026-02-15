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
$routes->group('api', function ($routes) {
    $routes->get('test', 'Api\TestController::index');
});
