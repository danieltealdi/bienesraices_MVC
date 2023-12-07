<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

use Controllers\PropiedadController;

$router = new Router();
//debugear($router);

$router->get('/admin/', [PropiedadController::class, 'index()']);
//$router->get('/admin/', "función admin");
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
//$router->get('/propiedades/crear', "función crear");
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
//$router->get('/propiedades/actualizar', "función actualizar");
//call_user_func([PropiedadControler::class, 'index'], $this);

$router->comprobarRutas();
