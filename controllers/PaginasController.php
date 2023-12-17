<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades,

        ]);
    }


    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades,

        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');
        //var_dump($id); //die;
        $propiedad = Propiedad::find($id);
        //var_dump($propiedad); //die;
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad,

        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router)
    {

        //var_dump($_SERVER['REQUEST_METHOD']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = null;
            $mensaje = null;
            $respuestas = $_POST['contacto'];
            //debugear($respuestas);
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '1f862d49f99af1';
            $mail->Password = '70947adcb12ba0';
            
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'Bienesraices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= '<p><b>Correo de contacto</b><p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Compra o vende: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o presupuesto: ' . $respuestas['cantidad'] . '</p>';
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por teléfono</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p>Eligió ser contactado por e-mail</p>';
                $contenido .= '<p>E-Mail: ' . $respuestas['email'] . '</p>';
            }
            $contenido .= '<html>';
            $mail->Body    = $contenido;
            $resultado = $mail->send();
            if ($resultado === true) {
                $mensaje = 'exito';
            } else if (isset($resultado)) {
                $mensaje = 'error';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
