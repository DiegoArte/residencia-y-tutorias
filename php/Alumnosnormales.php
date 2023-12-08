<?php

class Alumnosnormales extends Crud {
    protected static $tabla="alumnosnormales";
    protected static $columnasDB=['Academia', 'NumeroDeControl', 'NombreDelEstudiante', 'Numerocontrolgrupo'];
    public $Academia;
    public $NumeroDeControl;
    public $NombreDelEstudiante;
    public $Numerocontrolgrupo;
}