<?php

class Docentes extends Crud {
    protected static $tabla="docentes";
    protected static $columnasDB=['NumerodeControl', 'id', 'Academia', 'NombredelDocente', 'Asesor', 'Presidente', 'Secretaria'];
    public $NumerodeControl;
    public $id;
    public $Academia;
    public $NombredelDocente;
    public $Asesor;
    public $Presidente;
    public $Secretaria;
}
