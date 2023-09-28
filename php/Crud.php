<?php

require 'db.php';

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
}

$db=conectar();
Crud::setDB($db);