<?php
namespace Model;
class ActiveRecord{
    protected static $db;
    protected static $columnasDB=[];
    protected static $errores;
    protected static $tabla='';
    

    public static function setDB($database){
        self::$db=$database;
    }
    
    

    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        }
        else{
            $this->crear();
        }
    }
    public function actualizar(){
       
        $atributos=$this->sanitizarAtributos();
        $valores=[];
        foreach($atributos as $key=>$value){
            $valores[]="$key='$value'";
        }

        $query="UPDATE " . static::$tabla . " SET ";
        $query.=join(', ',$valores);
        $query.="  WHERE id = '".self::$db->escape_string($this->id)."' ";
        $query.="LIMIT 1";
        //debugear($query);
        $resultado=self::$db->query($query);
        //debugear($resultado);
        if ($resultado) {
            header('location: /admin/?mensaje=2');
        }
        //return $resultado;        
    }

    public function crear(){
       
        $atributos=$this->sanitizarAtributos();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .=join(", ", array_keys($atributos));
        $query .=" ) VALUES ( ' ";
        $query .=join("', '", array_values($atributos));
        $query .=" ' ) ";
        $resultado=self::$db->query($query);
        if ($resultado) {
            header('location: /admin/?mensaje=1');
        }
    }

    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = "; 
        $query .= self::$db->escape_string($this->id);
        $query .= " LIMIT 1";
        //debugear($query);
        $resultado=self::$db->query($query);        
        if ($resultado) {
            if(static::$tabla==='propiedades'){
                $this->borrarImagen();
            }
            header('location: /admin/index.php?mensaje=3');
        }else{
            header('location: /admin/index.php?mensaje=4');
        }
    }

    public function atributos(){
        $atributos=[];
        foreach(static::$columnasDB as $columna){
            if($columna==='id')continue;
            $atributos[$columna]=$this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos=$this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }        
        return $sanitizado;
    }
    public function borrarImagen(){
        if(!is_null($this->id)){
            $existearchivo=file_exists(CARPETA_IMAGENES . "/" . $this->imagen);
            if ($existearchivo){
                unlink(CARPETA_IMAGENES . "/" . $this->imagen);
            }
        }
    }

    public function setImagen($imagen){
        $this->borrarImagen();
        if($imagen){
            $this->imagen=$imagen;
        }
    }

    //Validación
    public static function getErrores(){
        return static::$errores;
    }
    public function validar(){
        static::$errores=[];        
        return static::$errores;
    } 

    public static function all(){
        //debugear(static::$tabla);
        $query = "SELECT * FROM " . static::$tabla;
        //debugear($query);
        $resultado=self::consultarSQL($query);
        return $resultado;
    }

    public static function get($cantidad){
        //debugear(static::$tabla);
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        //debugear($query);
        $resultado=self::consultarSQL($query);
        return $resultado;
    }

    public static function find($id){
        $consulta = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado=self::consultarSQL($consulta);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //Consultar DB
        $resultado=self::$db->query($query);
        //Iterar los registros
        $array=[];
        while($registro=$resultado->fetch_assoc()){
            $array[]=static::crearObjeto($registro);
        }
        //Liberar la memoria
        $resultado->free();
        //retornar el resultado
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto=new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key=$value;
            }
        }
        return $objeto;
    }

    public function sincronizar($args=[]){
        //debugear($args);
        foreach($args as $key=>$value){
            //echo $value;
            
            if(property_exists($this, $key) && !is_null($value)){
                
                $this->$key=$value;
                //echo $this->$key;
            }
        }
    }
    
}