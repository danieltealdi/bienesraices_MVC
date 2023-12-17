<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];
        if ($_SERVER['REQUEST_METHOD']) {
            $auth = new Admin($_POST);
            $errores = $auth->validar();
            if (empty($errores)) {
                //comprobar que el usuario existe
                $resultado = $auth->elUsuarioExiste();
                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    //Comprobar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    if (!$autenticado) {
                        $errores = Admin::getErrores();
                    } else {
                        $auth->autenticar();

                    }
                }
            }
        }
        $router->render('auth/login', [
            'errores' => $errores,
        ]);
    }
    public static function logout(Router $router)
    {
       session_start();
       $_SESSION=[];
       header('location:/');
    }
}
