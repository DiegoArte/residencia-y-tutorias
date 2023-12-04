<?php

class AlumnoMateria extends Crud {
    protected static $tabla="alumno_materia";
    protected static $columnasDB=['idalumno', 'idmateria'];
    public $idalumno;
    public $idmateria;
}
