<?php

namespace Model;

class Admin extends ActiveRecord
{
    public static $tabla='usuarios';
    public static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = 'El E-mail es obligatorio';
        }
        if (!$this->password) {
            self::$errores[] = 'La contraseña es obligatoria';
        }
        return self::$errores;
    }
    public function elUsuarioExiste()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email='" . $this->email . "' LIMIT 1";
        //var_dump($query);
        $resultado=self::$db->query($query);
        //var_dump($resultado);
        if(!$resultado->num_rows){
            self::$errores[]='El usuario no existe';
            return;
        }
        return $resultado;
    }
    public function comprobarPassword($resultado){
        $usuario=$resultado->fetch_object();
        $autenticado=password_verify($this->password, $usuario->password);
        if(!$autenticado){
            self::$errores[]='La contraseña es incorrecta';
        }
        return $autenticado;

    }
    public function autenticar(){
        session_start();
        $_SESSION['usuario']=$this->email;
        $_SESSION['login']=true;
        //debugear($_SESSION);
        header('location:/admin/');

    }
}
