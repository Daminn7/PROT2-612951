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

//cuentas
$routes->post('registrarse', 'UsuarioController::crearCuenta');
$routes->post('guardar_datos_registro', 'UsuarioController::guardarDatosRegistro');
$routes->get('obtener_datos_registro', 'UsuarioController::obtenerDatosRegistro');