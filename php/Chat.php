<?php

class Chat extends Crud {
    protected static $tabla="chat";
    protected static $columnasDB=['id', 'idinput', 'idaoutput', 'msj'];
    public $id;
    public $idinput;
    public $idaoutput;
    public $msj;

    public function __construct($args=[]) {
        $this->idinput=$args['idinput']??"";
        $this->idaoutput=$args['idaoutput']??"";
        $this->msj=$args['msj']??"";
    }
}

