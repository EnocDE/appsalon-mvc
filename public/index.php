<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();

// Iniciar sesión
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar password
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);
$router->get('/recover', [LoginController::class, 'recover']);
$router->post('/recover', [LoginController::class, 'recover']);

// Crear cuenta
$router->get('/new-account', [LoginController::class, 'newAccount']);
$router->post('/new-account', [LoginController::class, 'newAccount']);

// Confirmar cuenta
$router->get('/account-confirmation', [LoginController::class, 'confirmation']);

$router->get('/message', [LoginController::class, 'message']);

// Area privada
$router->get('/appointment', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

// API de citas
$router->get('/api/services', [APIController::class, 'index']);
$router->post('/api/appointments', [APIController::class, 'save']);
$router->post('/api/delete', [APIController::class, 'delete']);

// CRUD de servicios
$router->get('/services', [ServicioController::class, 'index']);
$router->get('/services/create', [ServicioController::class, 'create']);
$router->post('/services/create', [ServicioController::class, 'create']);
$router->get('/services/update', [ServicioController::class, 'update']);
$router->post('/services/update', [ServicioController::class, 'update']);
$router->post('/services/delete', [ServicioController::class, 'delete']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();