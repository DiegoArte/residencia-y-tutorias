<?php

class Alumnosnormales extends Crud {
    protected static $tabla="alumnosnormales";
    protected static $columnasDB=['Academia', 'NumerodeControl', 'NombreDelEstudiante', 'Numerocontrolgrupo'];
    public $Academia;
    public $NumerodeControl;
    public $NombreDelEstudiante;
    public $Numerocontrolgrupo;
}