<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;


class PaginasController{
    public static function index(Router $router){
        $propiedades=Propiedad::get(3);
        $inicio=true;
        $router->render('paginas/index', [
            'inicio'=>$inicio,
            'propiedades'=>$propiedades,

        ]);
    }


    public static function nosotros(Router $router){
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router){
        $propiedades=Propiedad::all();
        $router->render('paginas/propiedades', [            
            'propiedades'=>$propiedades,

        ]);
    }

    public static function propiedad(Router $router){
        $id=validarORedireccionar('/propiedades');
        //var_dump($id); //die;
        $propiedad=Propiedad::find($id);
        //var_dump($propiedad); //die;
        $router->render('paginas/propiedad', [            
            'propiedad'=>$propiedad,

        ]);
    }

    public static function blog(Router $router){
        $router->render('paginas/blog', [
            
        ]);
    }

    public static function entrada(Router $router){
        $router->render('paginas/entrada', [
            
        ]);
    }

    public static function contacto(Router $router){
        echo "<h1>Página de contacto</h1>";
    }

}
