<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;
// Importar Intervention Image
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedores::all();
        $resultado = $_GET['mensaje'] ?? null;
        //debugear($resultado);
        //$resultado=null;
        //echo "Admin";
        //debugear($router);
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedores::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                //echo $image->response('jpg', 70);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar
            $errores = $propiedad->validar();
            //debugear(CARPETA_IMAGENES);
            if (empty($errores)) {

                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                //var_dump(CARPETA_IMAGENES . '/' . $nombreImagen); die;
                $ruta = CARPETA_IMAGENES . '/' . $nombreImagen;
                //var_dump($ruta);                
                $image->save($ruta);

                // Guarda en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,

        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar("/admin/");
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedores::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['propiedad'];
            //var_dump($args);

            $propiedad->sincronizar($args);
            //debugear($propiedad);
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //debugear($_FILES['propiedad']['tmp_name']['imagen']);
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                //debugear($_FILES['propiedad']['tmp_name']['imagen']);
                $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                //debugear($imagen);
                $propiedad->setImagen($nombreImagen);
                //debugear($propiedad->imagen);
            }
            $errores = $propiedad->validar();


            // El array de errores esta vacio
            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $ruta = CARPETA_IMAGENES . "/" . $nombreImagen;
                    $imagen->save($ruta);
                }

                $propiedad->guardar();
            }
        }


        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores,
        ]);
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitizar número entero
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $tipo = $_POST['tipo'];
            if (validarTipos($tipo)) {
                // Eliminar... 
                if ($id) {
                    // Obtener la propiedad
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
