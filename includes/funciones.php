<?php

define('FUNCIONES_URL', __DIR__ . "/funciones/funciones.php");
define('TEMPLATES_URL', __DIR__ . "/templates");
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . "/public/imagenes");


function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado()
{
    session_start();

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    if (!$_SESSION['login']) {
        header('location:/');
    }
}

function debugear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($str)
{
    return htmlspecialchars($str);
}

function validarTipos($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;

        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;

        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;

        case 4:
            $mensaje = 'Formato erroneo';
            break;
        default:
            $mensaje = NULL;
            break;
    }

    return $mensaje;
}
function validarORedireccionar(string $url)
{
    // Verificar el id
    $id =  $_GET['id'];
    //var_dump($id);
    $id = filter_var($id, FILTER_VALIDATE_INT);
    //var_dump($id); die;
    if (!$id) {
        header("Location: {$url}");
    }

    return $id;
}
