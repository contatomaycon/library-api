<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('login', 'AuthController::login', ['as' => 'login']);

$routes->group('book', ['filter' => 'jwt'], function($routes) {
    $routes->get('list', 'BookController::listAllBooks');
    $routes->put('list', 'BookController::updateBooks');
    $routes->get('list/(:num)', 'BookController::listBooks/$1');
    $routes->post('add', 'BookController::addBook');
    $routes->delete('delete/(:num)', 'BookController::deleteBook/$1');
});

$routes->group('weather', ['filter' => 'jwt'], function($routes) {
    $routes->post('city', 'WeatherController::getCurrentWeather');
});

$routes->group('location', ['filter' => 'jwt'], function($routes) {
    $routes->get('state', 'LocationController::listStates');
    $routes->get('state/(:num)', 'LocationController::listCities/$1');
});