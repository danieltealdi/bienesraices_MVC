<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;

class VendedorController
{

    public static function index(Router $router)
    {
        $vendedores = Vendedores::all();

        $resultado = $_GET['mensaje'] ?? null;
        //debugear($resultado);
        //$resultado=null;
        //echo "Admin";
        //debugear($router);
        $router->render('propiedades/admin', [
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }
    public static function crear(Router $router)
    {
        //debugear($router);
        $vendedor = new Vendedores();
        $errores = Vendedores::getErrores();
        //debugear($vendedor);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $vendedor = new Vendedores($_POST['vendedor']);

            // Validar
            $errores = $vendedor->validar();

            if (empty($errores)) {

                // Guarda en la base de datos
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores,

        ]);
    }
    public static function actualizar(Router $router)
    {
        //debugear($router);
        $id = validarORedireccionar("/admin/");
        //var_dump($id);
        $vendedor = Vendedores::find($id);
        //var_dump($vendedor);
        $errores = Vendedores::getErrores();
        //var_dump($errores);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['vendedor'];
            //var_dump($args);
            if ($args != $vendedor) {
                $vendedor->sincronizar($args);
                //debugear($vendedor);

                $errores = $vendedor->validar();


                // El array de errores esta vacio
                if (empty($errores)) {
                    $vendedor->guardar();
                }
            }
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores,
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
                    // Obtener el vendedor
                    $vendedor = Vendedores::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
