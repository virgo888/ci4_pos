<?php 
/**
 * @var  \CodeIgniter\Router\RouteCollection $routes
 */

$routes->resource('api/users');
$routes->get('api/users/(:segment)',      'Users::show/$1');

// $routes->presenter('api/users');