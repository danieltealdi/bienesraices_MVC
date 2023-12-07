<?php
namespace Model;
class Vendedores extends ActiveRecord{
    protected static $tabla='vendedores';
    protected static $columnasDB=['id', 'nombre', 'apellidos', 'telefono'];

    public $id;
    public $nombre;
    public $apellidos;
    public $telefono;

    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null; 
        $this->nombre=$args['nombre'] ?? ''; 
        $this->apellidos=$args['apellidos'] ?? ''; 
        $this->telefono=$args['telefono'] ?? ''; 
    }
    public function validar(){
        if (!$this->nombre) {
            self::$errores[] = 'El Nombre es obligatorio';
            //echo 'El Nombre es obligatorio';
        }
        if (!$this->apellidos) {
            self::$errores[] = 'Los Apellidos son obligatorios';
        }
        if (!$this->telefono) {
            self::$errores[] = 'El Teléfono es obligatorio';
        }
        if(!preg_match("/[0-9]{9}/", $this->telefono)){
            self::$errores[] = 'El Teléfono es incorrecto';
        }
        return self::$errores;
    }
}

?>