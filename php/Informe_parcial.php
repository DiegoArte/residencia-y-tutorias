<?php

class InformeParcial extends Crud {
    protected static $tabla="informe_parcial";
    protected static $columnasDB=['asignatura', 'numReprobadosI', 'porReprobadosI', 'numReprobadosII', 'porReprobadosII', 'numReprobadosIII', 'porReprobadosIII', 'numReprobadosIV', 'porReprobadosIV', 'numReprobadosV', 'porReprobadosV', 'numReprobadosVI', 'porReprobadosVI', 'aprobadosI', 'aprobadosII', 'aprobadosIII', 'aprobadosIV', 'aprobadosV', 'aprobadosVI', 'estudiantes', 'grupo', 'docente'];
    public $asignatura;
    public $numReprobadosI;
    public $porReprobadosI;
    public $numReprobadosII;
    public $porReprobadosII;
    public $numReprobadosIII;
    public $porReprobadosIII;
    public $numReprobadosIV;
    public $porReprobadosIV;
    public $numReprobadosV;
    public $porReprobadosV;
    public $numReprobadosVI;
    public $porReprobadosVI;
    public $aprobadosI;
    public $aprobadosII;
    public $aprobadosIII;
    public $aprobadosIV;
    public $aprobadosV;
    public $aprobadosVI;
    public $estudiantes;
    public $grupo;
    public $docente;

    public function __construct($args=[]) {
        $this->asignatura=$args['asignatura']??"";
        $this->numReprobadosI=$args['numReprobadosI']??0;
        $this->porReprobadosI=round(floatval($args['numReprobadosI'])/floatval($args['estudiantes'])*100, 2) ?? 0;
        $this->numReprobadosII=$args['numReprobadosII']??0;
        $this->porReprobadosII=round(floatval($args['numReprobadosII'])/floatval($args['estudiantes'])*100, 2) ?? 0;
        $this->numReprobadosIII=$args['numReprobadosIII']??0;
        $this->porReprobadosIII=round(floatval($args['numReprobadosIII'])/floatval($args['estudiantes'])*100, 2) ?? 0;
        $this->numReprobadosIV=$args['numReprobadosIV']??0;
        $this->porReprobadosIV=round(floatval($args['numReprobadosIV'])/floatval($args['estudiantes'])*100, 2) ?? 0;
        $this->numReprobadosV=$args['numReprobadosV']??0;
        $this->porReprobadosV=round(floatval($args['numReprobadosV'])/floatval($args['estudiantes'])*100, 2) ?? 0;
        $this->numReprobadosVI=$args['numReprobadosVI']??0;
        $this->porReprobadosVI=round(floatval($args['numReprobadosVI'])/floatval($args['estudiantes'])*100, 2) ?? 0;
        $this->aprobadosI=$args['aprobadosI']??0;
        $this->aprobadosII=$args['aprobadosII']??0;
        $this->aprobadosIII=$args['aprobadosIII']??0;
        $this->aprobadosIV=$args['aprobadosIV']??0;
        $this->aprobadosV=$args['aprobadosV']??0;
        $this->aprobadosVI=$args['aprobadosVI']??0;
        $this->estudiantes=$args['estudiantes']??0;
        $this->grupo=$args['grupo']??"";
        $this->docente=$args['docente']??"";
    }
}