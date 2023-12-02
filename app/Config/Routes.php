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