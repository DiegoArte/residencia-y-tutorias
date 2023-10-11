<?php


class Crud {
    protected static $db;
    protected static $columnasDB=[];
    
    protected static $tabla="";

    public static function setDB($database) {
        self::$db=$database;
    }

    public function crear() {
        $atributos=$this->sanitizar();
        $string=join(', ', array_keys($atributos));
        $string2=join("', '", array_values($atributos));

        $query="INSERT INTO ".static::$tabla." ($string) VALUES ('$string2')";
        $resultado= self::$db->query($query);
    }

    public function atributos() {
        $atributos=[];
        foreach(static::$columnasDB as $columna) {
            if($columna=='id') continue;
            $atributos[$columna]=$this->$columna;
        }
        return $atributos;
    }
    
    public function sanitizar() {
        $atributos=$this->atributos();
        $sanitizado=[];

        foreach($atributos as $key=>$value) {
            $sanitizado[$key]=self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    public static function find($clause) {
        $query="SELECT * FROM ".static::$tabla." WHERE ".$clause;
        $resultado=self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarSQL($query) {
        $resultado=self::$db->query($query);
        $array=[];
        while($registro=$resultado->fetch_assoc()) {
            $array[]=static::crearObject($registro);
        }
        $resultado->free();
        return $array;
    }

    protected static function crearObject($registro) {
        $objeto=new static;
        foreach($registro as $key=>$value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key=$value;
            }
        }
        return $objeto;
    }
}

