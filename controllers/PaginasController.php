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


    public static function nosotros(){
        echo "<h1>Página de nosotros</h1>";
    }

    public static function propiedades(){
        echo "<h1>Página de propiedades</h1>";
    }

    public static function propiedad(){
        echo "<h1>Página de propiedad</h1>";
    }

    public static function blog(){
        echo "<h1>Página de blog</h1>";
    }

    public static function entrada(){
        echo "<h1>Página de entrada</h1>";
    }

    public static function contacto(){
        echo "<h1>Página de contacto</h1>";
    }

}
