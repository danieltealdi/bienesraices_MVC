<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;

class PropiedadController{

    public static function index(Router $router){
        $propiedades=Propiedad::all();
        $resultado=null;
        //echo "Admin";
        //debugear($router);
        $router->render('propiedades/admin', [
            'propiedades'=>$propiedades,
            'resultado'=>$resultado
        ]);
    }
    public static function crear(){
        echo "Crear Propiedad";
    }
    public static function actualizar(){
        echo "Actualizar Propiedad";
    }

}
