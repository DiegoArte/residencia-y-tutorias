<?php

class Calificaciones extends Crud {
    protected static $tabla="calificaciones";
    protected static $columnasDB=['alumno', 'materia', 'unidadI', 'unidadII', 'unidadIII', 'unidadIV', 'unidadV', 'unidadVI', 'grupo', 'docente'];
    public $alumno;
    public $materia;
    public $unidadI;
    public $unidadII;
    public $unidadIII;
    public $unidadIV;
    public $unidadV;
    public $unidadVI;
    public $grupo;
    public $docente;

    public function __construct($args=[]) {
        $this->alumno=$args['alumno']??"";
        $this->materia=$args['materia']??"";
        $this->unidadI=$args['unidadI']??"";
        $this->unidadII=$args['unidadII']??"";
        $this->unidadIII=$args['unidadIII']??"";
        $this->unidadIV=$args['unidadIV']??"";
        $this->unidadV=$args['unidadV']??"";
        $this->unidadVI=$args['unidadVI']??"";
        $this->grupo=$args['grupo']??"";
        $this->docente=$args['docente']??"";
    }
}