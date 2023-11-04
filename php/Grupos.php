<?php

class Grupos extends Crud {
    protected static $tabla="grupos";
    protected static $columnasDB=['id', 'NombredeCarrera', 'NumerodeControl', 'Semestre', 'Edificio', 'Salon'];
    public $id;
    public $NombredeCarrera;
    public $NumerodeControl;
    public $Semestre;
    public $Edificio;
    public $Salon;
}
