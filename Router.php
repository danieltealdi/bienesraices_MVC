<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {

        $this->rutasGET[$url] = $fn;
        //var_dump('get' . $this->rutasGET[$url]);

    }
    public function post($url, $fn)
    {

        $this->rutasPOST[$url] = $fn;
        //var_dump('post' . $this->rutasPOST[$url]);
    }


    public function comprobarRutas()
    {
        //Rutas protegidas
        $rutas_protegidas=['/admin/', 'propiedades/crear', 'propiedades/actualizar', 'propiedades/eliminar', 'vendedores/crear', 'vendedores/actualizar', 'vendedores/eliminar'];
        
        session_start();
        $auth=$_SESSION['login']??null;
        

        $urlActual = $_SERVER['REQUEST_URI'] ?? "/public/";
        $urlActual=parse_url($urlActual)['path'];
        //var_dump($urlActual);

        $metodo = $_SERVER['REQUEST_METHOD'];
        //var_dump($metodo);

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
            //debugear($fn);
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
            //debugear($fn);
        }
        if(in_array($urlActual, $rutas_protegidas)&&!$auth){
            header('location: /');

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
        //var_dump("estoy en render");
        //var_dump($view); die;
        //echo "<br>";
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
