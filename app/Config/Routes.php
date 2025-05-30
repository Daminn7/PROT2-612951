<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('proyecto','Home::proyecto');
$routes->get('quienesSomos','Home::quienesSomos');
$routes->get('acercade','Home::acercade');
$routes->get('registrarse','Home::registrarse');
$routes->get('login', 'Home::login');