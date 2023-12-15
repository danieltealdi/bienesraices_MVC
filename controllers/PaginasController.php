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
            $mail = new PHPMailer();            
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '1f862d49f99af1';
            $mail->Password = '70947adcb12ba0';

            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'Bienesraices.com');
            $mail->Subject='Tienes un nuevo mensaje';
            $mail->isHTML(true); 
            $mail->CharSet='UTF-8';
            $mail->Body    = '<html><p>This is the HTML message body <b>in bold!</b><p></html>';
            if($mail->send()){
                echo('Mensaje enviado');
            }else{
                echo('El mensaje no se pudo enviar');
            }




            
        }
        //var_dump("estoy aqui"); die;
        $router->render('paginas/contacto', []);
    }
}
