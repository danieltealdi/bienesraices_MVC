<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {

        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {

        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {

        $urlActual = $_SERVER['REQUEST_URI'] ?? "/public/";
        $urlActual=parse_url($urlActual)['path'];
        //debugear($urlActual);

        $metodo = $_SERVER['REQUEST_METHOD'];
        //debugear($metodo);

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
            //debugear($fn);
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
            //debugear($fn);
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Página no encontrada";
        }
        //debugear($fn);


    }
    public function render($view, $datos = [])
    {
        //debugear($datos);
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}
