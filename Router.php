<?php

namespace MVC;
class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        
        $this->rutasGET[$url] = $fn;

    }

    public function comprobarRutas()
    {
        
        $urlActual = $_SERVER['REQUEST_URI'] ?? "/";
        //debugear($urlActual);
        
        $metodo = $_SERVER['REQUEST_METHOD'];
        //debugear($metodo);

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
            //debugear($fn);
        }
        
        if ($fn) {
            //PropiedadController::actualizar();
            //var_dump($fn[0]);
            //var_dump($fn[1]);
            //var_dump(is_callable("$fn[0]::$fn[1]", false, $func));
            //var_dump($func); die;
            call_user_func($fn, $this);
            //$fn[0]::$fn[1]($this);
        } else {
            echo "Página no encontrada";
        }
        //debugear($fn);
        

    }
    public function render($view, $datos=[]){
        //debugear($datos);
        foreach($datos as $key=>$value){
            $$key=$value;
        }
        //Código alternativo, por ahora funciona igual
        //Si luego falla utilizar el que está comentado
        //no funciona
        //$contenido = file_get_contents(__DIR__ . "/views/$view.php");
        //include __DIR__ . "/views/layout.php";
    
        
        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido=ob_get_clean();
        include __DIR__ . "/views/layout.php";
        
    
    }

}
