<?php 
/**
 * @var  \CodeIgniter\Router\RouteCollection $routes
 */

// $routes->resource('api/users');
// $routes->get('api/users/(:segment)',      'Api\Users::show/$1');
$routes->resource('api/users', ['controller' => 'Api\Users']);