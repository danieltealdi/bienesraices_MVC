<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

use Controllers\PropiedadController;

$router = new Router();
//debugear($router);
//admin al ser un directorio hay que agregarle / al final si no no lo reconoce

$router->get('/admin/', [PropiedadController::class, 'index']);
$router->post('/admin/', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->get('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->comprobarRutas();
