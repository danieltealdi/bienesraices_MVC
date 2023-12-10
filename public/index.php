<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

use Controllers\PropiedadController;
use Controllers\VendedorController;

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
$router->get('/vendedores/admin', [PropiedadController::class, 'index']);
$router->post('/vendedores/admin', [PropiedadController::class, 'index']);
$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->get('/vendedores/eliminar', [VendedorController::class, 'eliminar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

$router->comprobarRutas();
