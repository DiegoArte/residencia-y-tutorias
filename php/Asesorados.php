<?php

class Asesorados extends Crud {
    protected static $tabla="asesorados";
    protected static $columnasDB=['id', 'Alumno', 'Asesor'];
    public $id;
    public $Alumno;
    public $Asesor;

    public function __construct($args=[]) {
        $this->Alumno=$args['Lista1']??"";
        $this->Asesor=$args['Lista2']??"";
    }
}
