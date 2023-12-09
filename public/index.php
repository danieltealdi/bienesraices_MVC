<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

use Controllers\PropiedadController;

$router = new Router();
//debugear($router);

$router->get('/admin/', [PropiedadController::class, 'index']);
$router->post('/admin/', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

$router->comprobarRutas();
