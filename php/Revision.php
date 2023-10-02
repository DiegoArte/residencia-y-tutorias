<?php

class Revision extends Crud {
    protected static $tabla="revision";
    protected static $columnasDB=['iddocente', 'idalumno', 'nombreProyecto', 'comnombreProyecto', 'empresa', 'comempresa', 'objetivos', 'comobjetivos', 'justificacion', 'comjustificacion', 'cronograma', 'comcronograma', 'descripcion', 'comdescripcion'];
    public $iddocente;
    public $idalumno;
    public $nombreProyecto;
    public $comnombreProyecto;
    public $empresa;
    public $comempresa;
    public $objetivos;
    public $comobjetivos;
    public $justificacion;
    public $comjustificacion;
    public $cronograma;
    public $comcronograma;
    public $descripcion;
    public $comdescripcion;

    public function __construct($args=[]) {
        $this->iddocente=$args['iddocente']??"";
        $this->idalumno=$args['idalumno']??"";
        $this->nombreProyecto=$args['nombreProyecto']??0;
        $this->comnombreProyecto=$args['comnombreProyecto']??"";
        $this->empresa=$args['empresa']??0;
        $this->comempresa=$args['comempresa']??"";
        $this->objetivos=$args['objetivos']??0;
        $this->comobjetivos=$args['comobjetivos']??"";
        $this->justificacion=$args['justificacion']??0;
        $this->comjustificacion=$args['comjustificacion']??"";
        $this->cronograma=$args['cronograma']??0;
        $this->comcronograma=$args['comcronograma']??"";
        $this->descripcion=$args['descripcion']??0;
        $this->comdescripcion=$args['comdescripcion']??"";
    }
}