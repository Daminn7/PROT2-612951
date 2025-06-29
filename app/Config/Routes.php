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

// Rutas de autenticación (LoginController)
$routes->post('auth', 'LoginController::auth');
$routes->get('cerrarSesion','LoginController::cerrarSesion');
$routes->get('password_request', 'LoginController::formularioRecuperacion');
$routes->get('formularioRecuperacion', 'LoginController::formularioRecuperacion');
$routes->post('password_email', 'LoginController::sendResetLinkEmail');
$routes->get('password_reset/(:any)', 'LoginController::resetForm/$1');
$routes->post('password_reset', 'LoginController::resetPassword');
$routes->get('PROT3-612951/inicioSesion', 'LoginController::inicioSesion');

// Ruta para administrador
$routes->get('admin', 'LoginController::inicioSesion');

// Rutas gestión de perfil
$routes->get('modificar-usuario', 'UsuarioController::mostrarModificarUsuario');
$routes->post('actualizar-usuario', 'UsuarioController::actualizarUsuario');
$routes->get('eliminar-cuenta', 'UsuarioController::mostrarEliminarCuenta');
$routes->post('confirmar-eliminar-cuenta', 'UsuarioController::eliminarCuenta');