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
$routes->post('crearCuenta', 'UsuarioController::crearCuenta');
$routes->post('guardar_datos_registro', 'UsuarioController::guardarDatosRegistro');
$routes->get('obtener_datos_registro', 'UsuarioController::obtenerDatosRegistro');
$routes->get('activar_cuenta/(:any)', 'UsuarioController::activar_cuenta/$1');
$routes->post('auth', 'UsuarioController::auth');
$routes->get('cerrarSesion','UsuarioController::cerrarSesion');
$routes->get('password_request', 'UsuarioController::formularioRecuperacion');
$routes->post('password_email', 'UsuarioController::sendResetLinkEmail');
$routes->get('password_reset/(:any)', 'UsuarioController::resetForm/$1');
$routes->post('password_reset', 'UsuarioController::resetPassword');
$routes->get('PROT3-612951/inicioSesion', 'UsuarioController::inicioSesion');

// Rutas gestión de perfil
$routes->get('modificar-usuario', 'UsuarioController::mostrarModificarUsuario');
$routes->post('actualizar-usuario', 'UsuarioController::actualizarUsuario');
$routes->get('eliminar-cuenta', 'UsuarioController::mostrarEliminarCuenta');
$routes->post('confirmar-eliminar-cuenta', 'UsuarioController::eliminarCuenta');