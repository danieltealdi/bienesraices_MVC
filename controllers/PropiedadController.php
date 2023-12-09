<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;
// Importar Intervention Image
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    public static function index(Router $router){
        $propiedades=Propiedad::all();

        $resultado=$_GET['mensaje'] ?? null;
        //debugear($resultado);
        //$resultado=null;
        //echo "Admin";
        //debugear($router);
        $router->render('propiedades/admin', [
            'propiedades'=>$propiedades,
            'resultado'=>$resultado
        ]);
    }
    public static function crear(Router $router){
        $propiedad=new Propiedad;
        $vendedores=Vendedores::all();
        $errores=Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);

            // Generar un nombre único
            $nombreImagen=md5(uniqid(rand(), true)) . ".jpg";
            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']){        
                $image=Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                //echo $image->response('jpg', 70);
                $propiedad->setImagen($nombreImagen);                
            }

            // Validar
            $errores = $propiedad->validar();
            //debugear(CARPETA_IMAGENES);
            if(empty($errores)) {
            
                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
    
                // Guarda la imagen en el servidor
                //var_dump(CARPETA_IMAGENES . '/' . $nombreImagen); die;
                $ruta=CARPETA_IMAGENES . '/' . $nombreImagen;
                //var_dump($ruta);                
                $image->save($ruta);
                
                // Guarda en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad'=>$propiedad,
            'vendedores'=>$vendedores,
            'errores'=>$errores,
            
        ]);
    }
    public static function actualizar(){
        echo "Actualizar Propiedad";
    }

}
