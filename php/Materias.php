<?php

class Materias extends Crud {
    protected static $tabla="materias";
    protected static $columnasDB=['id', 'NumerodeControlAcademia', 'NumerodeControl', 'NombredelaMateria', 'NumerodeControlDocente', 'Unidades'];
    public $id;
    public $NumerodeControlAcademia;
    public $NumerodeControl;
    public $NombredelaMateria;
    public $NumerodeControlDocente;
    public $Unidades;
}