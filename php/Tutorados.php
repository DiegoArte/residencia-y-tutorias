<?php

class Tutorados extends Crud {
    protected static $tabla="tabla_tutorados";
    protected static $columnasDB=['Grupo', 'Tutor', 'id'];
    public $Grupo;
    public $Tutor;
    public $id;

    public function __construct($args=[]) {
        $this->Grupo=$args['Lista1']??"";
        $this->Tutor=$args['Lista2']??"";
    }
}
