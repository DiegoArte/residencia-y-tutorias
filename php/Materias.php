<?php

class Materias extends Crud {
    protected static $tabla="materias";
    protected static $columnasDB=['id', 'Academia', 'NombredelDocente', 'Asesor', 'Presidente'];
    public $id;
    public $NumerodeControlAcademia;
    public $NumerodeControl;
    public $NombredelaMateria;
    public $NumerodeControlDocente;
}