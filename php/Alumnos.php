<?php

class Alumnos extends Crud {
    protected static $tabla="alumnos";
    protected static $columnasDB=['Academia', 'NombredelEstudiante', 'NombredelAnteproyecto', 'id', 'NumerodeControl'];
    public $Academia;
    public $NombredelEstudiante;
    public $NombredelAnteproyecto;
    public $id;
    public $NumerodeControl;
}
