<?php
require_once __DIR__ . '/../includes/app.php';
use MVC\Router;
use Controllers\PropiedadControler;
$router=new Router();

$router->get('/admin', [PropiedadControler::class, 'index']);
$router->get('/propiedades/crear', [PropiedadControler::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadControler::class, 'actualizar']);
$router->comprobarRutas();
